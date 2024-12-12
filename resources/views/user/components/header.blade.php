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
                                <a
                                    href="{{ route('user.product.list', $category->category_id) }}">{{ $category->name }}</a>
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

                                <!-- Kiểm tra nếu người dùng có role 'admin' -->
                                @if(in_array(Auth::user()->role, [1, 3]))
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Trang quản trị</a>
                                @endif

                                <a href="{{route('user.order.history')}}" class="dropdown-item">Lịch sử mua hàng</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a href="{{route('home')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    xuất</a>
                                @else
                                <a href="/login" class="dropdown-item">Đăng nhập</a>
                                <a href="/register" class="dropdown-item">Đăng ký</a>
                                @endif
                            </div>
                        </div>

                        <a href="javascript:void(0);" class="nav-link ml-3" onclick="toggleCartPopup()">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="custom-cart-count">2</span>
                        </a>
                    </nav>
                </div>
            </div>
            @include('user.components.cart-popup', ['cartItems' => $cartItems ?? [], 'total' => $total ?? 0])
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
    const cartPopup = document.getElementById('cart-popup');
    cartPopup.classList.toggle('d-none');

    if (!cartPopup.classList.contains('d-none')) {
        fetchCartItems();
    }
}
</script>
