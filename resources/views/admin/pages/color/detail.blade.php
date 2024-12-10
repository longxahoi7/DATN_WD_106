@extends('admin.index')

@section('content')
<div class="container">
    <h1 class="text-center">Chi Tiết màu sắc</h1>
    <div class="two">
        <div class="brand-info">
            <h3>
                Tên Thương Hiệu:
                <span id="name">{{$color->name}}</span>
            </h3>
            <p>
                <strong>Mã màu:</strong>
                <span id="description">{{$color->color_code}}</span>
            </p>

            <p>
                <strong>Ngày Tạo:</strong>
                <span id="created_at">{{ \Carbon\Carbon::parse($color->created_at)->format('d/m/Y H:i') }}</span>
            </p>
            <p>
                <strong>Ngày Cập Nhật:</strong>
                <span id="updated_at">{{ \Carbon\Carbon::parse($color->updated_at)->format('d/m/Y H:i') }}</span>
            </p>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route('admin.colors.index') }}" class="btn btn-success ">Quay lại danh sách màu sắc</a>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush
@endsection
