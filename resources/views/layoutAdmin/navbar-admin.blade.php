<aside class="custom-sider">
    <a href="{{ route('dashboard') }}" class="logo">
        <img src="{{ asset('image/logo/logo-remove.png') }}" alt="logo"
            style="width: 100px; height: 55px; box-shadow: -moz-initial;" />
    </a>
    <ul class="menu">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="icon-dashboard"></i> Thống kê
            </a>
        </li>
        <li>
            <a href="#managementSubmenu" data-toggle="collapse">
                <i class="icon-management"></i> Quản lý
            </a>
            <ul id="managementSubmenu" class="submenu collapse">
                <li><a href="{{ route('categorymanagement') }}">Quản lý danh mục</a></li>
                <li><a href="{{ route('productmanagement') }}">Quản lý sản phẩm</a></li>
                <li><a href="{{ route('attributemanagement') }}">Quản lý thuộc tính</a></li>
                <li><a href="{{ route('ordermanagement') }}">Quản lý đơn hàng</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('brandmanagement') }}">
                <i class="icon-tags"></i> Thương hiệu
            </a>
        </li>
    </ul>
</aside>