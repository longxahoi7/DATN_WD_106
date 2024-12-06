@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')

<body>
<div class="container mt-5">
            <h1 class="text-center">Sửa màu sắc</h1>
            <form action="{{ route('admin.sizes.update', $size->size_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Tên thương hiệu <span class="required">*</span></label>
        <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            value="{{ $size->name }}"
            placeholder="Nhập tên thương hiệu"
            required
        />
    </div>

    <div class="button-container">
        <button type="submit" class="btn btn-primary">Sửa mới kích thước</button>
        <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">Hủy</a>
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