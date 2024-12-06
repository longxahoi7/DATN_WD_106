@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')

<body>

    <body>
        <div class="container">
            <h1 class="text-center">Danh Sách Màu Sắc</h1>
            <a href="{{route('admin.colors.create')}}"><button class="btn add-button">Thêm mới</button></a>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>STT</th>
                        <th>Tên màu sắc</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($colors as $color)
                    <tr>
                        <td>{{$color->color_id}}</td>
                        <td>{{$color->name}}</td>
                        <td class="action-icons">
                           <a href="{{route('admin.colors.detail',$color->color_id)}}"> <i class="fas fa-eye text-info" title="Chi tiết"></i></a>
                            <a href="{{route('admin.colors.edit',$color->color_id)}}"><i class="fas fa-edit text-warning" title="Sửa"></i></a>
                           <!-- Form xóa -->
                           <form action="{{ route('admin.colors.delete', $color->color_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa màu sắc này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger" title="Xóa">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Có thể thêm nhiều hàng hơn ở đây -->
                </tbody>
            </table>

            <!-- Modal Xóa Thương Hiệu -->
            <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog"
                aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteBrandModalLabel">
                                Xóa thương hiệu
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Bạn có chắc chắn muốn xóa thương hiệu
                                <span id="deleteBrandName"></span>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" class="btn btn-success" onclick="confirmDelete();">
                                Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <nav>
    <ul class="pagination justify-content-center">
        {{ $colors->links() }}
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
            function setDeleteData(brandName) {
                document.getElementById("deleteBrandName").textContent =
                    brandName;
            }

            function confirmDelete() {
                alert("Thương hiệu đã được xóa!");
                $("#deleteBrandModal").modal("hide");
            }
        </script>
    @endpush
</body>
@endsection