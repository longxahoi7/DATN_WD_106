@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongEdit.css')}}">
@endpush
@section('content')

<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Mới Nhân Viên</h1>
        <form action="{{route('admin.brands.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên nhân viên <span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhân viên"
                    required />
            </div>

            <div class="form-group">
                <label for="slug">Emali</label>
                <input type="email" class="form-control" id="slug" name="slug" placeholder="Nhập emai" />
            </div>
            <div class="form-group">
                <label for="slug">Số điện thoại</label>
                <input type="number" class="form-control" id="slug" name="slug" placeholder="Nhập số điện thoại" />
            </div>
            <div class="form-group">
                <label for="slug">Địa chỉ</label>
                <input type="number" class="form-control" id="slug" name="slug" placeholder="Nhập địa chỉ" />
            </div>
            <div class="form-group">
                <label for="image">Ảnh danh mục <span class="required">*</span></label>
                <input type="file" class="form-control" id="image" name="image" placeholder="Nhập tên thương hiệu"
                    required />
            </div>
            <div class="form-group">
                <label for="status">Giới tính</label><br>
                <label>
                    <input type="radio" name="gender" value="male">
                    Nam
                </label>

                <label>
                    <input type="radio" name="gender" value="female">
                    Nữ
                </label>

                <label>
                    <input type="radio" name="gender" value="other">
                    Khác
                </label>
            </div>
            <div class="form-group">
                <label for="status">Chọn vai trò</label>
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected>Chọn vai trò</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary">
                    Thêm mới nhân viên
                </button>
                <a href="{{route('admin.employees.index')}}" class="btn btn-secondary">Hủy</a>
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