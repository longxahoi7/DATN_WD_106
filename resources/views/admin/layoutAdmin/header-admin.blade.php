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
                <a href="http://localhost:8000/admin/dashBoard">
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

            <!-- Shipper -->
            <li>
                <a href="/shipper">
                    <i class="icon-shipping">🚚</i> Shipper
                </a>
            </li>

            <!-- Mã giảm giá -->
            <li>
                <a href="/coupon">
                    <i class="icon-discount">🏷️</i> Mã giảm giá
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
                <a href="user">
                    <i class="icon-account">👥</i> Tài khoản
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const accountToggle = document.querySelector('.nav-link.dropdown-toggle');
    const accountDropdown = document.querySelector('.dropdown-menu');
    const accountArrow = accountToggle.querySelector('.arrow');

    accountToggle.addEventListener('click', function(e) {
        e.preventDefault();
        accountDropdown.classList.toggle('show');
        accountArrow.classList.toggle('up');
    });

    document.addEventListener('click', function(e) {
        if (!accountDropdown.contains(e.target) && !accountToggle.contains(e.target)) {
            accountDropdown.classList.remove('show');
            accountArrow.classList.remove('up');
        }
    });

    const managementToggle = document.querySelector('.toggle-link.dropdown-toggle');
    const managementDropdown = document.querySelector('.submenu');
    const managementArrow = managementToggle.querySelector('.arrow');

    managementToggle.addEventListener('click', function(e) {
        e.preventDefault();
        managementDropdown.classList.toggle('show');
        managementArrow.classList.toggle('up');
    });

    document.addEventListener('click', function(e) {
        if (!managementDropdown.contains(e.target) && !managementToggle.contains(e.target)) {
            managementDropdown.classList.remove('show');
            managementArrow.classList.remove('up');
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const currentURL = window.location.href;

    const menuLinks = document.querySelectorAll(".menu a");

    menuLinks.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add("active");
            link.parentElement.classList.add("hover");
        }
    });

});
document.addEventListener("DOMContentLoaded", function() {
    const currentURL = window.location.href;

    const menuItems = document.querySelectorAll(".submenu li a");

    menuItems.forEach(item => {
        if (item.href === currentURL) {
            const parentDropdown = item.closest('.dropdown');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });
});
</script>