@extends('admin.index')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/huongDetail.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="text-center">Chi Tiết Danh mục</h1>
    <div class="two">
        <div class="brand-info">
        <p>
                <strong>Ảnh:</strong>
               <img src="{{$category->image}}"  width = "100px" height = "100px" alt="">
            </p>
            <h3>
                Tên Danh mục:
                <span id="name">{{$category->name}}</span>
            </h3>
            <p>
                <strong>Mô Tả:</strong>
                <span id="description">{{$category->description}}</span>
            </p>
            <p>
                <strong>Tên Đường Dẫn:</strong>
                <span id="slug">{{$category->slug}}</span>
            </p>
            <p>
                <strong>Ngày Tạo:</strong>
                <span id="created_at">{{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y H:i') }}</span>
            </p>
            <p>
                <strong>Ngày Cập Nhật:</strong>
                <span id="updated_at">{{ \Carbon\Carbon::parse($category->updated_at)->format('d/m/Y H:i') }}</span>
            </p>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-success">Quay lại danh sách thương hiệu</a>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush
@endsection
