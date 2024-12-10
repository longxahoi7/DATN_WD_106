<aside class="custom-sider">
    <a href="" class="logo">
        <img src="{{ asset('storage/imagePro/image/logo/logo-remove.png') }}" alt="logo"
            style="width: 100px; height: 55px; box-shadow: -moz-initial;" />
    </a>
    <ul class="d-flex justify-content-around menu">
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
                <li><a href="{{ route('admin.categories.index')}}">Quản lý danh mục</a></li>
                <li><a href="{{route('admin.products.index')}}">Quản lý sản phẩm</a></li>
                <li><a href="{{route('admin.sizes.index')}}">Quản lý Size</a></li>
                <li><a href="{{route('admin.colors.index')}}">Quản lý Màu</a></li>
                <li><a href="{{route('admin.coupons.index')}}">Quản lý phiếu giảm giá</a></li>
                <li><a href="{{route('admin.orders')}}">Quản lý đơn hàng</a></li>




                <li>
           
        </li>
            </ul>
            <a href="#managementSubmenu" data-toggle="collapse">
                <i class="icon-management"></i> Quản lý tài khoản
            </a>
            <ul id="managementSubmenu" class="submenu collapse">
            <li><a href="{{route('admin.customers.index')}}">Quản lý khách hàng</a></li>
                <li><a href="{{route('admin.employees.index')}}">Quản lý nhân viên</a></li>
            </ul>

        </li>
        <li>
            <a href="{{ route('admin.brands.index') }}">
                <i class="icon-tags"></i> Thương hiệu
            </a>
        </li>
        <li>
            <a href="">
                <i class="icon-tags"></i> Shipper
            </a>
        </li>
    </ul>
</aside>
