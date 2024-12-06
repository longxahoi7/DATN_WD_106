@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongListPro.css')}}">
@endpush
@section('content')

<body>

    <body>
        <div class="container">
            <h1 class="text-center">Danh Sách sản Phẩm</h1>
            <a href="{{route('admin.products.create')}}"><button class="btn add-button">Thêm mới</button></a>

            <table class="product-table">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="product-list">
                @foreach ($products as $product )
                <tr>
                    <td>{{$product->sku}}</td>
                    <td>{{$product->name}}</td>
                    <td><img src="{{ Storage::url($product->main_image_url) }}" width="100px" height="100px" alt="Sản phẩm A"></td>
                    <td>{{$product->description}}</td>
                    <td>
                            <form action="{{ route('admin.products.toggle', $product->product_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit"
                                    class="btn {{ $product->is_active ? 'btn-danger' : 'btn-success' }}">
                                    {{ $product->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}
                                </button>
                            </form>
                        </td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->brand->name}}</td>
                    <td>
                        <a href="{{route('admin.products.detail',$product->product_id)}}"><button class="action-btn eye"><i class="fas fa-eye"></i></button></a>
                        
                        <a href="{{route('admin.products.edit',$product->product_id)}}"><button class="action-btn edit"><i class="fas fa-edit"></i></button></a>
                          <!-- Form xóa -->
                          <form action="{{ route('admin.products.delete', $product->product_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa màu sắc này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                    </td>
                </tr>
               
                @endforeach
               
            </tbody>
        </table>

            <nav>
    <ul class="pagination justify-content-center">
        {{ $products->links() }}
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