@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">>
@endpush
@section('content')

<body>
    <div class="container mt-5">
        <h2>Danh sách đơn hàng đang vận chuyển</h2>
        <div class="card mb-3" style="border: 1px solid #ddd; border-radius: 5px">
            <div class="card-body">
                <h5 class="card-title">Mã đơn hàng: 24</h5>
                <p><strong>Khách hàng:</strong> chiurui</p>
                <p><strong>Số điện thoại:</strong> 0123456789</p>
                <p>
                    <strong>Địa chỉ nhận hàng:</strong> Năm Mới, Tân Hiệp,
                    Huyện Chợ Lách, Tỉnh Bến Tre
                </p>
                <p><strong>Đặt hàng lúc:</strong> 2024-11-20 12:36:15</p>
                <hr />
                <h6>Sản phẩm:</h6>
                <div class="mb-2 d-flex align-items-center">
                    <img src="https://via.placeholder.com/100" alt="Quần Áo Nam PN STORE" class="product-image" />
                    <div>
                        <h6>Quần Áo Nam PN STORE</h6>
                        <p>
                            Điều Chỉnh Độ Rộng Vòng Eo Form Dáng Baggy Phong
                            Cách Hàn Quốc Vải Co Giãn - QT CAP
                        </p>
                        <p><strong>Giá:</strong> 99,000 đ</p>
                    </div>
                </div>
                <p style="font-weight: bold">Tổng tiền: 1,006,690 đ</p>
                <button class="btn btn-success me-5" style="margin-top: 10px" id="confirmBtn">
                    Xác nhận đã giao
                </button>
                <button class="btn btn-danger" style="margin-top: 10px" id="cancelBtn">
                    Hủy giao
                </button>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">
                        Lý do hủy giao hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="cancelReason" rows="3" placeholder="Nhập lý do hủy"
                        required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">
                        Xác nhận hủy
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document
                .getElementById("confirmBtn")
                .addEventListener("click", function () {
                    alert("Đơn hàng đã được xác nhận giao.");
                    document.getElementById("cancelBtn").disabled = true;
                });

            document
                .getElementById("cancelBtn")
                .addEventListener("click", function () {
                    $(this).addClass("btn-cancelled").prop("disabled", true);
                    $("#cancelModal").modal("show");
                });

            document
                .getElementById("confirmCancelBtn")
                .addEventListener("click", function () {
                    var reason = document.getElementById("cancelReason").value;
                    alert("Đơn hàng đã được hủy với lý do: " + reason);
                    $("#cancelModal").modal("hide");
                });
        </script>
    @endpush
</body>
@endsection