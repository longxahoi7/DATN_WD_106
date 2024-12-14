@extends('admin.index')
@section('content')

<style>
.cusstom-no-image {
    width: 50px !important;
    height: 50px !important;
}
</style>

<div class="container mt-4">
    <!-- Tiêu đề -->
    <div class="button-header">
        <button>
            Danh Sách Danh Mục <i class="fa fa-star"></i>
        </button>
    </div>

    @if(Auth::user()->role !== 3)
    <a href="{{ route('admin.categories.create') }}" class="btn add-button"> Thêm mới </a>
    @else
    @endif

    <!-- Modal Add -->
    <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="button-header">
                        <button>
                            Thêm mới danh mục <i class="fa fa-star"></i>
                        </button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">✖</button>
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

    <!-- Modal Popup -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="button-header">
                        <button>
                            Chi tiết danh mục<i class="fa fa-star"></i>
                        </button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">✖</button>
                </div>
                <div class="modal-body p-5">
                    <!-- Nội dung chi tiết sản phẩm sẽ được load tại đây -->
                    <div id="detailContent">
                        <p>Đang tải...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="productEditModal" tabindex="-1" aria-labelledby="productEditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="button-header">
                        <button>
                            Chỉnh Sửa danh mục<i class="fa fa-star"></i>
                        </button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">✖</button>
                </div>
                <div class="modal-body">
                    <!-- Nội dung chỉnh sửa sản phẩm sẽ được load tại đây -->
                    <div id="editContent">
                        <p>Đang tải...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng danh sách danh mục -->
    <table class="product-table table table-bordered text-center align-middle">
        <thead class="thead-dark">
            <tr>
                <th style="width: 10%;">STT</th>
                <th style="width: 20%;">Tên Danh mục</th>
                <th style="width: 20%;">Hình ảnh</th>
                <th style="width: 20%;">Trạng thái</th>
                <th style="width: 20%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <img src="{{ Storage::url($category->image) }} " class="cusstom-no-image"
                        onerror="this.onerror=null; this.src='{{ asset('imagePro/icon/icon-no-image.png') }}';">
                </td>
                <td>
                    <form action="{{ route('admin.categories.toggle', $category->category_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="custom-btn-active-admin {{ $category->is_active ? 'btn-success' : 'btn-danger' }}">
                            <p>{{ $category->is_active ? 'hoạt động' : 'Tắt hoạt động' }}</p>
                        </button>
                    </form>
                </td>
                <td>
                    <div class="icon-product d-flex justify-content-center gap-2">
                        <!-- Xem -->
                        <a href="" data-id="{{ $category->category_id }}">
                            <button class="action-btn eye"><i class="fas fa-eye"></i></button>
                        </a>
                        <!-- Sửa -->
                        <a href="" data-id="{{ $category->category_id }}">
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                        </a>
                        <!-- Xóa -->
                        @if(Auth::user()->role !== 3)
                        <!-- Kiểm tra nếu không phải manager -->
                        <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @else
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Phân trang -->
    <nav>
        <ul class="pagination">
            {{ $categories->links() }}
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
            url: "{{ route('admin.categories.create') }}",
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


$(document).ready(function() {
    // Đóng modal thêm mới
    $('#productCreateModal .btn-close').on('click', function() {
        $('#productCreateModal').modal('hide');
    });

    // Đóng modal chi tiết
    $('#productDetailModal .btn-close').on('click', function() {
        $('#productDetailModal').modal('hide');
    });

    // Đóng modal sửa
    $('#productEditModal .btn-close').on('click', function() {
        $('#productEditModal').modal('hide');
    });
});

$(document).ready(function() {

    $('.eye').on('click', function(e) {
        e.preventDefault();
        let productId = $(this).closest('a').data('id');

        // Hiển thị modal và tải nội dung chi tiết
        $('#detailContent').html('<p>Đang tải...</p>');
        $('#productDetailModal').modal('show');

        $.ajax({
            url: `/admin/categories/detail-category/${productId}`,
            type: 'GET',
            success: function(response) {
                $('#detailContent').html(response);
            },
            error: function() {
                $('#detailContent').html('<p>Lỗi! Không thể tải nội dung.</p>');
            }
        });
    });

    $('.edit').on('click', function(e) {
        e.preventDefault();
        let productId = $(this).closest('a').data('id');
        $('#editContent').html('<p>Đang tải...</p>');
        $('#productEditModal').modal('show');

        $.ajax({
            url: `/admin/categories/edit-category/${productId}`,
            type: 'GET',
            success: function(response) {
                $('#editContent').html(response);
            },
            error: function() {
                $('#editContent').html('<p>Lỗi! Không thể tải nội dung.</p>');
            }
        });
    });
});

function confirmDelete() {
    alert("Xóa danh mục thành công!");
    $('#deleteModal').modal('hide');
}
</script>

<!-- Thêm các Scripts cần thiết -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>


<script>
function confirmDelete() {
    alert("Xóa danh mục thành công!");
    $('#deleteModal').modal('hide');
}
</script>


@endsection