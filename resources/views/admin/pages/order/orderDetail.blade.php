@extends('admin.index')
@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">>
@endpush
@section('content')

<body>
    <div class="container order-details mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="order-card">
                    <h2>1. Thông tin khách hàng</h2>
                    <p><strong>Tên người mua: </strong>{{ $order->user->name }}</p>
                    <p><strong>Email: </strong>{{ $order->user->email }}</p>
                    <p><strong>Số điện thoại nhận hàng: </strong>{{ $order->phone }}</p>
                    <p><strong>Địa chỉ nhận hàng: </strong>{{ $order->shipping_address  }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-card">
                    <h2>2. Thông tin đơn hàng</h2>
                    <p><strong>Mã đơn hàng:</strong> {{ $order->order_id }}</p>
                    @php
                    $statusLabels = [
                    'pending' => 'Đang chờ xử lý',
                    'shipped' => 'Đang vận chuyển',
                    'delivered' => 'Đã giao hàng',
                    'cancelled' => 'Đã hủy',
                    'completed' => 'Hoàn thành',
                    ];
                    $statusTranslations = [
                    'pending' => 'Chờ xử lý',
                    'paid' => 'Đã thanh toán',
                    'failed' => 'Thanh toán thất bại',
                    'refunded' => 'Hoàn tiền',
                    'cancelled' => 'Đã hủy',
                    ];

                    @endphp
                    <p><strong>Trạng thái đơn hàng:</strong>  {{ $statusLabels[$order->status] ?? 'Không xác định' }}</p>
                    <p><strong>Trạng thái thanh toán:</strong> {{ $statusTranslations[$order->payment_status] ?? 'Không xác định' }}</p>
                    <p><strong>Ngày mua hàng:</strong> {{ $order->created_at->format('d-m-Y H:i:s') }}</p>
                    <p><strong>Ngày cập nhật đơn hàng:</strong> {{ $order->updated_at->format('d-m-Y H:i:s') }}</p>
                    <!-- <p><strong>Trạng thái:</strong> Chờ xác nhận</p> -->
                    <div class="mt-4">
                        <!-- <button class="btn btn-success" id="confirmOrderBtn">Xác nhận đơn hàng</button>
                        <button class="btn btn-danger" id="cancelOrderBtn">Hủy đơn hàng</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="order-card">
            <h2>3. Chi tiết đơn hàng</h2>
            <p>Khách hàng ghi chú:</p>
            <table class="table table-bordered order-table mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $index => $orderItem)
                    <tr>
                        <td class="text-center">
                            <img src="/storage/{{ $orderItem->product->main_image_url }}" alt="{{ $orderItem->product->name }}" width="50" height="50">
                        </td>
                        <td>{{ $orderItem->product->name }}</td>
                        <td>{{ number_format($orderItem->attributeProduct->price ?? 0) }} VND</td>
                        <td>{{ $orderItem->color ? $orderItem->color->name : 'N/A' }}</td> <!-- Màu sắc -->
                        <td>{{ $orderItem->size ? $orderItem->size->name : 'N/A' }}</td> <!-- Kích cỡ -->
                        <td class="text-center">{{ $orderItem->quantity }}</td>
                        <td class="text-right">{{ number_format($orderItem->attributeProduct->price * $orderItem->quantity, 0, 2) }} đ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                            <tr>
                                <td colspan="6">Tổng giá trị đơn hàng</td>
                                <td>{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}
                                    VND</td>
                            </tr>
                            <tr>
                                <td colspan="6">Phí Ship</td>
                                <td>40,000 VND</td>
                            </tr>
                            <tr>
                                <td colspan="6">Thành tiền</td>
                                <td>{{ number_format($order->orderItems->sum(function($item) { return $item->price * $item->quantity; }) + 40000, 0, ',', '.') }}
                                    VND</td>
                            </tr>
                        </tfoot>
            </table>
            <!-- <div class="text-right mt-4">
                <strong>Tổng tiền:</strong>
                <span class="total-amount">482.470 đ</span>
            </div> -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Lý do hủy đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cancelForm">
                        <div class="form-group">
                            <label for="reason">Nhập lý do hủy:</label>
                            <textarea class="form-control" id="reason" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('confirmOrderBtn').addEventListener('click', function() {
            this.classList.add('btn-cancel');
            document.getElementById('cancelOrderBtn').classList.add('btn-cancel');
            document.getElementById('cancelOrderBtn').innerText = 'Đã hủy';
            document.getElementById('cancelOrderBtn').disabled = true;
        });

        document.getElementById('cancelOrderBtn').addEventListener('click', function() {
            $('#cancelModal').modal('show');
        });

        document.getElementById('cancelForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Xử lý logic hủy đơn hàng ở đây
            $('#cancelModal').modal('hide');
            alert('Đơn hàng đã được hủy với lý do: ' + document.getElementById('reason').value);
        });
    </script>
    @endpush
</body>
@endsection