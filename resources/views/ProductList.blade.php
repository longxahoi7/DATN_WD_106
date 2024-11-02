<h1>Danh sách sản phẩm</h1>

<div class="product-list">
    @foreach($listProduct as $product)
        <div class="product-item">
            <a href="{{ route('detail', $product->product_id) }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="150">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p><strong>Giá:</strong> ${{ number_format($product->price, 2) }}</p>
            </a>
        </div>
    @endforeach
</div>