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
                    <p class="price" id="product-price">
                        {{ number_format($product->attributeProducts->first()->price ?? 0, 0, ',', '.') }} VND
                    </p>
                    <p>Color: </p>
                    <div class="color-options">
                        @foreach($product->attributeProducts as $attributeProduct)
                        <div class="color-option"
                            style="background-color: {{ $attributeProduct->color->name }}"
                            onclick="changeColor('{{ $attributeProduct->color->name }}', this)">
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="options">
                    <p>Size:</p>
                    <div class="size-options">
                        @foreach($product->attributeProducts->unique('size_id') as $attributeProduct)
                        <div class="size-option"
                            data-size="{{ $attributeProduct->size->name }}"
                            data-price="{{ $attributeProduct->price }}"
                            onclick="updatePrice('{{ $attributeProduct->price }}', 'size', this)">
                            {{ $attributeProduct->size->name }}
                        </div>
                        @endforeach
                    </div>

                </div>

                <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
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
            <h2>Customer Reviews</h2>
            <div class="review">
                <div class="review-header">
                    <strong>anhan224</strong>
                    <div class="rating">★★★★☆</div>
                    <span class="review-date">2021-10-29 10:05</span>
                </div>
                <p class="review-text">
                    Hàng đẹp, sản phẩm rất đáng mua nhé
                    Mua hàng ở làn bên shop nên rất yên tâm về chất lượng ❤️❤️
                    Sẽ còn mua hàng shop dài dài hihi! 😊
                </p>
                <div class="review-images">
                    <img src="{{ asset('imagePro/1732209277.jpg') }}" alt="Review Image 1" />
                    <img src="{{ asset('imagePro/1732209500.jpg') }}" alt="Review Image 2" />
                    <img src="{{ asset('imagePro/1732209441.jpg') }}" alt="Review Image 3" />
                </div>
                <div class="review-buttons">
                    <button class="like-button" onclick="toggleLike(this)">
                        <i class="fa-regular fa-thumbs-up"></i>
                    </button>
                    <span class="like-count">0</span>
                    <button class="report-button" onclick="toggleReport(this)">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                    </button>
                    <span class="report-count">0</span>
                </div>

            </div>
            <div class="review-form">
                <h2>Leave a Review</h2>
                <div class="stars">
                    <span class="star" onclick="selectStar(1)">★</span>
                    <span class="star" onclick="selectStar(2)">★</span>
                    <span class="star" onclick="selectStar(3)">★</span>
                    <span class="star" onclick="selectStar(4)">★</span>
                    <span class="star" onclick="selectStar(5)">★</span>

                    <div class="reviews">
                        <h2>Đánh giá sản phẩm</h2>
                        <!-- Review Section -->
                    </div>
                    <textarea placeholder="Write your review here..."></textarea>
                    <button class="btn">Submit Review</button>
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
                document.getElementById("selected-size").value = size; // Gán giá trị vào input hidden
                console.log("Size ID đã chọn:", size); // Hiển thị giá trị trong console
                const sizeOptions = document.querySelectorAll(".size-option");
                sizeOptions.forEach(option => option.classList.remove("selected"));
                element.classList.add("selected");
            }
            // Hàm cập nhật giá sản phẩm
            function updatePrice(price, type, element) {
                // Loại bỏ trạng thái "selected" của các lựa chọn hiện tại
                if (type === 'color') {
                    document.querySelectorAll('.color-option').forEach(option => {
                        option.classList.remove('selected');
                    });
                } else if (type === 'size') {
                    document.querySelectorAll('.size-option').forEach(option => {
                        option.classList.remove('selected');
                    });
                }

                // Đánh dấu lựa chọn hiện tại là "selected"
                element.classList.add('selected');

                // Cập nhật giá hiển thị
                const priceElement = document.getElementById('product-price');
                priceElement.textContent = `${Number(price).toLocaleString()} VND`;
            }

            
        </script>
        @endsection