<div class="sidebar">
    <!-- Logo -->
    <div class="logo">
        <a href="http://localhost:8000/admin/dashBoard">
            <img src="{{ asset('imagePro/image/logo/logo-admin.png') }}" alt="Gentle Manor" style="width: 100%;">
        </a>
    </div>

    <!-- Menu -->
    <ul class="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="icon-dashboard">📊</i> Thống kê
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="toggle-link dropdown-toggle">
                <i class="icon-management">🛠️</i> Quản lý
            </a>
            <ul id="managementSubmenu" class="submenu">
                <li><a href="{{ route('admin.products.index') }}"><i class="icon-product">🛒</i> Sản phẩm</a></li>
                <li><a href="{{ route('admin.categories.index') }}"><i class="icon-category">📂</i> Danh mục</a></li>
                <li><a href="{{ route('admin.sizes.index') }}"><i class="icon-size">📏</i> Size</a></li>
                <li><a href="{{ route('admin.colors.index') }}"><i class="icon-color">🎨</i> Màu</a></li>
                <li><a href="{{ route('admin.brands.index') }}"><i class="icon-tags">🏷️</i> Thương hiệu</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.orders') }}">
                <i class="icon-orders">📦</i> Đơn hàng
            </a>
        </li>
        <li>
            <a href="{{route('admin.reviews.index')}}">
                <i class="icon-management">💬</i> Bình luận
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.listUser') }}">
                <i class="icon-account">👥</i> Tài khoản
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}">
                <i class="icon-home">🏠</i> Trang chủ
            </a>
        </li>
    </ul>
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
        couponDropdown.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        if (!couponDropdown.contains(e.target) && !couponToggle.contains(e.target)) {
            couponDropdown.classList.remove('show');
        }
    });

    // Coupon Dropdown
    const commentToggle = document.querySelector('.toggle-link-comment.dropdown-toggle');
    const commentDropdown = document.querySelector('.submenu-comment');
    commentToggle.addEventListener('click', function(e) {
        e.preventDefault();
        commentDropdown.classList.toggle('show');
    });
    document.addEventListener('click', function(e) {
        if (!commentDropdown.contains(e.target) && !commentToggle.contains(e.target)) {
            commentDropdown.classList.remove('show');
        }
    });

    // Highlight active menu item
    const currentURL = window.location.href;
    const menuItems = document.querySelectorAll(".submenu li a, .submenu-coupon li a, .submenu-comment li a");

    menuItems.forEach(item => {
        if (item.href === currentURL) {
            const parentDropdown = item.closest('.dropdown, .dropdown-coupon, .dropdown-comment');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });
});
</script>
