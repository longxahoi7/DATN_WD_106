@extends('user.layouts.app')

@section('content')
@if(session('alert'))
    <div class="alert alert-info" id="alert-message">
        {{ session('alert') }}
    </div>
@endif
    <div class="container">
        <h1>Thanh toán thành công!</h1>
        <p>Mã đơn hàng: {{ $order->order_id }}</p>
        <p>Trạng thái thanh toán: {{ $payment->status }}</p>
        <p>Ngày thanh toán: {{ $payment->payment_date }}</p>
        <a href="{{ route('home') }}">Quay lại trang chủ</a>
    </div>
@endsection