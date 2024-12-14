@extends('user.layouts.app')

@section('content')
<div class="order-success">
    <h1>Đặt hàng thành công!</h1>
    <p>Xin chào, <strong>{{ $userName }}</strong>.</p>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin đơn hàng của bạn:</p>

    <table class="table table-bordered">
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
    </table>

    <!-- <p><strong>Phí vận chuyển:</strong> {{ number_format($shippingFee, 0, ',', '.') }} VND</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($total, 0, ',', '.') }} VND</p> -->

    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
</div>
@endsection
