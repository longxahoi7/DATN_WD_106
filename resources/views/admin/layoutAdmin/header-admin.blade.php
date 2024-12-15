<div class="header">
    <!-- Phần thông tin bên trái và bên phải -->
    <div class="header-content">
        <!-- Logo nằm cuối bên trái -->
        <div class="logo">
            <a href="http://localhost:8000/admin/dashBoard">
                <img src="{{ asset('imagePro/image/logo/logo-admin.png') }}" alt="Gentle Manor" style="width: 170px;">
            </a>
        </div>

        <!-- Thông tin nằm bên phải trong header -->
        <div class="header-right">
            <a href="/" class="">
                <span class="icon-home">🏠</span> Quay về trang chủ
            </a>
            <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle">
                    <span class="icon-user">👤</span>
                    @if(Auth::check())
                    {{ Auth::user()->name }}
                    @else
                    Tài Khoản
                    @endif
                </a>
                <div class="dropdown-menu">
                    @if(Auth::check())
                    <a href="/profile" class="dropdown-item">Thông tin chung</a>
                    <a href="/order-history" class="dropdown-item">Cài đặt</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                    @else
                    <a href="/login" class="dropdown-item">Đăng nhập</a>
                    <a href="/register" class="dropdown-item">Đăng ký</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Menu bên dưới Header -->
    <div class="menu">
        <ul class="d-flex justify-content-around menu-list">
            <!-- Thống kê -->
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-dashboard">📊</i> Thống kê
                </a>
            </li>

            <!-- Quản lý với Dropdown -->
            <li class="dropdown">
                <a href="#" class="toggle-link dropdown-toggle">
                    <i class="icon-management">🛠️</i> Quản lý
                </a>
                <ul id="managementSubmenu" class="submenu">
                    <li><a href="{{ route('admin.products.index') }}"><i class="icon-product">🛒</i> Quản lý sản
                            phẩm</a></li>
                    <li><a href="{{ route('admin.categories.index') }}"><i class="icon-category">📂</i> Quản lý
                            danh mục</a></li>
                    <li><a href="{{ route('admin.sizes.index') }}"><i class="icon-size">📏</i> Quản lý Size</a>
                    </li>
                    <li><a href="{{ route('admin.colors.index') }}"><i class="icon-color">🎨</i> Quản lý Màu</a>
                    </li>
                    <li><a href="{{ route('admin.brands.index') }}"><i class="icon-tags">🏷️</i> Quản lý thương
                            hiệu</a></li>

                </ul>
            </li>

            <!-- Mã giảm giá -->
            <li class="dropdown-coupon">
                <a href="#" class="toggle-link-coupon dropdown-toggle">
                    <i class="icon-management">🏷️</i> Mã giảm giá
                </a>

                <ul id="managementSubmenu-coupon" class="submenu-coupon">
                    <li><a href="{{route('admin.coupons.index')}}">Phiếu giảm giá</a></li>
                    <li><a href="{{route('admin.promotionPeriods.index')}}">Đợt giảm giá</a></li>

                </ul>
            </li>

            <!-- Quản lý đơn hàng -->
            <li>
                <a href="{{ route('admin.orders') }}">
                    <i class="icon-orders">📦</i> Đơn hàng
                </a>
            </li>

            <!-- Quản lý tài khoản -->
            <li>
                <a href="{{ route('admin.users.listUser') }}">
                    <i class="icon-account">👥</i> Tài khoản
                </a>
            </li>
            <!-- Quản lý bình luận -->
            <li class="dropdown-coupon">
                <a href="{{route('admin.reviews.index')}}" class="toggle-link-coupon dropdown-toggle">
                    <i class="icon-management">🏷️</i> Bỉnh luận
                </a>

                <ul id="managementSubmenu-coupon" class="submenu-coupon">
                    <li><a href="{{route('admin.reviews.index')}}">Bình luận khách hàng</a></li>
                    <li><a href="">Bình luận quản lý </a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Account Dropdown
    const accountToggle = document.querySelector('.nav-link.dropdown-toggle');
    const accountDropdown = document.querySelector('.dropdown-menu');

    accountToggle.addEventListener('click', function(e) {
        e.preventDefault();
        accountDropdown.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        if (!accountDropdown.contains(e.target) && !accountToggle.contains(e.target)) {
            accountDropdown.classList.remove('show');
        }
    });

    // Management Dropdown
    const managementToggle = document.querySelector('.toggle-link.dropdown-toggle');
    const managementDropdown = document.querySelector('.submenu');

    managementToggle.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Dropdown Mã giảm giá được click!');
        managementDropdown.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        if (!managementDropdown.contains(e.target) && !managementToggle.contains(e.target)) {
            managementDropdown.classList.remove('show');
        }
    });

    // Coupon Dropdown
    const couponToggle = document.querySelector('.toggle-link-coupon.dropdown-toggle');
    const couponDropdown = document.querySelector('.submenu-coupon');

    couponToggle.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Dropdown Mã giảm giá được click!');
        couponDropdown.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        if (!couponDropdown.contains(e.target) && !couponToggle.contains(e.target)) {
            couponDropdown.classList.remove('show');
        }
    });

    // Highlight active menu item
    const currentURL = window.location.href;
    const menuItems = document.querySelectorAll(".submenu li a, .submenu-coupon li a");

    menuItems.forEach(item => {
        if (item.href === currentURL) {
            const parentDropdown = item.closest('.dropdown, .dropdown-coupon');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });
});
</script>