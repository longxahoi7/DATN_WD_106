@extends('admin.index')

@section('content')
<div class="container">
    <h1 class="my-4">Thống kê</h1>

    <!-- Form chọn ngày cho Doanh thu -->
    <form method="GET" action="{{ route('admin.stats') }}" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="start_date_revenue" class="form-label">Từ ngày (Doanh thu):</label>
                <input type="date" id="start_date_revenue" name="start_date_revenue" class="form-control" value="{{ request('start_date_revenue', $startDateRevenue) }}">
            </div>
            <div class="col-md-4">
                <label for="end_date_revenue" class="form-label">Đến ngày (Doanh thu):</label>
                <input type="date" id="end_date_revenue" name="end_date_revenue" class="form-control" value="{{ request('end_date_revenue', $endDateRevenue) }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Lọc (Doanh thu)</button>
            </div>
        </div>
    </form>

    <!-- Biểu đồ doanh thu theo ngày -->
    <div class="card mb-4">
        <div class="card-header">Doanh thu theo ngày</div>
        <div class="card-body">
            <canvas id="dailyRevenueChart"></canvas>
        </div>
    </div>

    <!-- Form chọn ngày cho Đơn hàng -->
    <form method="GET" action="{{ route('admin.stats') }}" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="start_date_orders" class="form-label">Từ ngày (Đơn hàng):</label>
                <input type="date" id="start_date_orders" name="start_date_orders" class="form-control" value="{{ request('start_date_orders', $startDateOrders) }}">
            </div>
            <div class="col-md-4">
                <label for="end_date_orders" class="form-label">Đến ngày (Đơn hàng):</label>
                <input type="date" id="end_date_orders" name="end_date_orders" class="form-control" value="{{ request('end_date_orders', $endDateOrders) }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Lọc (Đơn hàng)</button>
            </div>
        </div>
    </form>

    <!-- Biểu đồ đơn hàng theo ngày -->
    <div class="card mb-4">
        <div class="card-header">Đơn hàng theo ngày</div>
        <div class="card-body">
            <canvas id="dailyOrdersChart"></canvas>
        </div>
    </div>

    <!-- Biểu đồ doanh thu theo tháng -->
    <div class="card mb-4">
        <div class="card-header">Doanh thu theo tháng</div>
        <div class="card-body">
            <canvas id="monthlyRevenueChart"></canvas>
        </div>
    </div>

    <!-- Thống kê danh mục -->
    <div class="card">
        <div class="card-header">Số lượng sản phẩm theo danh mục</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Danh mục</th>
                        <th>Số lượng sản phẩm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

    // Biểu đồ đơn hàng theo ngày
    const dailyOrdersCtx = document.getElementById('dailyOrdersChart').getContext('2d');
    const dailyOrdersChart = new Chart(dailyOrdersCtx, {
        type: 'line',
        data: {
            labels: @json($dailyLabels),
            datasets: [{
                label: 'Số lượng đơn hàng',
                data: @json($dailyOrders),
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

    // Biểu đồ doanh thu theo tháng
    const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
    const monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
        type: 'bar',
        data: {
            labels: @json($monthlyLabels),
            datasets: [{
                label: 'Doanh thu (VND)',
                data: @json($monthlyRevenue),
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgba(153, 102, 255, 1)',
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
</script>
@endsection
