@extends('user.layouts.app')

@section('content')
@if(session('alert'))
    <div class="alert alert-info" id="alert-message">
        {{ session('alert') }}
    </div>
@endif
    <div class="container">
        <h1>Thanh toán thất bại!</h1>
        <p>Mã đơn hàng: {{ $order->order_id }}</p>
        <p>Trạng thái thanh toán: {{ $payment->status }}</p>
        <p>Lý do: {{ $error }}</p>
        <a href="{{ route('users.cart') }}">Quay lại giỏ hàng</a>
    </div>
@endsection
