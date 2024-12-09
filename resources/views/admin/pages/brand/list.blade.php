@extends('admin.index')
@push('styles')
@endpush
@section('content')

<body>

    <body>
        <div class="container">

            <div class="button-header">
                <button>
                    Danh Sách Thương Hiệu <i class="fa fa-star"></i>
                </button>
            </div>

            <a href="{{route('admin.brands.create')}}" class="btn add-button">Thêm mới</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Thương Hiệu</th>
                        <th>Mô Tả</th>
                        <th>Trạng thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{$brand->brand_id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->description}}</td>
                        <td>
                            <form action="{{ route('admin.brands.toggle', $brand->brand_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="btn {{ $brand->is_active ? 'btn-danger' : 'btn-success' }}">
                                    {{ $brand->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}
                                </button>
                            </form>
                        </td>


                        <td>
                            <div class="action-icons">
                                <a href="{{route('admin.brands.detail', $brand->brand_id)}}"> <i
                                        class="fas fa-eye text-info" title="Chi tiết"></i></a>
                                <a href="{{route('admin.brands.edit', $brand->brand_id)}}"><i
                                        class="fas fa-edit text-warning" title="Sửa"></i></a>
                                <!-- Form xóa -->
                                <form action="{{ route('admin.brands.delete', $brand->brand_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa màu sắc này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Có thể thêm nhiều hàng hơn ở đây -->
                </tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center">
                    {{ $brands->links() }}
                </ul>
            </nav>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>

    </script>
    @endpush
</body>
@endsection