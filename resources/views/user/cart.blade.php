@extends('user.index')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<div class="button-header mt-3">
    <button>
        Gentle Manor - Giỏ hàng <i class="fa fa-star"></i>
    </button>
</div>
<div class="cart-container">
    <!-- Phần giỏ hàng bên trái -->
    <div class="cart-items-section">
        <div class="cart-header">
            <hr class="divider-line">
            <span class="cart-title">{{ count($cartItems) }} sản phẩm</span>
        </div>
        <div class="cart-items-container">
            @foreach($cartItems as $item)
            <div class="product-card">
                <div class="product-image">
                    <img src="/storage/{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}"
                        class="product-image-detail"
                        onerror="this.onerror=null; this.src='{{ asset('imagePro/image/no-image.png') }}';">
                </div>
                <div class="product-details">
                    <div class="card-details" onclick="openPopup('{{ $item->id }}')">
                        <h5 class="product-name">{{ $item->product->name }}</h5>
                        <div class="attribute hover-info">
                            <span>Màu: {{ $item->color->name }}</span>
                            <span>Kích thước: {{ $item->size->name }} ▼</span>
                        </div>
                    </div>
                    <div class="popup-overlay" id="popupOverlay" onclick="closePopup()">
                        <div class="popup-content" onclick="event.stopPropagation()">
                            <p>Màu sắc: </p>
                            <div class="color-options">
                                @foreach($item->attributeProducts as $attributeProduct)
                                <div class="color-option"
                                    style="background-color: {{ $attributeProduct->color->name }};"
                                    onclick="changeColor('{{ $attributeProduct->color->color_id }}', this)">
                                </div>
                                @endforeach
                            </div>
                            <p class="section-title">Size:</p>
                            <div class="size-options">
                                @foreach($item->attributeProducts->unique('size_id') as $attributeProduct)
                                <button class="size-option" data-id="{{ $attributeProduct->size->size_id }}"
                                    data-price="{{ $attributeProduct->price }}"
                                    onclick="selectSize('{{ $attributeProduct->size->size_id }}', this)">
                                    {{ $attributeProduct->size->name }}
                                </button>
                                @endforeach
                            </div>
                            <p class="section-title">Số lượng:</p>
                            <div class="quantity-container d-flex">
                                <div class="custom-quantity" onclick="changeQuantity(-1, '{{ $item->id }}')">-</div>
                                <input type="number" name="display-qty" class="custom-quantity-input" min="1"
                                    value="{{ $item->qty }}" onchange="updateQuantity(this.value, '{{ $item->id }}')">
                                <div class="custom-quantity" onclick="changeQuantity(1, '{{ $item->id }}')">+</div>
                            </div>
                            <div class="popup-buttons">
                                <button onclick="confirmSelection()">Xác nhận</button>
                                <button onclick="closePopup()">Hủy</button>
                            </div>
                        </div>
                    </div>
                    <div class="quantity-container d-flex">
                        <div class="custom-quantity" onclick="changeQuantity(-1, '{{ $item->id }}')">-</div>
                        <input type="number" name="display-qty" class="custom-quantity-input" min="1"
                            value="{{ $item->qty }}" onchange="updateQuantity(this.value, '{{ $item->id }}')">
                        <div class="custom-quantity" onclick="changeQuantity(1, '{{ $item->id }}')">+</div>
                    </div>
                </div>
                <div class="remove-btn">
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-remove">
                            <span class="icon-x">✖</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Phần thông tin giỏ hàng bên phải -->
    <div class="cart-summary-section">
        <div class="cart-summary">
            <!-- Tiêu đề thông tin đơn hàng -->
            <h3 class="order-title">Thông tin đơn hàng</h3>
            <table>
                <tr>
                    <th>Tạm tính:</th>
                    <td>{{ number_format($total, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Giảm giá:</th>
                    <td>{{ number_format($discount, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Phí vận chuyển:</th>
                    <td>{{ number_format($shippingFee, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Tổng cộng:</th>
                    <td>{{ number_format($finalTotal, 0, ',', '.') }} VND</td>
                </tr>
            </table>

            <!-- Mục nhập mã giảm giá -->
            <div class="discount-section">
                <input type="text" id="discount-code" name="discount_code" placeholder="Nhập mã giảm giá">
                <button class="btn btn-link">Xem tất cả</button>
            </div>

            <!-- Ghi chú đơn hàng -->
            <div class="note-section">
                <label for="order-note">Ghi chú đơn hàng:</label>
                <textarea id="order-note" name="order_note" placeholder="Nhập ghi chú cho đơn hàng"></textarea>
            </div>

            <!-- Thêm các nút thanh toán -->
            <div class="container-checkout">
                <form action="{{ route('user.order_confirm') }}" method="POST" class="payment-form">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $finalTotal }}">
                    <button type="submit" class="custom-btn-cod">Thanh toán COD</button>
                </form>
                <form action="{{ route('checkout.vnpay') }}" method="post">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $finalTotal }}">
                    <button type="submit" name="redirect" class="custom-btn-checkout">Thanh toán VNPay</button>
                </form>
            </div>
            <a href="/product-list" class="continue-shopping">
                <i class="fa fa-arrow-left"></i> Tiếp tục mua hàng
            </a>
        </div>
    </div>
</div>

<script>
function openPopup(id) {
    document.getElementById('popupOverlay').style.display = 'block';
}

function closePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
}

function confirmSelection() {
    closePopup();
}
</script>



@endsection