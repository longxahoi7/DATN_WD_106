@extends('user.index') <!-- Thay bằng layout chính của bạn -->

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Xác Nhận Đơn Hàng</h1>

    <!-- Thông Tin Người Nhận -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Thông Tin Người Nhận
        </div>
        <div class="card-body">
            <form id="orderForm" action="{{ route('user.order.checkoutcod') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input name="shipping_address" id="shipping_address" class="form-control" required value="{{ old('shipping_address', $user->address ?? '') }}"></input>
                </div>
                <!-- Danh sách sản phẩm -->
                <div class="card mt-4">
                    <div class="card-header bg-secondary text-white">
                        Sản Phẩm Trong Đơn Hàng
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productDetails as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['color'] }}</td>
                                    <td>{{ $product['size'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>{{ number_format($product['price'], 0, ',', '.') }} VND</td>
                                    <td>{{ number_format($shippingFee, 0, ',', '.') }} VND</td>
                                    <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng Cộng:</th>
                                    <th>{{ number_format($total, 0, ',', '.') }} VND</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Nút xác nhận -->
                <div class="text-center mt-4">
                    <input type="hidden" name="amount" value="{{ $total }}">
                    <button type="submit" class="btn btn-success btn-lg">Xác Nhận Đặt Hàng</button>
                    <button name="redirect" type="button" id="btnVnPay" class="btn btn-success btn-lg">Thanh Toán VNPay</button>
                    <a href="{{ route('user.cart.index') }}" class="btn btn-secondary btn-lg">Quay Lại Giỏ Hàng</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form ẩn cho VNPay -->
<form id="vnpayForm" action="{{ route('checkout.vnpay') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}">
    <input type="hidden" name="name" id="vnpayName" value="{{ old('name', $user->name ?? '') }}">
    <input type="hidden" name="phone" id="vnpayPhone" value="{{ old('phone', $user->phone ?? '') }}">
    <input type="hidden" name="shipping_address" id="vnpayAddress" value="{{ old('shipping_address', $user->address ?? '') }}">
    <input type="hidden" name="redirect" value="1">
</form>

<script>
   document.getElementById('btnVnPay').addEventListener('click', function() {
    const form = document.getElementById('vnpayForm');
    form.submit(); // Gửi form đến VNPay
});
</script>
@endsection