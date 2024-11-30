@extends('layouts.app')

@section('title', 'Danh sách đơn hàng')

@section('content')
<h1>Danh sách đơn hàng</h1>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Ngày đặt</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Chi tiết</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
            <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td><a href="{{ route('user.orders.show', $order->order_id) }}" class="btn btn-primary">Xem</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
