@extends('layouts.app')

@section('content')
<h1>Your Cart</h1>
<table>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    @foreach ($cartItems as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->price }}</td>
    </tr>
    @endforeach
</table>
@endsection