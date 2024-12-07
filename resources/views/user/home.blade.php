@extends('user.index')

@section('content')

<style>
.button-header {
    width: 95%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
}

.button-header button {
    background-color: black;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    text-transform: uppercase;
    cursor: pointer;
    border-radius: 75px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.no-product-message {
    color: #28a745;
    text-align: center;
    font-size: 18px;
    margin-top: 20px;
}

.button-header button i {
    font-size: 18px;
}

.button-header button .fa-star {
    font-size: 18px;
}

/* Khi sản phẩm không có ảnh */
.no-image {
    width: 100%;
    height: 200px;
    background-size: cover;
    background-position: center;
    display: flex;
    background-color: gray;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.no-image-text {
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px;
}

/* Container của carousel */
.product-carousel {
    width: 100%;
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 20px;
}

.product-slide {
    display: inline-flex;
}

.product-item {
    width: 230px;
    box-sizing: border-box;
    margin-right: 15px;
}

.card {
    width: 100%;
}

/* Căn chỉnh giá sản phẩm và icon giỏ hàng */
.product-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.product-price {
    color: #d84e00;
    /* Màu cam đỏ */
    font-size: 16px;
    font-weight: bold;
}

.cart-icon {
    color: #d84e00;
    /* Màu cam đỏ */
    font-size: 20px;
    cursor: pointer;
}

.cart-icon:hover {
    color: #c74200;
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-card-link {
    text-decoration: none;
    color: inherit;
}

.product-card-link:hover .card {
    animation: shake 0.3s ease-in-out;
}

@keyframes shake {
    0% {
        transform: translateX(0);
    }

    25% {
        transform: translateX(-5px);
    }

    50% {
        transform: translateX(5px);
    }

    75% {
        transform: translateX(-5px);
    }

    100% {
        transform: translateX(0);
    }
}

.product-item {
    transition: box-shadow 0.3s ease-in-out;
}

.product-item:hover {
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
}

.product-card-link:hover {
    text-decoration: none;
    color: black;
}
</style>

<div class="container mb-5">
    <!-- Sản phẩm bán chạy -->
    <div class="button-header mt-5">
        <button>
            Gentle Manor - Sản phẩm bán chạy <i class="fa fa-star"></i>
        </button>
    </div>
    <div class="row">
        @if($productSoldCount->isEmpty())
        <p class="no-product-message">Không tìm thấy sản phẩm bán chạy.</p>
        @else
        @foreach($productSoldCount as $soldProduct)
        <div class="col-md-3 mb-4">
            <div class="product-item">
                <!-- Thêm class 'product-item' -->
                <a href="{{ route('product.detail', $soldProduct->product_id) }}" class="product-card-link">
                    <div class="card">
                        <img src="{{ $soldProduct->main_image_url }}" class="card-img-top"
                            alt="{{ $soldProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $soldProduct->name }}</h5>
                            @php
                            // Lấy danh sách giá của sản phẩm
                            $prices = $soldProduct->attributeProducts->pluck('price');
                            $minPrice = $prices->min();
                            $maxPrice = $prices->max();
                            @endphp
                            <p>
                                Giá:
                                @if ($minPrice == $maxPrice)
                                {{ number_format($minPrice, 0, ',', '.') }} VND
                                @else
                                {{ number_format($minPrice, 0, ',', '.') }} -
                                {{ number_format($maxPrice, 0, ',', '.') }} VND
                                @endif
                            </p>
                            <a href="{{ route('product.detail', $soldProduct->product_id) }}" class="detail-btn">
                                <i class="fa fa-info-circle"></i> Chi tiết
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <!-- Sản phẩm hot -->
    <div class="button-header mt-5">
        <button>
            Gentle Manor - Sản phẩm hot <i class="fa fa-star"></i>
        </button>
    </div>
    <div class="row">
        @if($productHot->isEmpty())
        <p class="no-product-message">Không tìm thấy sản phẩm hot.</p>
        @else
        @foreach($productHot as $hotProduct)
        <div class="col-md-3 mb-4">
            <div class="product-item">
                <!-- Thêm class 'product-item' -->
                <a href="{{ route('product.detail', $hotProduct->product_id) }}" class="product-card-link">
                    <div class="card">
                        <img src="{{ $hotProduct->main_image_url }}" class="card-img-top" alt="{{ $hotProduct->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotProduct->name }}</h5>
                            @php
                            // Lấy danh sách giá của sản phẩm
                            $prices = $hotProduct->attributeProducts->pluck('price');
                            $minPrice = $prices->min();
                            $maxPrice = $prices->max();
                            @endphp
                            <p>
                                Giá:
                                @if ($minPrice == $maxPrice)
                                {{ number_format($minPrice, 0, ',', '.') }} VND
                                @else
                                {{ number_format($minPrice, 0, ',', '.') }} -
                                {{ number_format($maxPrice, 0, ',', '.') }} VND
                                @endif
                            </p>
                            <a href="{{ route('product.detail', $hotProduct->product_id) }}" class="detail-btn">
                                <i class="fa fa-info-circle"></i> Chi tiết
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        @endif
    </div>


    <!-- Danh sách sản phẩm -->
    <div class="button-header mt-5">
        <button>
            Gentle Manor - Danh sách sản phẩm <i class="fa fa-star"></i>
        </button>
    </div>
    <div class="row">
        <div class="product-carousel">
            @if($listProduct->isEmpty())
            <p class="no-product-message">Không tìm thấy sản phẩm trong danh sách.</p>
            @else
            <div class="product-slide">
                @foreach($listProduct as $product)
                <div class="product-item">
                    <a href="{{ route('product.detail', $product->product_id) }}" class="product-card-link">
                        <div class="card">
                            <!-- Kiểm tra nếu sản phẩm không có ảnh -->
                            @if($product->main_image_url)
                            <img src="{{ Storage::url($product->main_image_url) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                            @else
                            <!-- Sử dụng background khi không có ảnh -->
                            <div class="no-image" style="background-image: url('path_to_default_image.jpg');">
                                <p class="no-image-text">Sản phẩm không có ảnh</p>
                            </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <div class="product-info">
                                    @php
                                    // Lấy danh sách giá của sản phẩm
                                    $prices = $product->attributeProducts->pluck('price');
                                    $minPrice = $prices->min();
                                    $maxPrice = $prices->max();
                                    @endphp
                                    <span class="product-price">
                                        @if ($minPrice == $maxPrice)
                                        {{ number_format($minPrice, 0, ',', '.') }} VND
                                        @else
                                        {{ number_format($minPrice, 0, ',', '.') }} -
                                        {{ number_format($maxPrice, 0, ',', '.') }} VND
                                        @endif
                                    </span>
                                    <a href="{{ route('product.detail', $product->product_id) }}" class="cart-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>


</div>







@endsection