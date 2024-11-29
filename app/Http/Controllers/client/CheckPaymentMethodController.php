<?php

namespace App\Http\Controllers\client;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailOrderJob;
use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\order_item;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\user_voucher;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckPaymentMethodController extends Controller
{
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function onlineCheckOut(Request $request)
    {
        if (isset($_POST['cod'])) {

            echo 'cod';

        } elseif (isset($_POST['vnpay'])) {
            return $this->vnPay($request);
        } elseif (isset($_POST['payUrl'])) {
            return $this->momo($request);
        }
    }

    private function cod(Request $request)
    {
        DB::transaction(function () use ($request) {
            $order_items = json_decode($request['product']);
            User::where('user_id', Auth::user()->user_id)
                ->update([
                    'username' => $request->username,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email
                ]);
            $order = Order::create([
                'order_id' => rand(0000000000, 999999999),
                'user_id' => Auth::user()->user_id,
                'total_price' => $request['total_price'],
                'voucher_id' => $request['voucher_id'],
                'final_price' => $request['final_price'],
                'payment_method' => 'Tiền mặt khi giao hàng',
                'note' => $request['note']
            ]);
            $order->save();
            // Mảng để lưu trữ các product_variant_id đã xử lý
            $processedVariants = [];
            foreach ($order_items as $item) {
                order_item::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product->product_id,
                    'quantity' => $item->quantity,
                    'price_per_item' => $item->product->sale_price
                ]);
                // xóa biến thể
                $cartItems = Cart::where('user_id', Auth::user()->user_id)
                    ->where('product_id', $item->product->product_id)
                    ->get();
                foreach ($cartItems as $cartItem) {
                    if (in_array($cartItem->product_variant_id, $processedVariants)) {
                        continue; // Nếu đã xử lý, bỏ qua
                    }
                    $variant = ProductVariant::find($cartItem->product_variant_id);
                    if ($variant) {
                        $variant->quantity -= $cartItem->quantity;
                        $variant->save();
                        // Đánh dấu biến thể này đã được xử lý
                        $processedVariants[] = $cartItem->product_variant_id;
                    }
                }
            }
            Notifications::create([
                'user_id' => $order->user_id,
                'message' => "Đơn hàng {$order->order_id} của bạn đã đặt hàng thành công"
            ]);
            $order = Order::where('order_id', $order->order_id)->first();
            if ($order && $order->voucher_id) {
                // Xóa chỉ mã voucher đã áp dụng
                $voucher = user_voucher::where('voucher_id', $order->voucher_id)->first();
                $voucher->delete();
            }
            Cart::where('user_id', Auth::user()->user_id)->delete();
            SendMailOrderJob::dispatch(Auth::user()->email, $order);
            event(new OrderEvent($order));
        });
        return redirect()->route('home');
    }

    private function vnPay(Request $request)
    {
        session([
            'order_data' => [
                'user_id' => Auth::user()->user_id,
                'total_price' => $request->total_price,
                'voucher_id' => $request->voucher_id,
                'final_price' => $request->final_price,
                'note' => $request->notes
            ],
            'order_items' => json_decode($_POST['product']),
            'user' => [
                'username' => $request->username,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email
            ]
        ]);
        $total_after_discount = $request->final_price;

        $vnp_Url = env("VNP_URL");
        $vnp_Returnurl = env("VNP_RETURN");
        $vnp_TmnCode = env("VNP_TNMCODE");
        $vnp_HashSecret = env("VNP_HASHSECRET");

        $vnp_TxnRef = time();
        $vnp_OrderInfo = 'thanh toan hoa don';
        $vnp_OrderType = 'carrot';
        $vnp_Amount = $total_after_discount * 100;
        $vnp_Locale = 'vi';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $hashdata = "";
        $query = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;
        return redirect()->to($vnp_Url);
    }

    private function momo(Request $request)
    {
        session([
            'order_data' => [
                'user_id' => Auth::user()->user_id,
                'total_price' => $request->total_price,
                'voucher_id' => $request->voucher_id,
                'final_price' => $request->final_price,
                'note' => $request->notes
            ],
            'order_items' => json_decode($_POST['product']),
            'user' => [
                'username' => $request->username,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email
            ]
        ]);
        $total_after_discount = $request->final_price;

        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNERCODE');
        $accessKey = env('MOMO_ACCESSKEY');
        $secretKey = env('MOMO_SECRETKEY');

        $orderInfo = "Thanh toán qua MoMo";
        $amount = (int)$total_after_discount;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/return-momo";
        $ipnUrl = "http://127.0.0.1:8000/return-momo";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        Log::info('MoMo API Response: ', $jsonResult);

        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit;  // Đảm bảo không có mã khác chạy sau header
        } else {
            dd($jsonResult);  // Xem lý do tại sao không có payUrl
        }
    }

    public function handlePaymentReturn(Request $request)
    {
        $vnp_Amount = $request->query('vnp_Amount');
        $vnp_BankCode = $request->query('vnp_BankCode');
        $vnp_BankTranNo = $request->query('vnp_BankTranNo');
        $vnp_CardType = $request->query('vnp_CardType');
        $vnp_OrderInfo = $request->query('vnp_OrderInfo');
        $vnp_PayDate = $request->query('vnp_PayDate');
        $vnp_ResponseCode = $request->query('vnp_ResponseCode');
        $vnp_TmnCode = $request->query('vnp_TmnCode');
        $vnp_TransactionNo = $request->query('vnp_TransactionNo');
        $vnp_TransactionStatus = $request->query('vnp_TransactionStatus');
        $vnp_TxnRef = $request->query('vnp_TxnRef');
        $vnp_SecureHash = $request->query('vnp_SecureHash');

        // Kiểm tra và xử lý dữ liệu
        if ($vnp_ResponseCode == '00') {
            DB::transaction(function () use ($vnp_TxnRef){
                $order_data = session('order_data');
                $order_items = session('order_items');
                $user = session('user');
                User::where('user_id', Auth::user()->user_id)
                    ->update([
                        'username' => $user['username'],
                        'address' => $user['address'],
                        'phone' => $user['phone'],
                        'email' => $user['email']
                    ]);
                $order = Order::create([
                    'order_id' => $vnp_TxnRef,
                    'user_id' => Auth::user()->user_id,
                    'total_price' => $order_data['total_price'],
                    'voucher_id' => $order_data['voucher_id'],
                    'final_price' => $order_data['final_price'],
                    'payment_method' => 'VNPay',
                    'note' => $order_data['note']
                ]);
                $order->save();
                $processedVariants = [];
                foreach ($order_items as $item) {
                    order_item::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product->product_id,
                        'quantity' => $item->quantity,
                        'price_per_item' => $item->product->sale_price
                    ]);
                    // xóa biến thể
                    $cartItems = Cart::where('user_id', Auth::user()->user_id)
                        ->where('product_id', $item->product->product_id)
                        ->get();
                    foreach ($cartItems as $cartItem) {
                        if (in_array($cartItem->product_variant_id, $processedVariants)) {
                            continue; // Nếu đã xử lý, bỏ qua
                        }
                        $variant = ProductVariant::find($cartItem->product_variant_id);
                        if ($variant) {
                            $variant->quantity -= $cartItem->quantity;
                            $variant->save();
                            // Đánh dấu biến thể này đã được xử lý
                            $processedVariants[] = $cartItem->product_variant_id;
                        }
                    }
                }
                Notifications::create([
                    'user_id' => $order->user_id,
                    'message' => "Đơn hàng {$order->order_id} của bạn đã đặt hàng thành công"
                ]);
                // Tìm đơn hàng dựa trên vnp_TxnRef (order_id)
                $order = Order::where('order_id', $vnp_TxnRef)->first();
                if ($order && $order->voucher_id) {
                    // Xóa chỉ mã voucher đã áp dụng
                    $voucher = user_voucher::where('voucher_id', $order->voucher_id)->first();
                    $voucher->delete();
                }
                Cart::where('user_id', Auth::user()->user_id)->delete();
                SendMailOrderJob::dispatch(Auth::user()->email, $order);
                event(new OrderEvent($order));
            });
            return redirect()->route('home');
        } else {
            return redirect()->route('checkout');
        }
    }

    public function orderSuccessMono(Request $request)
    {
        // Lấy các tham số từ URL
        $partnerCode = $request->input('partnerCode');
        $orderId = $request->input('orderId');
        $requestId = $request->input('requestId');
        $amount = $request->input('amount');
        $orderInfo = $request->input('orderInfo');
        $orderType = $request->input('orderType');
        $transId = $request->input('transId');
        $resultCode = $request->input('resultCode');
        $message = $request->input('message');
        $payType = $request->input('payType');
        $responseTime = $request->input('responseTime');
        $extraData = $request->input('extraData');
        $signature = $request->input('signature');

        // Xử lý thông tin hoặc lưu vào cơ sở dữ liệu
        if ($resultCode == '00') {
            DB::transaction(function () use ($orderId){
                $order_data = session('order_data');
                $order_items = session('order_items');
                $user = session('user');
                User::where('user_id', Auth::user()->user_id)
                    ->update([
                        'username' => $user['username'],
                        'address' => $user['address'],
                        'phone' => $user['phone'],
                        'email' => $user['email']
                    ]);
                $order = Order::create([
                    'order_id' => $orderId,
                    'user_id' => Auth::user()->user_id,
                    'total_price' => $order_data['total_price'],
                    'voucher_id' => $order_data['voucher_id'],
                    'final_price' => $order_data['final_price'],
                    'payment_method' => 'Momo',
                    'note' => $order_data['note']
                ]);
                $order->save();
                $processedVariants = [];
                foreach ($order_items as $item) {
                    order_item::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product->product_id,
                        'quantity' => $item->quantity,
                        'price_per_item' => $item->product->sale_price
                    ]);
                    // xóa biến thể
                    $cartItems = Cart::where('user_id', Auth::user()->user_id)
                        ->where('product_id', $item->product->product_id)
                        ->get();
                    foreach ($cartItems as $cartItem) {
                        if (in_array($cartItem->product_variant_id, $processedVariants)) {
                            continue; // Nếu đã xử lý, bỏ qua
                        }
                        $variant = ProductVariant::find($cartItem->product_variant_id);
                        if ($variant) {
                            $variant->quantity -= $cartItem->quantity;
                            $variant->save();
                            // Đánh dấu biến thể này đã được xử lý
                            $processedVariants[] = $cartItem->product_variant_id;
                        }
                    }
                }
                Notifications::create([
                    'user_id' => $order->user_id,
                    'message' => "Đơn hàng {$order->order_id} của bạn đã đặt hàng thành công"
                ]);
                $order = Order::where('order_id', $orderId)->first();
                if ($order && $order->voucher_id) {
                    // Xóa chỉ mã voucher đã áp dụng
                    // Xóa chỉ mã voucher đã áp dụng
                    $voucher = user_voucher::where('voucher_id', $order->voucher_id)->first();
                    $voucher->delete();
                }
                Cart::where('user_id', Auth::user()->user_id)->delete();
                SendMailOrderJob::dispatch(Auth::user()->email, $order);
                event(new OrderEvent($order));
            });
            return redirect()->route('home');
        } else {
            return redirect()->route('checkout');
        }
    }
}
