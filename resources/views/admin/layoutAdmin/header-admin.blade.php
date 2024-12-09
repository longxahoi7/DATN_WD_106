<link rel="stylesheet" href="{{asset('css/headerAdmin.css')}}">
<div class="header">
    <!-- Phần thông tin bên trái và bên phải -->
    <div class="header-content">
        <!-- Logo nằm cuối bên trái -->
        <div class="logo">
            <img src="{{ asset('imagePro/image/logo/logo-admin.png') }}" alt="Gentle Manor" style="width: 170px;">
        </div>

        <!-- Thông tin nằm bên phải trong header -->
        <div class="header-right">
            <a href="/" class="menu-header-item">
                <span class="icon-home">🏠</span> Quay về trang chủ
            </a>
            <div class="dropdown">
                <a href="#" class="nav-link">
                    <span class="icon-user">👤</span>
                    @if(Auth::check())
                    {{ Auth::user()->name }}
                    @else
                    Tài Khoản
                    @endif
                </a>
                <div class="dropdown-menu text-center">
                    @if(Auth::check())
                    <a href="/profile" class="dropdown-item">Thông tin chung</a>
                    <a href="/order-history" class="dropdown-item">Cài đặt</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                        xuất</a>
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
                <a href="#" class="toggle-link">
                    <i class="icon-management">🛠️</i> Quản lý
                    <span class="arrow">▼</span>
                </a>
                <ul id="managementSubmenu" class="submenu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="icon-category">📂</i> Quản lý danh mục
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <i class="icon-product">🛒</i> Quản lý sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">
                            <i class="icon-size">📏</i> Quản lý Size
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.index') }}">
                            <i class="icon-color">🎨</i> Quản lý Màu
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Thương hiệu -->
            <li>
                <a href="{{ route('admin.brands.index') }}">
                    <i class="icon-tags">🏷️</i> Thương hiệu
                </a>
            </li>

            <!-- Shipper -->
            <li>
                <a href="">
                    <i class="icon-shipping">🚚</i> Shipper
                </a>
            </li>

            <!-- Quản lý đơn hàng -->
            <li>
                <a href="{{ route('admin.orders') }}">
                    <i class="icon-orders">📦</i> Đơn hàng
                </a>
            </li>

            <!-- Quản lý tài khoản -->
            <li>
                <a href="">
                    <i class="icon-account">👥</i> Tài khoản
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleLink = document.querySelector('.toggle-link');
    const submenu = document.getElementById('managementSubmenu');

    toggleLink.addEventListener('click', function() {
        submenu.classList.toggle('show');
        toggleLink.classList.toggle('active');
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const navLink = document.querySelector('.nav-link.custom-Navlink'); // Link dropdown
    const dropdownMenu = document.querySelector('.dropdown-menu'); // Menu con

    // Toggle menu con khi click
    navLink.addEventListener('click', function(e) {
        e.preventDefault();

        // Toggle class 'show' cho menu con
        dropdownMenu.classList.toggle('show');
    });

    // Ẩn menu con khi click ngoài
    document.addEventListener('click', function(e) {
        if (!dropdownMenu.contains(e.target) && !navLink.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
});
</script>