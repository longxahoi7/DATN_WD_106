@extends('layouts.app')

@section('content')
<link href="{{ asset('css/productList.css') }}" rel="stylesheet" type="text/css">
<div class="container">
    <x-slide-show /> <!-- Assuming you have a Blade component for SlideShow -->

    <div class="button-header">
        <button>
            Gentle Manor - Sản Phẩm Nổi Bật <i class="fa fa-star"></i>
        </button>
    </div>

    <div class="product-list">
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>
        <figure class="snip1585">
            <img src="{{ 'https://placehold.co/276x350?text=%22Kh%C3%B4ng%20c%C3%B3%20%E1%BA%A3nh%22' }}" alt="tên ảnh"
                class="w-full h-full object-cover" />
            <figcaption>
                <h6>
                    tên sản phẩm <br />
                    <span class="pt-3">
                        giá <sup>đ</sup>
                    </span>
                    <br />
                </h6>
                <button class="add-to-cart-button">
                    <i class="fa fa-shopping-cart"></i> Mua Ngay
                </button>
            </figcaption>
            <a href="product-detail" class="product-detail-link"></a>
        </figure>

        <!-- <p>Không có sản phẩm nào trong danh mục này.</p> -->
    </div>
</div>
@endsection
