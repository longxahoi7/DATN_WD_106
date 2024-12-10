@extends('admin.index')

@section('content')
<div class="container">
    <h1 class="my-4">Thống kê</h1>

    <!-- Row chứa form lọc song song -->
    <div class="row g-2 mb-4">
        <!-- Form lọc doanh thu -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.stats') }}">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="start_date_revenue" class="form-label">Từ ngày (Doanh thu):</label>
                        <input type="date" id="start_date_revenue" name="start_date_revenue" class="form-control" value="{{ request('start_date_revenue', $startDateRevenue) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date_revenue" class="form-label">Đến ngày (Doanh thu):</label>
                        <input type="date" id="end_date_revenue" name="end_date_revenue" class="form-control" value="{{ request('end_date_revenue', $endDateRevenue) }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Lọc (Doanh thu)</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Form lọc đơn hàng -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.stats') }}">
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="start_date_orders" class="form-label">Từ ngày (Đơn hàng):</label>
                        <input type="date" id="start_date_orders" name="start_date_orders" class="form-control" value="{{ request('start_date_orders', $startDateOrders) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date_orders" class="form-label">Đến ngày (Đơn hàng):</label>
                        <input type="date" id="end_date_orders" name="end_date_orders" class="form-control" value="{{ request('end_date_orders', $endDateOrders) }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Lọc (Đơn hàng)</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Row chứa cả 2 biểu đồ (Doanh thu và Đơn hàng) song song -->
    <div class="row mb-4">
        <!-- Biểu đồ doanh thu theo ngày -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Doanh thu </div>
                <div class="card-body">
                    <canvas id="dailyRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Biểu đồ đơn hàng theo ngày -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Đơn hàng </div>
                <div class="card-body">
                    <canvas id="dailyOrdersChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống kê tổng sản phẩm theo danh mục -->
    <!-- Biểu đồ sản phẩm theo danh mục -->
    <div class="card mb-4">
        <div class="card-header">Tổng sản phẩm theo danh mục</div>
        <div class="card-body">
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>

<!-- Script vẽ biểu đồ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ doanh thu theo ngày
    const dailyRevenueCtx = document.getElementById('dailyRevenueChart').getContext('2d');
    const dailyRevenueChart = new Chart(dailyRevenueCtx, {
        type: 'line',
        data: {
            labels: @json($dailyLabels),
            datasets: [{
                label: 'Doanh thu (VND)',
                data: @json($dailyRevenue),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    // Biểu đồ sản phẩm theo danh mục
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: @json($categories -> pluck('name')), // Danh mục sản phẩm
            datasets: [{
                label: 'Số lượng sản phẩm',
                data: @json($categories -> pluck('products_count')), // Số lượng sản phẩm trong mỗi danh mục
                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Màu nền của các cột
                borderColor: 'rgba(54, 162, 235, 1)', // Màu viền của các cột
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ đơn hàng theo ngày
    const dailyOrdersCtx = document.getElementById('dailyOrdersChart').getContext('2d');
    const dailyOrdersChart = new Chart(dailyOrdersCtx, {
        type: 'line',
        data: {
            labels: @json($ordersLabels),
            datasets: [{
                label: 'Số lượng đơn hàng',
                data: @json($ordersTotal),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection