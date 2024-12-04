<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentVnPayController extends Controller
{
    //
    public function vnp_payment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // VNPAY Sandbox URL
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php"; // Return URL của bạn (Sử dụng ngrok nếu đang chạy localhost)
        $vnp_TmnCode = "V03IB2I2"; // Mã website tại VNPAY
        $vnp_HashSecret = "0NK8MPYVQA00624WW4FQOC8XBAG41IC3"; // Chuỗi bí mật từ VNPAY
        
        // Các thông tin thanh toán
        $vnp_TxnRef = '214323'; // Mã giao dịch duy nhất
        $vnp_OrderInfo = 'Thanh toán đơn hàng'; // Thông tin đơn hàng
        $vnp_OrderType = 'billpayment'; // Loại đơn hàng
        $vnp_Amount = 200000 * 100; // Số tiền thanh toán (đơn vị là VND, nhân với 100 để chuyển đổi sang "cents")
        $vnp_Locale = 'VN'; // Ngôn ngữ (VN cho tiếng Việt)
        $vnp_BankCode = 'NCB'; // Nếu không muốn chọn ngân hàng cụ thể, để trống để VNPAY tự chọn
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của người dùng
    
        // Dữ liệu gửi đến VNPAY
        $inputData = array(
            "vnp_Version" => "2.1.0", // Phiên bản VNPAY API
            "vnp_TmnCode" => $vnp_TmnCode, // Mã website
            "vnp_Amount" => $vnp_Amount, // Số tiền thanh toán
            "vnp_Command" => "pay", // Lệnh thanh toán
            "vnp_CreateDate" => date('YmdHis'), // Thời gian tạo giao dịch
            "vnp_CurrCode" => "VND", // Mã tiền tệ
            "vnp_IpAddr" => $vnp_IpAddr, // Địa chỉ IP của người dùng
            "vnp_Locale" => $vnp_Locale, // Ngôn ngữ
            "vnp_OrderInfo" => $vnp_OrderInfo, // Thông tin đơn hàng
            "vnp_OrderType" => $vnp_OrderType, // Loại giao dịch
            "vnp_ReturnUrl" => $vnp_Returnurl, // URL trả về sau khi thanh toán
            "vnp_TxnRef" => $vnp_TxnRef, // Mã giao dịch duy nhất
        );
    
        // Nếu muốn chọn ngân hàng cụ thể, thêm vào đây
        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
    
        // Sắp xếp lại các tham số theo thứ tự từ a-z
        ksort($inputData);
    
        // Tạo query string và hashdata
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
    
        // Thêm query string vào URL VNPAY
        $vnp_Url = $vnp_Url . "?" . $query;
    
        // Sinh mã bảo mật vnp_SecureHash
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Hàm băm SHA-512
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash; // Thêm mã bảo mật vào URL
        }
    
        // Trả về dữ liệu cho người dùng hoặc tự động chuyển hướng
        $returnData = array(
            'code' => '00', 
            'message' => 'success', 
            'data' => $vnp_Url
        );
    
        // Nếu có nút redirect, chuyển hướng đến VNPAY
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            // Nếu không, trả về URL dưới dạng JSON
            echo json_encode($returnData);
        }
    }
    
}