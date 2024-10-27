<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

            $voucherId = $_POST['voucher_id'] ?? null;
            if ($voucherId === '') {
                $voucherId = null;
            }
            $order = Order::create([
                'order_id' => time() . "",
                'user_id' => Auth::user()->user_id,
                'total_price' => $request->total_price,
                'voucher_id' => $request->voucher_id,
                'final_price' => $request->final_price
            ]);
            $order->save();
            $total_after_discount = $request->final_price;
            if (isset($_POST['product'])) {
                $pro = json_decode($_POST['product']);
                foreach ($pro as $item) {
                    order_item::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product->product_id,
                        'quantity' => $item->quantity,
                        'price_per_item' => $total_after_discount
                    ]);
                }
            }
            /*$vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
            $vnp_Returnurl = 'http://127.0.0.1:8000/order-success';
            $vnp_TmnCode = 'JRD81S8P';
            $vnp_HashSecret = 'OY5D5P9YTMDTJMGTZ41HDBMBGXFXB8HE';*/

            $vnp_Url = env("VNP_URL");
            $vnp_Returnurl = env("VNP_RETURN");
            $vnp_TmnCode = env("VNP_TNMCODE");
            $vnp_HashSecret = env("VNP_HASHSECRET");

            $vnp_TxnRef = $order->order_id;
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

        } elseif (isset($_POST['payUrl'])) {

            $order = Order::create([
                'order_id' => time() . "",
                'user_id' => Auth::user()->user_id,
                'total_price' => $request->total_price,
                'final_price' => $request->final_price,
                'voucher_id' => $request->voucher_id
            ]);
            $order->save();
            $total_after_discount = $request->final_price;
            if (isset($_POST['product'])) {
                $pro = json_decode($_POST['product']);
                foreach ($pro as $item) {
                    order_item::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item->product->product_id,
                        'quantity' => $item->quantity,
                        'price_per_item' => $total_after_discount
                    ]);
                }
            }
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

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


    }
}
