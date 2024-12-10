@extends('admin.index')
@section('content')

<body>
    <div class="container mt-4">
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
                    <td>
                        <select class="form-control status-select" data-order-id="{{ $order->order_id }}"
                            data-initial-status="{{ $order->status }}">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                            </option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total, 2) }} VND</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.orderDetail', $order->order_id) }}"
                            class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script xử lý AJAX -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  Gắn CDN jQuery -->

    <script>
    $(document).on('change', '.status-select', function() {
        var currentStatus = $(this).val(); // Lấy trạng thái hiện tại
        var orderId = $(this).data('order-id'); // Lấy ID đơn hàng
        var initialStatus = $(this).data('initial-status'); // Lấy trạng thái ban đầu

        // Mảng chứa các trạng thái hợp lệ cho từng trạng thái hiện tại
        var validStatuses = {
            "pending": ["processing", "cancelled"],
            "processing": ["shipped"],
            "shipped": ["delivered"],
            "delivered": ["completed"],
            "completed": [],
            "cancelled": [] // Không thể thay đổi trạng thái nếu đã bị hủy
        };

        // Kiểm tra trạng thái mới có hợp lệ không
        if (!validStatuses[initialStatus].includes(currentStatus)) {
            // Nếu không hợp lệ, thông báo lỗi và khôi phục trạng thái ban đầu
            alert('Không thể chuyển trạng thái từ "' + initialStatus.charAt(0).toUpperCase() + initialStatus
                .slice(1) + '" đến "' + currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1) +
                '"!');
            $(this).val(initialStatus); // Đặt lại trạng thái ban đầu
            return false;
        }

        // Nếu hợp lệ, gửi yêu cầu AJAX hoặc cập nhật trạng thái
        console.log('Order ID:', orderId, 'New Status:', currentStatus);

        // Bạn có thể gửi AJAX để cập nhật trạng thái trong database
        $.ajax({
            url: "{{ route('admin.updateOrderStatus') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                order_id: orderId,
                status: currentStatus
            },
            success: function(response) {
                if (response.success) {
                    alert('Cập nhật trạng thái thành công!');
                    location.reload(); // Reload trang sau khi cập nhật thành công
                } else {
                    alert('Lỗi: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Không thể kết nối đến server. Vui lòng thử lại.');
                console.error(xhr.responseText);
            }
        });
    });
    </script>


</body>
@endsection