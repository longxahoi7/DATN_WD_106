@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongAcount.css')}}">
@endpush
@section('content')

<body>

    <body>
    <div class="container">
            <div class="header">
                <h1>Quản Lý Nhân Viên</h1>
            </div>
            <div class="button-container">
              <a href="{{route('admin.employees.create')}}">  <button class="add-button">Thêm Nhân Viên</button></a>
            </div>
          <form action="">
          <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nguyễn Văn A</td>
                        <td>nguyenvana@example.com</td>
                        <td>Nhân viên</td>
                        <td>Đang làm việc</td>
                        <td>
                            <div class="action-icons">
                                <i
                                    class="fas fa-edit edit-icon"
                                    title="Sửa"
                                ></i>
                                <i
                                    class="fas fa-trash delete-icon"
                                    title="Xóa"
                                    onclick="openModal()"
                                ></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Trần Thị B</td>
                        <td>tranthib@example.com</td>
                        <td>Nhân viên</td>
                        <td>Đã nghỉ</td>
                        <td>
<div class="action-icons">
                                <i
                                    class="fas fa-edit edit-icon"
                                    title="Sửa"
                                ></i>
                                <i
                                    class="fas fa-trash delete-icon"
                                    title="Xóa"
                                    onclick="openModal()"
                                ></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phạm Văn C</td>
                        <td>phamvanc@example.com</td>
                        <td>Nhân viên</td>
                        <td>Đang làm việc</td>
                        <td>
                            <div class="action-icons">
                                <i
                                    class="fas fa-edit edit-icon"
                                    title="Sửa"
                                ></i>
                                <i
                                    class="fas fa-trash delete-icon"
                                    title="Xóa"
                                    onclick="openModal()"
                                ></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
          </form>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Xác nhận</h2>
                <p>Bạn có chắc chắn muốn xóa nhân viên này?</p>
                <div class="modal-buttons">
                    <button class="cancel-button" onclick="closeModal()">
                        Hủy
                    </button>
                    <button class="delete-button">Xóa</button>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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