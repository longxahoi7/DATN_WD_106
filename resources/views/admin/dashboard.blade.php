@extends('admin.index')

@section('content')
<style>
    .custom-btn-filte-dashboard {
        background-color: #fff;
        color: #000;
        border: 1px solid #000;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-btn-filte-dashboard:hover {
        background-color: #000;
        color: #fff;
        border: 1px solid #000;
    }
    .card-header {
    background-color: #000; /* Đầu mục màu đen */
    color: #fff;
    font-weight: bold;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    border-radius: 8px 8px 0 0;
    }

</style>
<div class="container">
    <div class="button-header">
        <button>
            Thống kê <i class="fa fa-star"></i>
        </button>
    </div>

    <!-- Row chứa form lọc song song -->
    <div class="row g-2 mb-4">
        <!-- Form lọc doanh thu -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.dashboard') }}">
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
                        <button type="submit" class="custom-btn-filte-dashboard w-100">Lọc (Doanh thu)</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Form lọc đơn hàng -->
        <div class="col-md-6">
            <form method="GET" action="{{ route('admin.dashboard') }}">
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
                        <button type="submit" class="custom-btn-filte-dashboard w-100">Lọc (Đơn hàng)</button>
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
    <div class="card mb-4">
        <div class="card-header">Thống kê số lượng sản phẩm đã bán</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng bán</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($soldProductsStats as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sold_quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                borderColor: 'rgb(35, 179, 179)',
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