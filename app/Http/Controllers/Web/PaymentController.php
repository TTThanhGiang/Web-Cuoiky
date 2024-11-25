<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request){

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout/vnpay_return";
        $vnp_TmnCode = "DO7GA9AX";//Mã website tại VNPAY 
        $vnp_HashSecret = "55CW4D6QE7NCT5YPXTQNIGDEP8H46QAH"; //Chuỗi bí mật    

        $order_id = $request->input('order_id');
        $total_price_usd = $request->input('total_price');
        $order_info = $request->input('order_info');

        // Tỷ giá USD sang VND
        $exchange_rate = 23500; // Ví dụ: 1 USD = 23,500 VND
        $total_price_vnd = $total_price_usd * $exchange_rate;
        
        $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $order_info;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total_price_vnd * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
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
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "55CW4D6QE7NCT5YPXTQNIGDEP8H46QAH"; // Chuỗi bí mật
        $inputData = $request->all();

        $vnp_SecureHash = $_GET['vnp_SecureHash'];

        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
            
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                 $i = 1;
            }
         }
    
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            $order_id = $inputData['vnp_TxnRef'];
            $order = Order::find($order_id);
            $total_price_vnd = $inputData['vnp_Amount'] / 100;
            $exchange_rate = 23500; // Ví dụ: 1 USD = 23,500 VND
            $total_price_usd = $total_price_vnd / $exchange_rate;
            if ($_GET['vnp_ResponseCode'] == '00') {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'vnpay',
                    'payment_status' => 'completed',
                    'amount' => $total_price_usd, // Số tiền (USD)
                ]);

                $order->update([
                    'payment_status' => 'paid',
                ]);

                return redirect()->route('home.index')->with('success', 'Payment successfully!');
            } 
            else {
                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'vnpay',
                    'payment_status' => 'failed',
                    'amount' => $total_price_usd, // Số tiền (USD)
                ]);

                return redirect()->route('home.index')->with('error', 'Payment Failed!');
            }
        } else {
            return redirect()->route('home.index')->with('error', 'Invalid signature!');
        }
    }

    public function cash_payment(Request $request){
        $inputData = $request->all();

        $order_id = $inputData['order_id'];
        $total_price = $inputData['total_price'];
        $order = Order::find($order_id);

        if($order){
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'pending',
                'amount' => $total_price, 
            ]);

            $order->update([
                'payment_status' => 'pending',
            ]);
            return redirect()->route('home.index')->with('success', 'Order is being processed!');
        }
        return redirect()->route('home.index')->with('error', 'Order not found!');

    }
}
