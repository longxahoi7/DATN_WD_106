@extends('user.index')

<style>
 .order-success {
    text-align: center;
    padding: 50px 20px;
    background: linear-gradient(to bottom, #f9f5ef, #d4c9b9); /* Tông màu vàng xám nhạt */
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 50px auto;
    font-family: 'Roboto', sans-serif;
}

.success-icon img {
    width: 150px;
    height: auto;
    margin-bottom: 20px;
}

.success-title {
    font-size: 2.2rem;
    color: #6a4f4b; /* Màu nâu tinh tế */
    font-weight: bold;
    margin-bottom: 15px;
}

.success-message {
    font-size: 1.1rem;
    color: #5f5c58;
    margin-bottom: 20px;
    line-height: 1.6;
}

.order-actions .btn-home {
    display: inline-block;
    background-color: #6a4f4b;
    color: #fff;
    padding: 10px 20px;
    font-size: 1rem;
    border: 1px solid #000;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.order-actions .btn-home:hover {
    border: 1px solid #000;
    background-color: #5c433f;
    transform: translateY(-2px);
}

.order-actions .btn-home:active {
    border: 1px solid #000;
    transform: translateY(0);
}
</style>
@section('content')

<div class="order-success">
    <div class="success-icon">
        <img src="{{ asset('imagePro/icon/icon-cart-success.png') }}" alt="Order Success Icon" />
    </div>
    <h1 class="success-title">Đặt hàng thành công!</h1>
    <p class="success-message">Xin chào, <strong>{{ $userName }}</strong>.</p>
    <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
    <div class="order-actions">
        <a href="{{route('user.order.history')}}" class="btn btn-primary btn-home">Lịch sử đơn hàng</a>
        <a href="{{ route('home') }}" class="btn btn-primary btn-home">Tiếp tục mua hàng</a>
    </div>
</div>
@endsection
<script>
    // Hiệu ứng khi tải trang
document.addEventListener("DOMContentLoaded", function () {
    const successDiv = document.querySelector(".order-success");
    successDiv.style.opacity = "0";
    successDiv.style.transform = "scale(0.9)";
    setTimeout(() => {
        successDiv.style.opacity = "1";
        successDiv.style.transform = "scale(1)";
        successDiv.style.transition = "all 0.5s ease";
    }, 100);
});
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
