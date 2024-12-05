@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<h1>Chi tiết đơn hàng #{{ $order->id }}</h1>

<p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
<p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
<p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>

<h2>Sản phẩm trong đơn hàng</h2>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
