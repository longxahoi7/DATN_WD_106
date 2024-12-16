@extends('user.index')

<link href="{{ asset('css/productList.css') }}" rel="stylesheet" type="text/css">
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Danh Sách Sản Phẩm</h1>
    @if(session('alert'))
    <div class="alert alert-info" id="alert-message">
        {{ session('alert') }}
    </div>
@endif
    <div class="row">
        @foreach ($listProduct as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $product->main_image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                    <h6 class="text-danger">
                    @php
                        // Lấy danh sách giá của sản phẩm
                        $prices = $product->attributeProducts->pluck('price');
                        $minPrice = $prices->min();
                        $maxPrice = $prices->max();
                        @endphp
                        @if ($minPrice == $maxPrice)
                        {{ number_format($minPrice, 0, ',', '.') }} VND
                        @else
                        {{ number_format($minPrice, 0, ',', '.') }} -
                        {{ number_format($maxPrice, 0, ',', '.') }} VND
                        @endif
                    </h6>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('user.product.detail', $product->product_id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Thêm Vào Giỏ</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
