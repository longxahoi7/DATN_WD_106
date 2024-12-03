@extends('user.layouts.app')

@section('content')
<h1>Your Shopping Cart</h1>

@if($cartItems && $cart->items->isNotEmpty())
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>${{ number_format($item->product->price * $item->qty, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> ${{ number_format($cart->items->sum(fn($item) => $item->product->price * $item->qty), 2) }}</p>
@else
    <p>Your cart is empty.</p>
@endif
@endsection