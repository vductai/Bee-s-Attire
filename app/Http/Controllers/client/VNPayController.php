<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {

        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'total_price' => $request->total_price,
            'voucher_id' => $request->voucher_id,
            'final_price' => $request->final_price
        ]);

        $order->save();

        $total_after_discount = $request->final_price;

        if ($request->has('product')) {
            $pro = json_decode($request->product);
            foreach ($pro as $item) {
                    order_item::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product->product_id,
                        'quantity' => $item->quantity,
                        'price_per_item' => $total_after_discount
                    ]);
            }
        }


        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN');
        $vnp_TmnCode = env('VNP_TNMCODE');
        $vnp_HashSecret = env('VNP_HASHSECRET');

        $vnp_TxnRef = $order->order_id;
        $vnp_OrderInfo = 'thanh toan hoa don';
        $vnp_OrderType = 'carrot';
        $vnp_Amount =  $total_after_discount * 100;
        $vnp_Locale = 'vi';
        $vnp_BankCode = '';
        $vnp_IpAddr = $request->ip();

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
            Cart::where('user_id', Auth::user()->user_id)->delete();
            return view('client.message.orderSuccess');
        } else {
            return 'Thanh toán thất bại!';
        }
    }


}
