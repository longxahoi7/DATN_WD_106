@extends('user.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<h1>Chi tiết đơn hàng #{{ $order->id }}</h1>

<p><strong>Người đặt:</strong> {{ $order->user->name }}</p> <!-- Thêm tên người dùng -->
<p><strong>Địa chỉ:</strong> {{ $order->user->address }}</p> <!-- Thêm địa chỉ người dùng -->
<p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
<p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
<p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>

<h2>Sản phẩm trong đơn hàng</h2>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Màu sắc</th>
            <th>Kích cỡ</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-product.jpg') }}" alt="No Image" style="width: 50px; height: 50px;">
                @endif
            </td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->color ? $item->color->name : 'N/A' }}</td> <!-- Màu sắc -->
            <td>{{ $item->size ? $item->size->name : 'N/A' }}</td> <!-- Kích cỡ -->
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
