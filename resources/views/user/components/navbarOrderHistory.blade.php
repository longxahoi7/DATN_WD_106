@push('styles')
<link rel="stylesheet" href="{{ asset('css/accountAndOrder/navbaProfiles.css') }}">
@endpush
<div class="menu-left">
    <div class="avatar-section d-flex">
        <img src="{{ asset('imagePro/icon/icon-avata.png')}}" alt="Avatar" class="avatar">
        <h5 class="user-name">Tên người dùng</h5>
    </div>

    <div class="menu-item ml-4" id="profileLink">
        <a href="/proflies">
            <i class="fas fa-map-marker-alt"></i>
            <span>Tài khoản của tôi</span>
        </a>
    </div>

    <div class="menu-item ml-4" id="orderHistoryLink">
        <a href="{{ route('user.order.history') }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Lịch sử đơn hàng</span>
        </a>
    </div>

    <button class="btn custom-logout-btn w-100">
        <a href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>Đăng
            xuất</a>
    </button>
</div>