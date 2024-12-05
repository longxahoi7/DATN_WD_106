@push('styles')
    <link rel="stylesheet" href="{{asset('css/navbarAdmin.css')}}">
@endpush
<aside class="custom-sider">
    <a href="" class="logo">
        <img src="{{ asset('image/logo/logo-remove.png') }}" alt="logo"
            style="width: 100px; height: 55px; box-shadow: -moz-initial;" />
    </a>
    <ul class="menu">
        <li>
            <a href="">
                <i class="icon-dashboard"></i> Thống kê
            </a>
        </li>
        <li>
            <a href="#managementSubmenu" data-toggle="collapse">
                <i class="icon-management"></i> Quản lý
            </a>
            <ul id="managementSubmenu" class="submenu collapse">
                <li><a href="{{ route('category.index') }}">Quản lý danh mục</a></li>
                <li><a href="#">Quản lý sản phẩm</a></li>
                <li><a href="{{ route('size.index') }}">Quản lý Size</a></li>
                <li><a href="{{ route('color.index') }}">Quản lý Màu</a></li>
                <li><a href="{{ route('orders.index') }}">Quản lý đơn hàng</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('brand.index') }}">
                <i class="icon-tags"></i> Thương hiệu
            </a>
        </li>
        <li>
            <a href="{{ route('orderShipper.index') }}">
                <i class="icon-tags"></i> Shipper
            </a>
        </li>
    </ul>
</aside>