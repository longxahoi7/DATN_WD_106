@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')

<body>
    <div class="container mt-5">
        <h1 class="text-center">Sửa Danh Mục</h1>
        <form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên danh mục <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                    placeholder="Nhập tên thương hiệu" required />
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Nhập mô tả">{{ $category->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Ảnh</label>
                <img src="{{$category->image}}" width="100px" height="100px" alt="">
                <input type="file" class="form-control" id="image" name="image" placeholder="Nhập tên đường dẫn" />
            </div>
            <div class="form-group">
                <label for="productCategory">Chọn danh mục cha</label>
                <select class="form-control" id="category" name="parent_id">
                    <option value="0">Chọn danh mục cha</option>
                    @foreach($categories as $subCategory)
                            <option value="{{ $subCategory['category_id'] }}" @if(old('parent_id', $category->parent_id) == $subCategory['category_id']) selected @endif>
                                {{ $subCategory['name'] }}
                            </option>
                    @endforeach
                </select>

            </div>


            <div class="button-container">
                <button type="submit" class="btn btn-primary">Sửa mới màu ăsc</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
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