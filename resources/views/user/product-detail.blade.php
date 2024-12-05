@extends('user.layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ $product->main_image_url }}" class="img-fluid" alt="{{ $product->name }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>
        <p>{{ $product->description }}</p>
        <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
            </div>
            <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
        </form>
    </div>
</div>

<h2 class="mt-5">Sản phẩm liên quan</h2>
<div class="row">
    @foreach($relatedProducts as $relatedProduct)
    <div class="col-md-3 mb-4">
        <div class="card">
            <img src="{{ $relatedProduct->main_image_url }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                <p class="card-text">{{ number_format($relatedProduct->price, 0, ',', '.') }} VND</p>
                <a href="{{ route('product.detail', $relatedProduct->product_id) }}" class="btn btn-primary">Xem chi tiết</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
