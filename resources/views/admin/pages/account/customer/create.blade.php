@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongEdit.css')}}">
@endpush
@section('content')

<body>
<div class="container">
      <form action="">
      <div class="header">
            <h1>Thêm Nhân Viên</h1>
        </div>
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" id="name" placeholder="Nhập tên" required />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Nhập email" required />
        </div>
        <div class="form-group">
            <label for="role">Vai trò</label>
            <input type="text" id="role" value="Nhân viên" class="fixed-role" readonly />
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select id="status" required>
                <option value="" disabled selected>Chọn trạng thái</option>
                <option value="Đang làm">Đang làm</option>
                <option value="Đã nghỉ">Đã nghỉ</option>
            </select>
        </div>
        <button class="submit-button" onclick="addEmployee()">Thêm</button>
        <button class="back-button" onclick="goBack()">Quay lại</button>
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