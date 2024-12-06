@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">>
@endpush
@section('content')

<body>
    <div class="container1 mt-4">
        <div class="form-row mb-4">
            <div class="col">
                <input type="date" class="form-control" placeholder="Từ ngày" />
            </div>
            <div class="col-auto">
                <span>-</span>
            </div>
            <div class="col">
                <input type="date" class="form-control" placeholder="Đến ngày" />
            </div>
        </div>
        <button class="btn btn-success mb-4">CHỌN LẠI</button>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tình trạng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày mua hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total, 2) }} VND</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.orderDetail', $order->order_id) }}" class="fas fa-eye text-success"></a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endpush
</body>
@endsection

</html>