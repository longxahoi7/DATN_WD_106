<div class="product">
@if(session('alert'))
    <div class="alert alert-info" id="alert-message">
        {{ session('alert') }}
    </div>
@endif
    <h1>{{ $product->name }}</h1>
    <p><strong>Subtitle:</strong> {{ $product->subtitle }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>SKU:</strong> {{ $product->sku }}</p>
    <p><strong>Brand ID:</strong> {{ $product->brand_id }}</p>
    <p><strong>Category ID:</strong> {{ $product->product_category_id }}</p>

    <h2>Attributes</h2>
    @if($product->attributes->isEmpty())
    <p>No attributes available for this product.</p>
    @else
    @foreach ($product->attributes as $attribute)
    <div class="attribute">
        <strong>{{ $attribute->name }}:</strong> {{ $attribute->value }}
        <div>
            <strong>Image:</strong>
            <img src="{{ asset($attribute->pivot->image) }}" alt="{{ $attribute->name }}">
        </div>
        <p><strong>In Stock:</strong> {{ $attribute->pivot->in_stock ? 'Yes' : 'No' }}</p>
        <p><strong>Price:</strong> ${{ number_format($attribute->pivot->price, 2) }}</p>
    </div>

    @endforeach
    @endif
</div>
<form action="{{ route('cart.add', $product->product_id) }}" method="POST">
    @csrf
    <label for="quantity">Quantity:</label>
    <input type="number" name="qty" id="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>