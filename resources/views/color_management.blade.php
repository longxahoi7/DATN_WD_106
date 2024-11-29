<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Quản lý danh mục</title>
    <style>
        body {
            margin: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .add-button {
            margin-bottom: 20px;
            float: right;
            background-color: #28a745;
            color: white;
        }

        .action-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .modal-header .close {
            margin: 0;
        }

        .modal-body input,
        .modal-body textarea {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Quản lý màu</h1>
        <button class="btn add-button" data-toggle="modal" data-target="#addColorModal">
            Thêm mới
        </button>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên Màu</th>
                    <th>Mã Màu</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Trắng</td>
                    <td>#ffff</td>
                    <td class="action-icons">
                        <i class="fas fa-eye text-info" title="Chi tiết" data-toggle="modal"
                            data-target="#detailColorModal"
                            onclick="loadDetailData('Trắng', '#ffff', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-edit text-warning" title="Sửa" data-toggle="modal"
                            data-target="#editColorModal"
                            onclick="loadEditData('Trắng', '#ffff', '2', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-trash text-danger" title="Xóa" data-toggle="modal"
                            data-target="#deleteColorModal" onclick="setDeleteData('Trắng');"></i>
                    </td>
                </tr>
                <!-- Thêm các hàng khác nếu cần -->
            </tbody>
        </table>

        <!-- Modal Thêm Mới -->
        <div class="modal fade" id="addColorModal" tabindex="-1" role="dialog" aria-labelledby="addColorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addColorModalLabel">
                            Thêm mới màu
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Tên màu</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên màu" required />
                            </div>
                            <div class="form-group">
                                <label for="color_code">Mã màu</label>
                                <textarea class="form-control" id="color_code" rows="3"
                                    placeholder="Nhập mã màu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="createProduct">Ngày tạo sản phẩm *</label>
                                <input type="date" class="form-control" id="createProduct" required />
                            </div>
                            <div class="form-group">
                                <label for="updateProduct">Ngày cập nhật sản phẩm *</label>
                                <input type="date" class="form-control" id="updateProduct" required />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Hủy
                        </button>
                        <button type="button" class="btn btn-primary">
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Sửa màu -->
        <div class="modal fade" id="editColorModal" tabindex="-1" role="dialog" aria-labelledby="editColorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editColorModalLabel">
                            Cập nhật màu
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Tên màu</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên màu" required />
                            </div>
                            <div class="form-group">
                                <label for="ediColorcode">Mã màu</label>
                                <textarea class="form-control" id="ediColorcode" rows="3"
                                    placeholder="Nhập mã màu"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="createProduct">Ngày tạo sản phẩm *</label>
                                <input type="date" class="form-control" id="createProduct" required />
                            </div>
                            <div class="form-group">
                                <label for="updateProduct">Ngày cập nhật sản phẩm *</label>
                                <input type="date" class="form-control" id="updateProduct" required />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Hủy
                        </button>
                        <button type="button" class="btn btn-primary">
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Xóa màu -->
        <div class="modal fade" id="deleteColorModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteColorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteColorModalLabel">
                            Xóa màu
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Bạn có chắc chắn muốn xóa màu
                            <span id="deleteColorName"></span>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Hủy
                        </button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete();">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Chi tiết màu -->
        <div class="modal fade" id="detailColorModal" tabindex="-1" role="dialog"
            aria-labelledby="detailColorModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailColorModalLabel">
                            Chi tiết màu
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Tên màu:</strong>
                            <span id="detailColorName"></span>
                        </p>
                        <p>
                            <strong>Mã màu:</strong>
                            <span id="detailColorCode"></span>
                        </p>
                        <p>
                            <strong>Ngày tạo:</strong>
                            <span id="detailColorCreated"></span>
                        </p>
                        <p>
                            <strong>Ngày cập nhật:</strong>
                            <span id="detailColorUpdated"></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#">«</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">»</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        function loadEditData(
            name,
            color_code,
            parentId,
            created_at,
            updated_at
        ) {
            document.getElementById("name").value = name;
            document.getElementById("ediColorcode").value = color_code;
            document.getElementById("createProduct").value = created_at;
            document.getElementById("updateProduct").value = updated_at;
        }

        function loadDetailData(name, color_code, created_at, updated_at) {
            document.getElementById("detailColorName").textContent = name;
            document.getElementById("detailColorCode").textContent =
                color_code;
            document.getElementById("detailColorCreated").textContent =
                created_at;
            document.getElementById("detailColorUpdated").textContent =
                updated_at;
        }

        function setDeleteData(colorName) {
            document.getElementById("deleteColorName").textContent =
                colorName;
        }

        function confirmDelete() {
            alert("Màu đã được xóa!");
            $("#deleteColorModal").modal("hide");
        }
    </script>
</body>

</html>