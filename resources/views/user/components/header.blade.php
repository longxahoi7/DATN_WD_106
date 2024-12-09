<link href="{{ asset('css/header.css') }}" rel="stylesheet">

<div class="container-fluid border-bottom">
    <div class="row d-flex justify-content-between align-items-center">
        <!-- Cột bên trái - Logo -->
        <div class="col-2 d-flex align-items-center justify-content-center">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('imagePro/image/logo/logo-remove.png') }}" alt="Gentle Manor" style="width: 80px;">
            </a>
        </div>

        <!-- Cột giữa - Tìm kiếm và danh mục -->
        <div class="col-7" style="padding-left: 15px; padding-right: 15px;">
            <div class="row">
                <!-- Hàng ngang 1 - Thanh tìm kiếm -->
                <div class="col-12 mb-1 pt-4 form-search">
                    <form class="d-flex justify-content-center">
                        <input type="search" placeholder="Tìm kiếm sản phẩm" class="form-control search-bar"
                            aria-label="Search">
                    </form>
                </div>
            </div>

            <div class="row">
                <!-- Hàng ngang 2 - Danh mục -->
                <div class="col">
                    <div class="header-nav align-items-center" style="display: flex; margin-top: 10px">
                        <ul class='d-flex'>

                            @foreach ($categories as $category)
                            <li class="dropdown-item">
                                <a href="{{ route('product.list', $category->category_id) }}">{{ $category->name }}</a>
                                <ul class="sub-dropdown-menu">
                                </ul>
                            </li>
                            @endforeach
                            <li class="dropdown-item">
                                <a href="{{ asset('/product-list') }}">Danh sách sản phẩm</a>
                                <ul class="sub-dropdown-menu">
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột bên phải - Icon và địa chỉ -->
        <div class="col-3">
            <div class="row d-flex">
                <!-- Hàng ngang 1 - Các icon và liên kết -->
                <div class="col">
                    <nav class="header-nav mt-3">
                        <a href="/" class="nav-link">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                        <div class="dropdown">
                            <a href="#" class="nav-link custom-Navlink">
                                <i class="fas fa-user"></i>
                                @if(Auth::check())
                                {{ Auth::user()->name }}
                                @else
                                Tài Khoản
                                @endif
                            </a>
                            <div class="dropdown-menu text-center">
                                @if(Auth::check())
                                <a href="/profile" class="dropdown-item">Thông tin chung</a>
                                <a href="/order-history" class="dropdown-item">Lịch sử mua hàng</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    xuất</a>
                                @else
                                <a href="/login" class="dropdown-item">Đăng nhập</a>
                                <a href="/register" class="dropdown-item">Đăng ký</a>

                                @endif
                            </div>
                        </div>

                        <!-- <a href="{{ route('users.cart') }}" class="nav-link ml-3">
                            <i class="fas fa-shopping-cart"></i>
                        </a> -->
                        <a href="javascript:void(0);" class="nav-link ml-3" onclick="toggleCartPopup()">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="custom-cart-count">2</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Popup giỏ hàng -->
            <div id="customCartPopup" class="custom-cart-popup d-none">
                <div class="custom-cart-popup-overlay" onclick="toggleCartPopup()"></div>
                <div class="custom-cart-popup-content">
                    <button class="custom-close-popup" onclick="toggleCartPopup()">&times;</button>
                    <h4 class="custom-cart-title">Giỏ hàng của bạn</h4>
                    <div class="custom-cart-items-container">
                        <div class="custom-product-card">
                            <div class="custom-product-image">
                                <a href="product.detail/2" class="custom-product-card-link">
                                    <img src="{{ asset('imagePro/image/no-image.png') }}" alt="name"
                                        onerror="this.onerror=null; this.src='{{ asset('imagePro/image/no-image.png') }}';">
                                </a>
                            </div>
                            <div class="custom-product-details">
                                <h5 class="custom-product-name">Name of the Product That Can Be Really Long</h5>
                                <p class="custom-product-price">200.000đ</p>
                                <div class="custom-details-row">
                                    <p class="custom-product-attribute">Màu sắc: Đỏ</p>
                                    <p class="custom-product-attribute">Size: XL</p>
                                </div>
                                <p class="custom-product-quantity">Số lượng: 2</p>
                            </div>
                            <div class="custom-remove-btn">
                                <form action="remove/2" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="custom-btn-remove">&times;</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="custom-cart-footer">
                        <p class="custom-total-amount">Tổng tiền: 200.000đ</p>
                        <div class="custom-cart-actions">
                            <button class="custom-add-cart-popup">
                                <a href="{{ route('users.cart') }}">Xem giỏ hàng</a>
                            </button>
                            <form action="{{ route('checkout.vnpay') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="">
                                <button type="submit" name="redirect" class="custom-btn-checkout-popup">Thanh toán
                                    VNPay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <!-- Hàng ngang 2 - Địa chỉ và số điện thoại -->
                <div class="col text-start custom-text d-flex">
                    <a href="https://www.google.com/maps/search/13+P.+Trịnh+Văn+Bô,+Xuân+Phương,+Nam+Từ+Liêm,+Hà+Nội"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-map-marker-alt"></i> Địa chỉ: 13 Trịnh Văn Bô
                    </a>
                    <a class="custom-text ms-3"><i class="fas fa-phone-alt"></i> Hotline: 0369312858</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleCartPopup() {
    const cartPopup = document.getElementById('customCartPopup');
    cartPopup.classList.toggle('d-none');
}
</script>