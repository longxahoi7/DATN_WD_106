@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongCreatePro.css')}}">
@endpush
@section('content')

<body>
<div class="container">
        <h1 class="text-center">Thêm Sản Phẩm Mới</h1>
        <form id="productForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName" name="name" placeholder="Nhập tên sản phẩm" required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productSKU">Mã sản phẩm</label>
                <input type="text" class="form-control" id="productSKU" name="sku" placeholder="Nhập mã sản phẩm" required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productSubtitle">Subtitle sản phẩm</label>
                <input type="text" class="form-control" id="productSubtitle" name="subtitle" placeholder="Nhập subtitle sản phẩm" required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productDescription">Mô tả sản phẩm</label>
                <input type="text" class="form-control" id="productDescription" name="description" placeholder="Mô tả sản phẩm" required maxlength="255" />
            </div>
            <div class="form-group">
                <label for="productCategory">Danh mục sản phẩm</label>
                <select class="form-control" id="productCategory" name="product_category_id" required>
                     <option value="0">Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="productBrand">Thương hiệu sản phẩm</label>
                <select class="form-control" id="productBrand" name="brand_id" required>
                    <option value="">Chọn thương hiệu sản phẩm</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kích thước sản phẩm</label>
                <div class="checkbox-group">
                    @foreach($sizes as $size)
                    <div>
                        <input type="checkbox" id="size{{ $size->id }}" name="size_id[]" value="{{ $size->size_id }}" />
                        <label for="size{{ $size->size_id }}">{{ $size->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label>Màu sắc sản phẩm</label>
                <div class="checkbox-group">
                    @foreach($colors as $color)
                    <div>
                        <input type="checkbox" id="color{{ $color->color_id }}" name="color_id[]" value="{{ $color->color_id }}" />
                        <label for="color{{ $color->color_id }}">{{ $color->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" class="form-control" id="productdiscount" name="discount" placeholder="Nhập giảm giá" required min="0" />
            </div>
            <div class="form-group">
                <label for="discount">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="productdiscount" name="start_date" placeholder="Nhập ngày bắt đầu cho discount"  />
            </div>
            <div class="form-group">
                <label for="discount">Ngày kết thúc</label>
                <input type="date" class="form-control" id="productdiscount" name="end_date" placeholder="Nhập ngày kết thúc cho discount"  />
            </div>
            <div class="form-group">
                <label for="productImage">Ảnh sản phẩm</label>
                <input type="file" class="form-control-file" id="productImage" name="main_image_url" accept="image/*" required />
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-submit">Lưu</button>
                <button type="button" class="btn btn-secondary" onclick="">Quay lại</button>
            </div>
        </form>
    </div>
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