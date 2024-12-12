@extends('user.index')

@section('content')
<div class="container">
    <h1>Lịch sử mua hàng</h1>

    @if ($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        @foreach ($orders as $order)
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Đơn hàng #{{ $order->order_id }}</strong> - 
                    <span>Ngày đặt: {{ $order->order_date->format('d/m/Y H:i') }}</span>
                </div>
                <div class="card-body">
                    <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
                    
                    <h5>Danh sách sản phẩm:</h5>
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>
                                {{ $item->product->name }} - 
                                Số lượng: {{ $item->quantity }} - 
                                Giá: {{ number_format($item->total, 0, ',', '.') }} VND
                            </li>
                        @endforeach
                    </ul>

                    @if ($order->status === 'pending')
                        <form action="{{ route('user.order.cancelOrder', $order->order_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">Hủy đơn hàng</button>
                        </form>
                    @else
                        <p class="text-muted">Bạn không thể hủy đơn hàng ở trạng thái này.</p>
                    @endif

                    <!-- Thêm nút Chi tiết đơn hàng -->
                    <a href="{{ route('user.order.detail', $order->order_id) }}" class="btn btn-primary btn-sm mt-3">Chi tiết đơn hàng</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
