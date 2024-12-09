@extends('admin.index')
@section('content')

<body>
    <div class="container mt-5">
        <h1 class="text-center">Sửa màu sắc</h1>
        <form action="{{ route('admin.colors.update', $color->color_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên thương hiệu <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $color->name }}"
                    placeholder="Nhập tên thương hiệu" required />
            </div>

            <div class="form-group">
                <label for="slug">Mã màu</label>
                <input type="color" class="form-control" id="color_code" name="color_code"
                    value="{{ $color->color_code }}" placeholder="Nhập tên đường dẫn" />
            </div>



            <div class="button-container">
                <button type="submit" class="btn btn-primary">Sửa mới mã màu</button>
                <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Hủy</a>
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
