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
    <div class="cart-items-section">
        <div class="cart-header">
            <hr class="divider-line">
            <span class="cart-title">{{ count($cartItems) }} sản phẩm</span>
        </div>
        <div class="cart-items-container">
            @foreach($cartItems as $item)
            <div class="product-card">
                <div class="product-image">
                    <a href="{{ route('user.product.detail', $item->product_id) }}" class="product-card-link">
                        <img src="/storage/{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}"
                            class="product-image-detail"
                            onerror="this.onerror=null; this.src='{{ asset('imagePro/image/no-image.png') }}';">
                    </a>
                </div>
                <div class="product-details">
                    <a href="{{ route('user.product.detail', $item->product_id) }}" class="product-card-link">
                        <p class="product-name mb-1">{{ $item->product->name }}</p>
                        @php
                        $attributeProduct = $item->product->attributeProducts->firstWhere('size_id',
                        $item->size_id);
                        @endphp
                        <span class="product-price">
                            {{ number_format($attributeProduct ? $attributeProduct->price : 0, 0, ',', '.') }} đ
                        </span>
                    </a>
                </div>
                <div class="product-attribute">
                    <div class="attribute" onclick="openPopup('{{ $item->id }}')">
                        <span>Phân loại hàng: ▼</span>
                    </div>
                    <span>{{ $item->color->name }}, {{ $item->size->name }}</span>
                    <p class="section-title">Số lượng: {{ $item->qty }}</p>
                </div>
                <div class="product-price-quantity">
                </div>
                <div class="product-total-cart mr-5">
                    <span>
                        {{ number_format(($attributeProduct ? $attributeProduct->price : 0) * $item->qty, 0, ',', '.') }} đ
                    </span>
                </div>
                <div class="popup-overlay" id="popupOverlay{{ $item->id }}" onclick="closePopup({{ $item->id }})">
                    <div class="popup-content" onclick="event.stopPropagation()">
                        <p>Màu sắc: </p>
                        <div class="color-options">
                            @foreach($item->attributeProducts->unique('color_id') as $attributeProduct)
                            <div class="color-option" style="background-color: {{ $attributeProduct->color->color_code }};"
                                onclick="changeColor({{ $item->id }}, '{{ $attributeProduct->color->color_id }}', this)">
                            </div>
                            @endforeach
                        </div>
                        <p class="section-title">Size:</p>
                        <div class="size-options">
                            @foreach($item->attributeProducts->unique('size_id') as $attributeProduct)
                            <button class="size-option" data-id="{{ $attributeProduct->size->size_id }}"
                                data-price="{{ $attributeProduct->price }}"
                                onclick="selectSize({{ $item->id }}, '{{ $attributeProduct->size->size_id }}', this)">
                                {{ $attributeProduct->size->name }}
                            </button>
                            @endforeach
                        </div>
                        <p class="section-title">Số lượng:</p>
                        <div class="quantity-container d-flex">
                            <div class="custom-quantity" onclick="changeQuantity({{ $item->id }}, -1)">-</div>
                            <input type="number" id="quantity{{ $item->id }}" name="display-qty" class="custom-quantity-input" min="1"
                                value="{{ $item->qty }}" onchange="updateQuantity({{ $item->id }}, this.value)">
                            <div class="custom-quantity" onclick="changeQuantity({{ $item->id }}, 1)">+</div>
                        </div>
                        <div class="popup-buttons text-end">
                            <button onclick="confirmSelection({{ $item->id }})">Xác nhận</button>
                            <button onclick="closePopup({{ $item->id }})">Hủy</button>
                        </div>
                    </div>
                </div>
                <div class="remove-btn">
                    <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-remove" onclick="confirm('Bạn có muốn xóa sản phẩm này hay không ?')">
                            <span class="icon-x">✖</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if($cartItems->isEmpty())
        @else
        <div class="cart-summary">
            <div class="summary-content">
                <span class="summary-title">Tổng đơn hàng({{ count($cartItems) }} sản phẩm):</span>
                <span class="summary-price">{{ number_format($finalTotal - 40000 , 0, ',', '.') }} đ</span>
            </div>
            <div class="container-checkout">
                <form action="{{ route('user.order.confirm') }}" method="POST" class="payment-form">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $finalTotal }}">
                    <button type="submit" class="custom-btn-cod">Thanh toán</button>
                </form>
            </div>
        </div>
        @endif

        @if($cartItems->isEmpty())
        <div class="empty-cart-container">
            <div class="empty-cart-icon">
                <img src="{{ asset('imagePro/icon/cart-image.png') }}" alt="Empty Cart">
            </div>
            <h2 class="empty-cart-title">"Hổng" có gì trong giỏ hết</h2>
            <p class="empty-cart-subtitle">Lướt Gentle Manor, lựa hàng ngay đi!</p>
            <a href="/product/product-list" class="btn btn-no-cart-user">Mua sắm ngay!</a>
        </div>
        @endif
    </div>
</div>

<script>
    function openPopup(itemId) {
        document.getElementById('popupOverlay' + itemId).style.display = 'block';
    }

    function closePopup(itemId) {
        document.getElementById('popupOverlay' + itemId).style.display = 'none';
    }

    function confirmSelection(itemId) {
        const colorId = selectedColor[itemId];
        const sizeId = selectedSize[itemId];
        const quantity = document.getElementById('quantity' + itemId).value;
        if (!colorId || !sizeId || quantity < 1) {
            let message = '';
            if (!colorId) {
                message += 'Vui lòng chọn màu sắc.\n';
            }
            if (!sizeId) {
                message += 'Vui lòng chọn kích thước.\n';
            }
            if (quantity < 1) {
                message += 'Vui lòng chọn số lượng hợp lệ.\n';
            }
            alert(message);
            return;
        }

        fetch('{{ route('user.cart.cupdate', ['id' => ':itemId']) }}'.replace(':itemId', itemId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        color_id: colorId,
                        size_id: sizeId,
                        quantity: quantity
                    })
                })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra: ' + data.message);
                }
            })
            .catch(error => {
                alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
            });

        closePopup(itemId);
    }

    let selectedColor = {};
    let selectedSize = {};

    function selectSize(itemId, sizeId, element) {
        selectedSize[itemId] = sizeId;
        const sizeOptions = document.querySelectorAll(`#popupOverlay${itemId} .size-option`);
        sizeOptions.forEach(option => option.classList.remove('selected'));
        element.classList.add('selected');

        // Cập nhật giá sau khi thay đổi kích thước
        updatePrice(itemId);
    }

    function changeColor(itemId, colorId, element) {
        selectedColor[itemId] = colorId;
        const colorOptions = document.querySelectorAll(`#popupOverlay${itemId} .color-option`);
        colorOptions.forEach(option => option.classList.remove('selected'));
        element.classList.add('selected');

        // Cập nhật giá sau khi thay đổi màu sắc
        updatePrice(itemId);
    }

    function changeQuantity(itemId, change) {
        const quantityInput = document.getElementById('quantity' + itemId);
        let newQuantity = parseInt(quantityInput.value) + change;

        // Đảm bảo số lượng luôn lớn hơn hoặc bằng 1
        if (newQuantity < 1) {
            newQuantity = 1;
        }

        quantityInput.value = newQuantity;
        updateQuantity(itemId, newQuantity);
    }
</script>






@endsection
