<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ApiPaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Xác thực người dùng
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để thực hiện thanh toán.'
            ], 401);
        }

        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Kiểm tra sự tồn tại của sản phẩm
        $productIds = collect($request->items)->pluck('product_id')->toArray();
        $products = Product::whereIn('product_id', $productIds)->get();

        // Nếu có sản phẩm không tồn tại, trả về thông báo lỗi
        if ($products->count() !== count($request->items)) {
            return response()->json([
                'success' => false,
                'message' => 'Một hoặc nhiều sản phẩm không tồn tại.'
            ], 404);
        }

        // Bắt đầu transaction
        DB::beginTransaction();

        try {
            // Tạo đơn hàng
            $order = new Order();
            $order->user_id = Auth::id(); // Lấy ID người dùng
            $order->order_date = now();
            $order->total = $request->total;
            $order->invoice_date = now();
            $order->payment_status = 'paid'; // Hoặc cập nhật theo logic thanh toán của bạn
            $order->status = 'pending'; // Trạng thái ban đầu
            $order->save();

            // Tạo các mục đơn hàng
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'], // Cần có giá
                ]);
            }

            // Commit transaction nếu không có lỗi
            DB::commit();

            // Phản hồi JSON
            return response()->json([
                'success' => true,
                'message' => 'Thanh toán thành công.',
                'order_id' => $order->order_id,
                'data' => [
                    'order_date' => $order->order_date,
                    'total' => $order->total,
                    'items' => $request->items,
                ],
            ], 201);

        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollback();
            
            // Trả về thông báo lỗi
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xử lý thanh toán.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}