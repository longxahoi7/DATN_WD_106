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
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->category_id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <img src="{{ $category->image }}" class="cusstom-no-image"
                        onerror="this.onerror=null; this.src='{{ asset('imagePro/icon/icon-no-image.png') }}';">
                </td>
                <td>
                    <form action="{{ route('admin.categories.toggle', $category->category_id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="custom-btn-active-admin {{ $category->is_active ? 'btn-danger' : 'btn-success' }}">
                            <p>{{ $category->is_active ? 'Tắt hoạt động' : 'họat động' }}</p>
                        </button>
                    </form>
                </td>
                <td>
                    <div class="icon-product d-flex justify-content-center gap-2">
                        <!-- Chi tiết -->
                        <a href="{{ route('admin.categories.detail', $category->category_id) }}">
                            <button class="action-btn eye" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <!-- Sửa -->
                        <a href="{{ route('admin.categories.edit', $category->category_id) }}">
                            <button class="action-btn edit" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </button>
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

<!-- Modal Xóa Thể Hiện -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xoá danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalContent">Bạn có chắc chắn muốn xóa danh mục này?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
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