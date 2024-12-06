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
                    <p><strong>Tên người mua:</strong>{{ $order->user->name }}</p>
                    <p><strong>Email:</strong>{{ $order->user->email }}</p>
                    <p><strong>Điện thoại:</strong>{{ $order->user->phone }}</p>
                    <p><strong>Địa chỉ:</strong>{{ $order->user->address }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-card">
                    <h2>2. Thông tin đơn hàng</h2>
                    <p><strong>Mã đơn hàng:</strong>  {{ $order->order_id }}</p>
                    <p><strong>Trạng thái thanh toán:</strong> {{ $order->status }}</p>
                    <p><strong>Ngày mua hàng:</strong>{{ $order->created_at->format('Y-m-d') }}</p>
                    <p><strong>Trạng thái:</strong> Chờ xác nhận</p>
                    <!-- <div class="mt-4">
                        <button class="btn btn-success" id="confirmOrderBtn">Xác nhận đơn hàng</button>
                        <button class="btn btn-danger" id="cancelOrderBtn">Hủy đơn hàng</button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="order-card">
            <h2>3. Chi tiết đơn hàng</h2>
            <p>Khách hàng ghi chú:</p>
            <table class="table table-bordered order-table mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1.</td>
                        <td class="text-center">
                            <img alt="Áo Sơ Mi Tay Ngắn Nữ Cotton Sựờng TA324C8220" height="50"
                                src="https://storage.googleapis.com/a1aa/image/Wge7wZXnR80xOypFuAPPInrIYcULlfGtJg9beNun1lyHjzonA.jpg"
                                width="50" />
                        </td>
                        <td>Áo Sơ Mi Tay Ngắn Nữ Cotton Sựờng TA324C8220 - Chính Hãng GenViet - GENVJET JEANS</td>
                        <td class="text-right">199.000 đ</td>
                        <td class="text-center">3</td>
                        <td class="text-right">597.000 đ</td>
                    </tr>
                    <tr>
                        <td class="text-center">2.</td>
                        <td class="text-center">
                            <img alt="Quần Âu Baggy Nam Caro TUT05 Menswear ODT03" height="50"
                                src="https://storage.googleapis.com/a1aa/image/jxg4bQLEJHInKhX5eNVCLeIsobFkevdTt763rdAUm4CFjzonA.jpg"
                                width="50" />
                        </td>
                        <td>Quần Âu Baggy Nam Caro TUT05 Menswear ODT03 - Quần Tây Đen Ống Côn Trẻ Trung Cotton Hàn Quốc
                            Ít Nhăn, Tôn Dáng, Lịch Sự</td>
                        <td class="text-right">190.000 đ</td>
                        <td class="text-center">2</td>
                        <td class="text-right">380.000 đ</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right mt-4">
                <strong>Tổng tiền:</strong>
                <span class="total-amount">482.470 đ</span>
            </div>
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
            document.getElementById('confirmOrderBtn').addEventListener('click', function () {
                this.classList.add('btn-cancel');
                document.getElementById('cancelOrderBtn').classList.add('btn-cancel');
                document.getElementById('cancelOrderBtn').innerText = 'Đã hủy';
                document.getElementById('cancelOrderBtn').disabled = true;
            });

            document.getElementById('cancelOrderBtn').addEventListener('click', function () {
                $('#cancelModal').modal('show');
            });

            document.getElementById('cancelForm').addEventListener('submit', function (event) {
                event.preventDefault();
                // Xử lý logic hủy đơn hàng ở đây
                $('#cancelModal').modal('hide');
                alert('Đơn hàng đã được hủy với lý do: ' + document.getElementById('reason').value);
            });
        </script>
    @endpush
</body>
@endsection