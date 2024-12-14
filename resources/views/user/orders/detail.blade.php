@extends('user.index')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/accountAndOrder/order.css') }}">
@endpush

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container">
    <div class="row-order">
        <!-- Bên trái: Menu -->
        <div class="col-md-3 menu-left">
            @include('user.components.navbarOrderHistory')
        </div>

        <!-- Bên phải: Chi tiết đơn hàng -->
        <div class="col-md-9 order-right">
            <div class="button-header">
                <button>
                    Chi tiết đơn hàng <i class="fa fa-star"></i>
                </button>
            </div>

            <!-- Thẻ đầu tiên: Thông tin nhận hàng -->
            <div class="row-custom-info">
                <div class="info-receive">
                    <p><i class="fa fa-map-marker-alt"></i> Thông tin nhận hàng</p>
                    <div class="details">
                        <p><strong>Người nhận:</strong> {{ $order->user->name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->user->phone }}</p>
                        <p><strong>Nhận tại:</strong> {{ $order->shipping_andress }}</p>
                    </div>
                </div>

                <!-- Thẻ thứ 2: Hình thức thanh toán -->
                <div class="payment-info">
                    <div class="details d-flex">
                        <p><i class="fa fa-credit-card mr-2"></i> <strong> Hình thức thanh toán: </strong>
                            </p>
                        <p>
                            @if($order->payment_method == 'COD')
                            Thanh toán khi nhận hàng
                            @else($order->payment_method == 'VNPAY')
                            VNPAY
                            @endif
                        </p>
                    </div>
                    <strong>Trạng thái đơn hàng :</strong>
                    <p>{{$order->status}} </p>
                </div>
            </div>

            <!-- Thẻ thứ 3: Thông tin sản phẩm -->
            <div class="product-info">
                <div class="details">
                    <h2><i class="fa fa-shopping-cart"></i>Sản phẩm trong đơn hàng</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->product->image)
                                    <img src="/storage/{{ $item->product->main_image_url }}"
                                        alt="{{ $item->product->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                    <img src="/storage/{{ $item->product->main_image_url }}" alt="No Image"
                                        style="width: 50px; height: 50px;">
                                    @endif
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->color ? $item->color->name : 'N/A' }}</td>
                                <td>{{ $item->size ? $item->size->name : 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="6">Tổng</td>
                                <td>{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}
                                    VND</td>
                            </tr>
                            <tr>
                                <td colspan="6">Phí Ship</td>
                                <td>40,000 VND</td>
                            </tr>
                            <tr>
                                <td colspan="6">Tổng cộng</td>
                                <td>{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }) + 40000, 0, ',', '.') }}
                                    VND</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection