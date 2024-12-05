@extends('user.layouts.app')

@section('content')

<div class="container">
    <h2 class="mt-5">Sản phẩm bán chạy</h2>
    <div class="row">
        @foreach($productSoldCount as $soldProduct)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ $soldProduct->main_image_url }}" class="card-img-top" alt="{{ $soldProduct->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $soldProduct->name }}</h5>
                    <p>Giá: {{ number_format($soldProduct->attributeProducts->first()->price ?? 0, 0, ',', '.') }} VND</p>
                    <a href="{{ route('product.detail', $soldProduct->product_id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h2 class="mt-5">Sản phẩm hot</h2>
    <div class="row">
        @foreach($productHot as $hotProduct)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ $hotProduct->main_image_url }}" class="card-img-top" alt="{{ $hotProduct->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotProduct->name }}</h5>
                    <p>Giá: {{ number_format($hotProduct->attributeProducts->first()->price ?? 0, 0, ',', '.') }} VND</p>
                    <a href="{{ route('product.detail', $hotProduct->product_id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h1>Danh sách sản phẩm</h1>
    <div class="row">
        @foreach($listProduct as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $product->main_image_url }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"> Giá: {{ number_format($product->price, 0, ',', '.') }} VND</p>
                    <p class="card-text">{{ $product->description }}</p>
                    <a href="{{ route('product.detail', $product->product_id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection