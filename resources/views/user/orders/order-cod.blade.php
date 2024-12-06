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
