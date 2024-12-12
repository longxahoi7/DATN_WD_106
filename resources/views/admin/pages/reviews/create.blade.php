@extends('admin.index')
@push('styles')
@endpush
@section('content')

<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Mới Thương Hiệu</h1>
        <form action="{{route('admin.brands.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên thương hiệu <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên thương hiệu"
                    required />
            </div>

            <div class="form-group">
                <label for="slug">Tên đường dẫn</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Nhập tên đường dẫn" />
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea class="form-control" id="description" rows="3" name="description"
                    placeholder="Nhập mô tả"></textarea>
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary">
                    Thêm mới thương hiệu
                </button>
                <a href="{{route('admin.brands.index')}}" class="btn btn-secondary">Hủy</a>
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
