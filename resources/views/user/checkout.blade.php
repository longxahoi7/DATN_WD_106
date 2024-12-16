@extends('layouts.app')

@section('content')
<h1>Checkout</h1>
<p>Order Total: {{ $total }}</p>
<form action="{{ route('user.checkout') }}" method="POST">
    @csrf
    <button type="submit">Place Order</button>
</form>
@endsection