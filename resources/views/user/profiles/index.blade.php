@extends("user.index")

@push('styles')
<link rel="stylesheet" href="{{ asset('css/accountAndOrder/profile.css') }}">
@endpush

@section("content")
<div class="profile-container">
    <!-- Bên trái -->
    <div class="profile-sidebar">
        <h3>Trang tài khoản</h3>
        <p>Xin chào, <strong>Hải Long!</strong></p>
        <div class="custom-menu-profile">
            <a href="/profile" class="custom-text-link-profile">Thông tin tài khoản</a>
            <br />
            <a href="/profile-edit" class="custom-text-link-profile">Chỉnh sửa tài khoản</a>
            <br />
            <a href="{{route('user.order.history')}}" class="custom-text-link-profile">Lịch sử đơn hàng</a>
            <br />
        </div>
        <br />
        <br />
        <a href="{{ route('logout') }}" class="btn-logout">Đăng xuất</a>
    </div>

    <!-- Bên phải -->
    <div class="profile-main">
        <h3>Tài khoản</h3>
        <div class="profile-info">
            <i class="fas fa-user"></i> Tên tài khoản: <strong>Hải Long!</strong>
        </div>
        <div class="profile-info">
            <i class="fas fa-map-marker-alt"></i> Địa chỉ: Quan Hoa - Cầu Giấy - Hà Nội
        </div>
        <div class="profile-info">
            <i class="fas fa-phone"></i> Điện thoại: 0369312858
        </div>
    </div>
</div>
@endsection