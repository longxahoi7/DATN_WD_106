@extends("user.index")

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
@endpush

@section("content")
    <div class="body">
        <div class="container">
            <div class="container1">
                <div>
                    <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="product-image" />
                </div>
                <div class="contai">
                    <div class="options">
                        <h1>{{ $product->name }}</h1>
                        <p class="price">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        <p>Color: </p>
                        <div class="color-options">
                            @foreach ($product->colors as $color)
                                <div class="color-option" 
                                    style="background-color: {{ $color->name }}"
                                    onclick="changeColor('{{ $color->name }}', this)">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="options">
                        <p>Size:</p>
                        <div class="size-options">
                            @foreach ($product->sizes as $size)
                                <div class="size-option" onclick="selectSize('{{ $size->name }}', this)">
                                    {{ $size->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <input type="hidden" name="color_id" id="selected-color" value="">
                        <input type="hidden" name="size_id" id="selected-size" value="">
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" name="qty" id="quantity" class="form-control" min="1" value="1">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                    </form>
                    
                    <h2>Thông tin sản phẩm</h2>
                    <p>{{ $product->subtitle }}</p>
                </div>
            </div>

            <h3>Sản phẩm liên quan</h3>
            <div class="similar-products">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="similar-product">
                        <div class="product-image">
                            <img src="{{ $relatedProduct->main_image_url }}" class="card-img-top" alt="{{ $relatedProduct->name }}">
                            <div class="product-overlay">
                                <h5 class="product-name">{{ $relatedProduct->name }}</h5>
                                <p class="product-price">{{ number_format($relatedProduct->price, 0, ',', '.') }} VND</p>
                                <a href="{{ route('product.detail', $relatedProduct->product_id) }}" class="add-to-cart">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="reviews">
                <h2>Đánh giá sản phẩm</h2>
                <!-- Review Section -->
            </div>
        </div>
    </div>

    <script>
        let selectedColor = '';
        let selectedSize = '';

        // Function to handle color selection
        function changeColor(color, element) {
            selectedColor = color;
            document.getElementById("selected-color").value = color;
            const colorOptions = document.querySelectorAll(".color-option");
            colorOptions.forEach(option => option.classList.remove("selected"));
            element.classList.add("selected");
        }

        // Function to handle size selection
        function selectSize(size, element) {
            selectedSize = size;
            document.getElementById("selected-size").value = size;
            const sizeOptions = document.querySelectorAll(".size-option");
            sizeOptions.forEach(option => option.classList.remove("selected"));
            element.classList.add("selected");
        }
    </script>
@endsection
