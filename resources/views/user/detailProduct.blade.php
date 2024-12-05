@extends("user.index")
@push('styles')
<link rel="stylesheet" href="{{asset('css/detailProduct.css')}}">
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

                        <div class="color-option" style="background-color: {{ $color->name }}"
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

                <button class="btn">Add to Cart</button>
                <button class="btn">Check Out</button>

                <h2>About this product</h2>
                <p>
                    {{$product->subtitle}}
                </p>
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
            <button class="btn">Submit Review</button>
        </div>
    </div>


</div>
<script>
    let selectedStars = 0;

    function changeColor(color, element) {
        document.getElementById("color-name").innerText = color;
        const colorOptions = document.querySelectorAll(".color-option");
        colorOptions.forEach((option) =>
            option.classList.remove("selected")
        );
        element.classList.add("selected");
    }

    function selectSize(size, element) {
        const sizeOptions = document.querySelectorAll(".size-option");
        sizeOptions.forEach((option) =>
            option.classList.remove("selected")
        );
        element.classList.add("selected");
    }

    function selectStar(rating) {
        selectedStars = rating;
        const stars = document.querySelectorAll(".star");
        stars.forEach((star, index) => {
            star.classList.toggle("selected", index < rating);
        });
    }

    function toggleLike(button) {
        // Get the like count span (next sibling of the button)
        const likeCount = button.nextElementSibling;
        let count = parseInt(likeCount.innerText);

        // Increment the count
        count++;
        likeCount.innerText = count; // Update the display

        // Optional: Toggle the 'liked' class for styling
        button.classList.toggle('liked');
    }

    function toggleReport(button) {
        // Get the report count span (next sibling of the button)
        const reportCount = button.nextElementSibling;
        let count = parseInt(reportCount.innerText);

        // Increment the count
        count++;
        reportCount.innerText = count; // Update the display

        // Optional: Toggle the 'reported' class for styling
        button.classList.toggle('reported');
    }
</script>
</div>

@endsection