@extends('admin.index')

@section('content')
<div class="container mt-4">
    <!-- Tiêu đề -->
    <div class="button-header">
        <button>Danh Sách Kích Thước <i class="fa fa-star"></i></button>
    </div>

    @if(Auth::user()->role !== 3)
    <a href="{{ route('admin.sizes.create') }}" class="btn add-button">Thêm mới</a>
    @else
    @endif
    <table class="product-table table table-bordered text-center align-middle">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Tên kích thước</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sizes as $size)
            <tr>
                <td>{{ $size->size_id }}</td>
                <td>{{ $size->name }}</td>
                <td>
                    <div class="icon-product d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.sizes.detail', $size->size_id) }}" class="text-info action-icons">
                            <button class="action-btn eye" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <a href="{{ route('admin.sizes.edit', $size->size_id) }}" class="text-warning action-icons">
                            <button class="action-btn edit" title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </button>
                        </a>
                        @if(Auth::user()->role !== 3)
                        <form action="{{ route('admin.sizes.delete', $size->size_id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa kích thước này?');">
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
        <ul class="pagination justify-content-center">
            {{ $sizes->links() }}
        </ul>
    </nav>
</div>

<!-- Scripts -->
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush

@endsection