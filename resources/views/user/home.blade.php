@extends('user.layouts.app')

@section('content')
<div class="container">
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