@extends('admin.index')

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">Dashboard Thống kê</h1>

    <div class="dashboard-filter-section">
        <label for="date-range">Chọn khoảng thời gian: </label>
        <input type="date" id="start-date">
        <span>đến</span>
        <input type="date" id="end-date">
        <button class="btn-filter">Thống kê</button>
    </div>

    <div class="dashboard-stat-container">
        <div class="dashboard-stat-box">
            <h3>Doanh thu</h3>
            <div class="dashboard-stat-data" id="revenue-stat">0 VNĐ</div>
        </div>

        <div class="dashboard-stat-box">
            <h3>Top người dùng đặt hàng</h3>
            <ul class="dashboard-stat-list" id="top-users-stat"></ul>
        </div>

        <div class="dashboard-stat-box">
            <h3>Top sản phẩm bán chạy</h3>
            <ul class="dashboard-stat-list" id="top-products-stat"></ul>
        </div>

        <div class="dashboard-stat-box">
            <h3>Đơn hàng chờ xác nhận</h3>
            <div class="dashboard-stat-data" id="pending-orders">0 đơn</div>
        </div>
    </div>
</div>

@endsection