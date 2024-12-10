@extends('admin.index')
@section('content')

<body>

    <body>
        <div class="container mt-2">

            <div class="button-header">
                <button>
                    Danh Sách sản Phẩm <i class="fa fa-star"></i>
                </button>
            </div>

            <a href="" class="btn add-button">Thêm mới</a>
            <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="button-header">
                                <button>
                                    Thêm Sản Phẩm Mới <i class="fa fa-star"></i>
                                </button>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">✖</button>
                        </div>
                        <div class="modal-body">
                            <!-- AJAX nội dung sẽ được load tại đây -->
                            <div id="modalContent">
                                <p>Đang tải...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <table class="product-table table table-bordered text-center align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%;">STT</th>
                        <th style="width: 15%;">Hình ảnh</th>
                        <th style="width: 15%;">Tên Sản Phẩm</th>
                        <th style="width: 10%;">Mã</th>
                        <th style="width: 15%;">Danh mục</th>
                        <th style="width: 15%;">Thương hiệu</th>
                        <th style="width: 10%;">Hoạt động </th>
                        <th style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ Storage::url($product->main_image_url) }}" alt="Sản phẩm"
                                onerror="this.onerror=null; this.src='{{ asset('imagePro/icon/icon-no-image.png') }}';">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>
                            <form action="{{ route('admin.products.toggle', $product->product_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="custom-btn-active-admin {{ $product->is_active ? 'btn-success' : 'btn-danger' }}">
                                    <p>{{ $product->is_active ? 'Hoạt động' : 'Tắt hoạt động' }}</p>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="icon-product d-flex justify-content-center gap-2">
                                <!-- Xem -->
                                <a href="{{ route('admin.products.detail', $product->product_id) }}">
                                    <button class="action-btn eye"><i class="fas fa-eye"></i></button>
                                </a>
                                <!-- Sửa -->
                                <a href="{{ route('admin.products.edit', $product->product_id) }}">
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                </a>
                                <!-- Xóa -->
                                <form action="{{ route('admin.products.delete', $product->product_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-info">
            </div>
            <nav>
                <ul class="pagination">
                    {{ $products->links() }}
                </ul>
            </nav>

        </div>

        <script>
        $(document).ready(function() {
            $('.add-button').on('click', function(e) {
                e.preventDefault();
                $('#modalContent').html('<p>Đang tải...</p>');
                $('#productCreateModal').modal('show');

                $.ajax({
                    url: "{{ route('admin.products.create') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#modalContent').html(response);
                    },
                    error: function() {
                        $('#modalContent').html('<p>Lỗi! Không thể tải nội dung.</p>');
                    }
                });
            });
        });
        </script>

    </body>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
    function setDeleteData(productName) {
        document.getElementById("deleteproductName").textContent =
            productName;
    }

    function confirmDelete() {
        alert("Thương hiệu đã được xóa!");
        $("#deleteproductModal").modal("hide");
    }
    </script>
    @endpush
</body>









@endsection