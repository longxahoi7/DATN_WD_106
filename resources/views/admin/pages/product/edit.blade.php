@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongCreatePro.css')}}">
@endpush
@section('content')

<body>
    <div class="container">
        <h1 class="text-center">Sửa sản phẩm </h1>
        <form id="productForm" method="POST" action="{{route('admin.products.update', $product->product_id)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="productName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName" value="{{$product->name}}" name="name" placeholder="Nhập tên sản phẩm"
                    required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productSKU">Mã sản phẩm</label>
                <input type="text" class="form-control" value="{{$product->sku}}" id="productSKU" name="sku" placeholder="Nhập mã sản phẩm"
                    required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productSubtitle">Subtitle sản phẩm</label>
                <input type="text" class="form-control" value="{{$product->subtitle}}" id="productSubtitle" name="subtitle"
                    placeholder="Nhập subtitle sản phẩm" required maxlength="50" />
            </div>
            <div class="form-group">
                <label for="productDescription">Mô tả sản phẩm</label>
                <input type="text" class="form-control" id="productDescription" value="{{$product->description}}" name="description"
                    placeholder="Mô tả sản phẩm" required maxlength="255" />
            </div>
            <div class="form-group">
                <label for="productCategory">Danh mục sản phẩm</label>
                <select class="form-control" id="productCategory" name="product_category_id" required>
                    <option value="0">Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                <option value="{{ $category['category_id'] }}"
                    @if(old('product_category_id', $product->product_category_id) == $category['category_id']) selected @endif>
                    {{ $category['name'] }}
                </option>
            @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="productBrand">Thương hiệu sản phẩm</label>
                <select class="form-control" id="productBrand" name="brand_id" required>
                    <option value="">Chọn thương hiệu sản phẩm</option>
                    @foreach($brands as $brand)
                        @if ($product->brand_id == $brand->brand_id)
                            <option value="{{ $brand->brand_id }}" selected>{{ $brand->name }}</option>
                        @else
                            <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kích thước sản phẩm</label>
                <div class="checkbox-group">
    @foreach($sizes as $size)
        <div>
            <input 
                type="checkbox" 
                id="size{{ $size->id }}" 
                name="size_id[]" 
                value="{{ $size->size_id }}"
                @if(in_array($size->size_id, old('size_id', $product->sizes->pluck('size_id')->toArray()))) checked @endif
            />
            <label for="size{{ $size->size_id }}">{{ $size->name }}</label>
        </div>
    @endforeach
</div>
            </div>
            <div class="checkbox-group">
            @foreach($colors as $color)
                <div>
                    <input type="checkbox" id="color{{ $color->color_id }}" name="color_id[]"
                        value="{{ $color->color_id }}" 
                        @if(in_array($color->color_id, old('color_id', $product->colors->pluck('color_id')->toArray()))) checked @endif />
                    <label for="color{{ $color->color_id }}">{{ $color->name }}</label>
                </div>
            @endforeach
        </div>
            <div class="form-group">
                <label for="discount">discount</label>
                <input type="number" value="{{$product->discount}}" class="form-control" id="productdiscount" name="discount"
                    placeholder="Nhập giảm giá" required min="0" />
            </div>
            <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" class="form-control" value="{{$product->start_date}}" id="start_date" name="start_date" placeholder="Nhập ngày bắt đầu cho discount"  />
            </div>
            <div class="form-group">
                <label for="start_date">Ngày kết thúc</label>
                <input type="date" class="form-control" id="start_date" alue="{{$product->start_date}}" name="end_date" placeholder="Nhập ngày kết thúc cho discount"  />
            </div>
            <div class="form-group">
        <label for="productImage">Ảnh sản phẩm</label>
        @if($product->main_image_url)
            <img src="{{ asset($product->main_image_url) }}" width="100px" height="100px" alt="Ảnh sản phẩm hiện tại" />
        @endif
        <input type="file" class="form-control-file" id="productImage" name="main_image_url" accept="image/*" />
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