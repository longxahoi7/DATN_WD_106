@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')

<body>

    <body>
        <div class="container">
            <h1 class="text-center">Danh Sách Danh mục</h1>
            <a href="{{route('admin.categories.create')}}"><button class="btn add-button">Thêm mới</button></a>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh mục</th>
                        <th>Hình ảnh</th>
                        <th>Mô Tả</th>
                        <th>Trạng thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->category_id}}</td>
                            <td>{{$category->name}}</td>
                            <td><img src=" {{ asset('storage/' . $user->image) }}" width="100px" height="100px" alt=""></td>
                            <td>{{$category->description}}</td>
                            <td>
                                <form action="{{ route('admin.categories.toggle', $category->category_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $category->is_active ? 'btn-danger' : 'btn-success' }}">
                                        {{ $category->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}
                                    </button>
                                </form>
                            </td>


                            <td class="icon-action-category">
                                <a href="{{route('admin.categories.detail', $category->category_id)}}"> <i
                                        class="fas fa-eye text-info" title="Chi tiết"></i></a>
                                <a href="{{route('admin.categories.edit', $category->category_id)}}"><i
                                        class="fas fa-edit text-warning" title="Sửa"></i></a>
                                <!-- Form xóa -->
                                <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa màu sắc này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 0;" class="btn btn-link text-danger" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Có thể thêm nhiều hàng hơn ở đây -->
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center">
                    {{ $categories->links() }}
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
            function setDeleteData(categoryName) {
                document.getElementById("deletecategoryName").textContent =
                    categoryName;
            }

            function confirmDelete() {
                alert("Thương hiệu đã được xóa!");
                $("#deletecategoryModal").modal("hide");
            }
        </script>
    @endpush
</body>
@endsection