@extends('user.index')

<link href="{{ asset('css/productList.css') }}" rel="stylesheet" type="text/css">

@section('content')
<div class="container mt-5">
    <div class="button-header mt-5">
        <button>
            Gentle Manor - Danh sách sản phẩm <i class="fa fa-star"></i>
        </button>
    </div>
    @if(session('alert'))
    <div class="alert alert-info" id="alert-message">
        {{ session('alert') }}
    </div>
    @endif
    <div class="product-list">
        <div class="filter-container mb-4 d-flex justify-content-between align-items-center">
            <div class="filter-product-new">
                <a href="#" class="custom-btn-product-new">Mới nhất</a>
            </div>
            <div class="filter-product-new">
                <a href="#" class="custom-btn-product-new">Bán chạy</a>
            </div>
            <div class="filter-group">
                <select class="form-select filter-select" id="filterCategory">
                    <option value="">Giá</option>
                    <option value="high">Giá cao đến thấp</option>
                    <option value="low">Giá thấp đến cao</option>
                </select>
            </div>
        </div>
        <div class="product-items">
            @if(isset($listProduct) && $listProduct->isNotEmpty())
            @foreach ($listProduct as $product)
            <div class="product-card">
                <a href="{{ route('user.product.detail', $product->product_id) }}" class="product-card-link">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->main_image_url) }}" alt="{{ $product->name }}"
                            class="product-image"
                            onerror="this.onerror=null; this.src='{{ asset('imagePro/image/no-image.png') }}';">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="product-info">
                                @php
                                $prices = $product->attributeProducts->pluck('price');
                                $originalMinPrice = $prices->min() ?? 0;
                                $originalMaxPrice = $prices->max() ?? 0;

                                $minPrice = $originalMinPrice;
                                $maxPrice = $originalMaxPrice;

                                $promotion = $product->promPerProducts
                                    ->sortByDesc('created_at')
                                    ->first()?->promPer;

                                if ($promotion) {
                                    if ($promotion->discount_amount) {
                                        $minPrice = max(0, $originalMinPrice - $promotion->discount_amount);
                                        $maxPrice = max(0, $originalMaxPrice - $promotion->discount_amount);
                                    } elseif ($promotion->discount_percentage) {
                                        $minPrice = max(0, $originalMinPrice * (1 - $promotion->discount_percentage / 100));
                                        $maxPrice = max(0, $originalMaxPrice * (1 - $promotion->discount_percentage / 100));
                                    }
                                }
                                @endphp
                                <span class="product-price">
                                    @if ($promotion)
                                    <s>{{ number_format($originalMinPrice, 0, ',', '.') }} - {{ number_format($originalMaxPrice, 0, ',', '.') }} VND</s>
                                    <br>
                                    <strong>{{ number_format($minPrice, 0, ',', '.') }} - {{ number_format($maxPrice, 0, ',', '.') }} VND</strong>
                                    @else
                                    {{ number_format($originalMinPrice, 0, ',', '.') }} - {{ number_format($originalMaxPrice, 0, ',', '.') }} VND
                                    @endif
                                </span>
                                <a href="{{ route('user.product.detail', $product->product_id) }}" class="cart-icon">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @elseif(isset($products) && $products->isNotEmpty())
            @foreach ($products as $product)
            <div class="product-card">
                <a href="{{ route('user.product.detail', $product->product_id) }}" class="product-card-link">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->main_image_url) }}" alt="{{ $product->name }}"
                            class="product-image"
                            onerror="this.onerror=null; this.src='{{ asset('imagePro/image/no-image.png') }}';">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="product-info">
                                @php
                                $prices = $product->attributeProducts->pluck('price');
                                $originalMinPrice = $prices->min() ?? 0;
                                $originalMaxPrice = $prices->max() ?? 0;

                                $minPrice = $originalMinPrice;
                                $maxPrice = $originalMaxPrice;

                                $promotion = $product->promPerProducts
                                    ->sortByDesc('created_at')
                                    ->first()?->promPer;

                                if ($promotion) {
                                    if ($promotion->discount_amount) {
                                        $minPrice = max(0, $originalMinPrice - $promotion->discount_amount);
                                        $maxPrice = max(0, $originalMaxPrice - $promotion->discount_amount);
                                    } elseif ($promotion->discount_percentage) {
                                        $minPrice = max(0, $originalMinPrice * (1 - $promotion->discount_percentage / 100));
                                        $maxPrice = max(0, $originalMaxPrice * (1 - $promotion->discount_percentage / 100));
                                    }
                                }
                                @endphp
                                <span class="product-price">
                                    @if ($promotion)
                                    <s>{{ number_format($originalMinPrice, 0, ',', '.') }} - {{ number_format($originalMaxPrice, 0, ',', '.') }} VND</s>
                                    <br>
                                    <strong>{{ number_format($minPrice, 0, ',', '.') }} - {{ number_format($maxPrice, 0, ',', '.') }} VND</strong>
                                    @else
                                    {{ number_format($originalMinPrice, 0, ',', '.') }} - {{ number_format($originalMaxPrice, 0, ',', '.') }} VND
                                    @endif
                                </span>
                                <a href="{{ route('user.product.detail', $product->product_id) }}" class="cart-icon">
                                    <i class="fa fa-info-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <!-- Nếu cả listProduct và products đều không có sản phẩm -->
            <div class="center-container">
                <img src="{{asset('imagePro/icon/icon-no-search-product.png')}}" alt="No results found" class="center-img">
                <h5>Không tìm thấy kết quả nào</h5>
                <p>Hãy sử dụng các từ khóa chung hơn</p>
            </div>
            @endif
        </div>
    </div>
    @endsection
