@extends("user.index")

@push('styles')
<link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
@endpush

@section("content")
<style>
</style>
<div class="body">
    <div class="container">
        <div class="container1">
            <!-- Hiển thị hình ảnh hoặc thông báo nếu không có -->
            <div class="custom-image">
                @if($product->main_image_url)
                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" class="product-image" />
                @else
                <div class="no-image">Sản phẩm chưa có hình ảnh</div>
                @endif
            </div>

            <div class="contai">
                <!-- Thông tin sản phẩm -->
                <div class="options">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <div class="rating-section">
                        <span class="icon-star">⭐</span>
                        <span class="rating-number">({{ $product->rating_count }} đánh giá)</span>
                    </div>
                    <div class="price-display">₫{{ number_format($product->price, 0, ',', '.') }}</div>
                </div>

                <!-- Thêm thông tin về màu sắc và kích thước -->
                <div class="options">
                    <p class="custom-title-small">Màu sắc: </p>
                    <div class="color-options">
                        @foreach ($product->colors as $color)
                        <div class="color-option" style="background-color: {{ $color->name }}"
                            onclick="changeColor('{{ $color->name }}', this)"></div>
                        @endforeach
                    </div>
                </div>

                <div class="options">
                    <p class="custom-title-small">Size:</p>
                    <div class="size-options">
                        @foreach ($product->sizes as $size)
                        <div class="size-option" onclick="selectSize('{{ $size->name }}', this)">
                            {{ $size->name }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Thêm thông tin số lượng -->
                <div class="quantity-container">
                    <p class="custom-title-small">Số lượng:</p>
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="text" class="quantity-input" id="quantity" value="1" readonly>
                    <button class="quantity-btn" id="increase">+</button>
                </div>



                <!-- Thêm nút chức năng -->
                <div class="action-buttons">
                    <button type="button" class="btn btn-cart"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                        hàng</button>
                    <button type="button" class="btn btn-buy-now">Mua ngay</button>
                </div>
            </div>
        </div>

        <div class="container2">
            <div class="button-header">
                <button>
                    Chi tiết sản phẩm <i class="fa fa-star"></i>
                </button>
            </div>
            <div class="product-details">
                <p><span class="label">Danh Mục:</span> ...</p>
                <p><span class="label">Kho:</span> ...</p>
                <p><span class="label">Thương Hiệu:</span> ...</p>
                <p><span class="label">Màu:</span> ...</p>
                <p><span class="label">Size:</span></p>
                <ul>
                    <li>Size M: Nặng 45-55kg</li>
                    <li>Size L: Nặng 55-65kg</li>
                    <li>Size XL: Nặng 65-75kg</li>
                </ul>
                <p><span class="label">Mô tả:</span> {{ $product->subtitle }}</p>
            </div>
        </div>




        <div class="container3">
            <div class="button-header">
                <button>
                    Sản phẩm liên quan <i class="fa fa-star"></i>
                </button>
            </div>
            <div class="similar-products">
                @if($relatedProducts->isEmpty())
                <p class="no-related-products">Không có sản phẩm liên quan</p>
                @else
                @foreach($relatedProducts as $relatedProduct)
                <div class="similar-product">
                    <div class="product-image">
                        <img src="{{ $relatedProduct->main_image_url }}" class="card-img-top"
                            alt="{{ $relatedProduct->name }}">
                        <div class="product-overlay">
                            <h5 class="product-name">{{ $relatedProduct->name }}</h5>
                            <p class="product-price">{{ number_format($relatedProduct->price, 0, ',', '.') }} VND</p>
                            <a href="{{ route('product.detail', $relatedProduct->product_id) }}" class="add-to-cart">Xem
                                chi
                                tiết</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>


        <div class="container3 reviews">
            <div class="button-header">
                <button>
                    Bình luận và đánh giá <i class="fa fa-star"></i>
                </button>
            </div>
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
                </div>
                <textarea placeholder="Write your review here..."></textarea>
                <button class="btn">Bình luận</button>
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
            element
                .classList.add("selected");
        }
        </script>



        @endsection
