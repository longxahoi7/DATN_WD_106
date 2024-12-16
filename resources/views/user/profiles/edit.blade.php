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
        <h3>Chỉnh sửa thông tin tài khoản</h3>
        <div class="custom-form-profile">
            <form id="orderForm" action="" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="recipient_name" id="recipient_name" placeholder="Tên người nhận"
                        class="form-control" value="" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone" id="phone" class="form-control"
                        placeholder="Số điện thoại nhận hàng" value="" required>
                </div>
                <div class="mb-3">
                    <input name="shipping_address" id="shipping_address" class="form-control" required
                        placeholder="Địa chỉ nhận hàng" value=""></input>
                </div>
                <input type="hidden" name="discount_code" id="hiddenDiscountCode" value="">
                <button type="submit">Lưu</button>
            </form>
        </div>
    </div>
</div>
@endsection