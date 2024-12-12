<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class PaymentVnPayController extends Controller
{
    //
    public function vnp_payment(Request $request)
{
    // Lấy dữ liệu từ request
    $data = $request->all();
    // Tạo đơn hàng
    $order = Order::create([
        'user_id' => Auth::id(),
        'order_date' => now(),
        'status' => 'pending', // Trạng thái mặc định là pending
        'total' => $data['amount'],
        'invoice_date' => now(),
        'payment_status' => 'pending', // Chưa thanh toán
    ]);
    $order_id = $order->order_id;
    // Các thông tin cần thiết cho VNPAY
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL VNPAY
    $vnp_Returnurl = route('vnpay.callback'); // URL trả về sau khi thanh toán
    $vnp_TmnCode = "L86V10FV"; // Mã website của bạn tại VNPAY
    $vnp_HashSecret = "UG0UNZZI4B5W1R0UMAAA4QBVU77GQN46"; // Khóa bí mật của bạn tại VNPAY

    // Các thông tin thanh toán
    $vnp_TxnRef = $order_id; // Mã giao dịch duy nhất, có thể dùng thời gian
    $vnp_OrderInfo = 'Thanh toán đơn hàng'; // Thông tin đơn hàng
    $vnp_OrderType = 'billpayment'; // Loại giao dịch
    $vnp_Amount = $data['amount'] * 100; // Số tiền thanh toán, nhân với 100 vì VNPAY yêu cầu tiền tệ là VND
    $vnp_Locale = 'VN'; // Ngôn ngữ
    $vnp_BankCode = 'NCB'; // Mã ngân hàng (có thể bỏ qua nếu không chọn ngân hàng cụ thể)
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // Địa chỉ IP của người dùng

    // Dữ liệu gửi đến VNPAY
    $inputData = [
        "vnp_Amount" => $vnp_Amount, // Số tiền thanh toán
        "vnp_Command" => "pay", // Lệnh thanh toán
        "vnp_CreateDate" => date('YmdHis'), // Thời gian tạo giao dịch
        "vnp_CurrCode" => "VND", // Mã tiền tệ
        "vnp_IpAddr" => $vnp_IpAddr, // Địa chỉ IP của người dùng
        "vnp_Locale" => $vnp_Locale, // Ngôn ngữ
        "vnp_OrderInfo" => $vnp_OrderInfo, // Thông tin đơn hàng
        "vnp_OrderType" => $vnp_OrderType, // Loại giao dịch
        "vnp_ReturnUrl" => $vnp_Returnurl, // URL trả về sau khi thanh toán
        "vnp_TmnCode" => $vnp_TmnCode, // Mã website của bạn tại VNPAY
        "vnp_TxnRef" => $vnp_TxnRef, // Mã giao dịch duy nhất
        "vnp_Version" => "2.1.0", // Phiên bản API của VNPAY
    ];

    // Nếu có mã ngân hàng cụ thể, thêm vào đây
    if (!empty($vnp_BankCode)) {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    // Sắp xếp các tham số theo thứ tự từ a-z
    ksort($inputData);

    // Tạo chuỗi query string và hashdata
    $query = "";
    $hashdata = "";
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

    // Tạo URL VNPAY với query string đã tạo
    $vnp_Url = $vnp_Url . "?" . $query;

    // Tính toán mã bảo mật vnp_SecureHash
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Hàm băm SHA-512
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash; // Thêm mã bảo mật vào URL
    }

    // Trả về dữ liệu hoặc tự động chuyển hướng tới VNPAY
    $returnData = [
        'code' => '00',
        'message' => 'success',
        'data' => $vnp_Url // URL chuyển hướng tới VNPAY
    ];

    // Nếu có nút redirect, chuyển hướng đến VNPAY
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        // Nếu không, trả về URL dưới dạng JSON
        echo json_encode($returnData);
    }
}



public function handleVNPayCallback(Request $request)
{
    $vnp_HashSecret = "UG0UNZZI4B5W1R0UMAAA4QBVU77GQN46"; // Secret Key của bạn
    $data = $request->all();

    // Lấy chữ ký số từ callback
    $vnp_SecureHash = $data['vnp_SecureHash'];
    unset($data['vnp_SecureHash']); // Loại bỏ vnp_SecureHash khỏi dữ liệu callback

    // Sắp xếp tham số theo thứ tự từ a-z
    ksort($data);

    // Tạo chuỗi hash
    $hashData = '';
    foreach ($data as $key => $value) {
        if ($key != 'vnp_SecureHash' && $value != '') {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
    }
    // Loại bỏ ký tự '&' cuối cùng
    $hashData = rtrim($hashData, '&');

    // Sinh mã bảo mật (secureHash)
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    // Log chuỗi hash và secureHash
    Log::info('HashData: ' . $hashData);
    Log::info('Generated SecureHash: ' . $secureHash);
    Log::info('VNPAY SecureHash: ' . $vnp_SecureHash);

    // Kiểm tra chữ ký
    if ($secureHash !== $vnp_SecureHash) {
        Log::error('Chữ ký số không hợp lệ.');
        return redirect()->route('users.cart')->with('error', 'Chữ ký số không hợp lệ.');
    }

    // Tiến hành xử lý sau khi xác thực chữ ký hợp lệ
    try {
        // Kiểm tra mã giao dịch (TxnRef) trong cơ sở dữ liệu
        $order = Order::find($data['vnp_TxnRef']);

        if (!$order) {
            Log::error('Không tìm thấy đơn hàng với mã giao dịch: ' . $data['vnp_TxnRef']);
            return redirect()->route('users.cart')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Kiểm tra mã trạng thái giao dịch
        $paymentStatus = $data['vnp_ResponseCode'] == '00' ? 'paid' : 'failed';

        // Cập nhật trạng thái thanh toán cho đơn hàng
        $order->update([
            'payment_status' => $paymentStatus,
            'status' => $paymentStatus == 'paid' ? 'completed' : 'pending', // Hoàn thành hoặc vẫn chờ
            'payment_date' => now(),
        ]);

        // Cập nhật trạng thái thanh toán trong bảng Payment (nếu có)
        $payment = Payment::where('order_id', $order->order_id)->first();
        if ($payment) {
            $payment->update([
                'status' => $paymentStatus,
            ]);
        }

        // Thông báo kết quả giao dịch
        if ($paymentStatus == 'paid') {
            Log::info('Thanh toán thành công cho đơn hàng: ' . $order->order_id);
            ShoppingCart::where('user_id', Auth::id())->delete();
            return redirect()->route('home')->with('success', 'Thanh toán thành công!');
        } else {
            Log::info('Thanh toán thất bại cho đơn hàng: ' . $order->order_id);
            return redirect()->route('user.cart.index')->with('error', 'Thanh toán thất bại.');
        }
    } catch (\Exception $e) {
        // Log lỗi nếu có
        Log::error('VNPAY Callback Error: ' . $e->getMessage());
        return redirect()->route('users.cart')->with('error', 'Đã xảy ra lỗi trong quá trình xử lý.');
    }
}


}
