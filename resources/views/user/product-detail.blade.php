@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ $product->image }}" class="img-fluid" alt="{{ $product->name }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $product->name }}</h1>
        <p>{{ number_format($product->price, 0, ',', '.') }} VND</p>
        <p>{{ $product->description }}</p>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
            </div>
            <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
        </form>
    </div>
</div>
@endsection