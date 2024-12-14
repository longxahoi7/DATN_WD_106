@extends('admin.index')

@section('content')

<div class="container mt-4">
    <!-- Tiêu đề -->
    <div class="button-header">
        <button>Danh Sách Thương Hiệu <i class="fa fa-star"></i></button>
    </div>
    <table class="product-table table table-bordered text-center align-middle">
        <thead class="thead-dark">
            <tr>
                <th>STT</th>
                <th>Email khác hàng</th>
                <th>Tên sản phẩm</th>
                <th>Số sao</th>
                <th>Bình luận</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->review_id }}</td>
                <td>{{ $review->user->email }}</td>
                <td>{{ $review->product->name }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->created_at }}</td>
                
                <td>
                    <form action="{{ route('admin.reviews.toggle', $review->review_id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        <button type="submit"
                            class="custom-btn-active-admin {{ $review->is_active ? 'btn-danger' : 'btn-success' }} status-btn-active">
                            <p>{{ $review->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}</p>
                        </button>
                    </form>
                </td>
                <td>
                    <div class="icon-product d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.reviews.detail', $review->review_id) }}" class="text-info">
                            <button class="action-btn eye" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </button>
                        </a>
                        <a href="{{ route('admin.reviews.reply', $review->review_id) }}" class="text-info">
                            <button class="action-btn eye" title="Trả lời tin nhắn">
                                <i class="fas fa-reply"></i>
                            </button>
                        </a>
                        @if(Auth::user()->role !== 3)
                        <form action="{{ route('admin.reviews.delete', $review->review_id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa thương hiệu này?');"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete">
                                <i class="fas fa-trash-alt" title="Xóa"></i>
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


</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush

@endsection