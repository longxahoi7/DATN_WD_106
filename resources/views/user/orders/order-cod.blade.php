@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2>Thank you for your order!</h2>
    <p>Your order #{{ $order->order_id }} has been successfully processed.</p>
    <p>Payment Amount: {{ number_format($order->payment->amount, 2) }} VND</p>
    <p>Payment Method: {{ $order->payment->payment_method }}</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Go back to Home</a>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã đặt hàng. Dưới đây là thông tin chi tiết đơn hàng của bạn:</p>

    <h4>Mã đơn hàng: {{ $order->id }}</h4>
    <h4>Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} VND</h4>
    <h4>Phương thức thanh toán: {{ $order->payment_status }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
</div>
@endsection
