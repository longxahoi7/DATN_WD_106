@extends("user.index")

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chiTietGioHang.css') }}">
@endpush

@section("content")
<div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" />
                                    </th>
                                    <th class="pro-thumbnail">Hình ảnh sản phẩm</th>
                                    <th class="pro-title">Sản phẩm</th>
                                    <th class="pro-price">Giá</th>
                                    <th class="pro-quantity">Số lượng</th>
                                    <th class="pro-subtotal">Tổng</th>
                                    <th class="pro-remove">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($cartItems) && $cartItems->isNotEmpty())
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" />
                                        </td>
                                        <td class="pro-thumbnail">
                                            <a href="#">
                                            <img src="{{$item->product->main_image_url }}" 
                                            alt="{{ $item->product->name }}" width="100">

                                            </a>
                                        </td>
                                        <td class="pro-title">
                                            <a href="#">{{ $item->product->name }}</a>
                                        </td>
                                        <td class="pro-price">
                                            @php
                                                $attributeProduct = $item->product->attributeProducts->first();
                                            @endphp
                                            <span>
                                                {{ number_format($attributeProduct ? $attributeProduct->price : 0, 0, ',', '.') }} VND
                                            </span>
                                        </td>
                                        <td class="pro-quantity">
                                            <div class="quantity-control">
                                                <button class="btn-update-quantity" data-action="decrease" data-id="{{ $item->id }}">-</button>
                                                <input type="text" value="{{ $item->qty }}" readonly />
                                                <button class="btn-update-quantity" data-action="increase" data-id="{{ $item->id }}">+</button>
                                            </div>
                                        </td>
                                        <td class="pro-subtotal">
                                            <span>
                                                {{ number_format($item->qty * ($attributeProduct ? $attributeProduct->price : 0), 0, ',', '.') }} VND
                                            </span>
                                        </td>
                                        <td class="pro-remove">
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Giỏ hàng của bạn đang trống.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class="d-block d-md-flex">
                                <input type="text" placeholder="Vui lòng nhập mã giảm giá" required />
                                <button class="btn btn-sqr">Áp dụng mã giảm giá</button>
                            </form>
                        </div>
                        <div class="cart-update">
                            <a href="#" class="btn btn-sqr">Cập nhật giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h6>Tổng đơn hàng</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng giá sản phẩm</td>
                                            <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td>70,000 VND</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng chi phí</td>
                                            <td class="total-amount">{{ number_format($total + 70000, 0, ',', '.') }} VND</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="" class="btn btn-sqr d-block">Thanh toán COD</a><br>
                        <a href="" class="btn btn-sqr d-block">Thanh toán VNPAY</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
