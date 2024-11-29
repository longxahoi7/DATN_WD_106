<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Quản lý kích thước</title>
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
        <h1 class="text-center">Quản lý kích thước</h1>
        <button class="btn add-button" data-toggle="modal" data-target="#addSizeModal">Thêm mới</button>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên Kích Thước</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>M</td>
                    <td class="action-icons">
                        <i class="fas fa-eye text-info" title="Chi tiết" data-toggle="modal"
                            data-target="#detailSizeModal"
                            onclick="loadDetailData('Nhỏ', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-edit text-warning" title="Sửa" data-toggle="modal" data-target="#editSizeModal"
                            onclick="loadEditData('Nhỏ', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-trash text-danger" title="Xóa" data-toggle="modal"
                            data-target="#deleteSizeModal" onclick="setDeleteData('Nhỏ');"></i>
                    </td>
                </tr>
                <!-- Thêm các hàng khác nếu cần -->
            </tbody>
        </table>

        <!-- Modal Thêm Mới -->
        <div class="modal fade" id="addSizeModal" tabindex="-1" role="dialog" aria-labelledby="addSizeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSizeModalLabel">Thêm mới kích thước</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="sizeName">Tên kích thước</label>
                                <input type="text" class="form-control" id="sizeName" placeholder="Nhập tên kích thước"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="createDate">Ngày tạo</label>
                                <input type="date" class="form-control" id="createDate" required />
                            </div>
                            <div class="form-group">
                                <label for="updateDate">Ngày cập nhật</label>
                                <input type="date" class="form-control" id="updateDate" required />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Sửa Kích Thước -->
        <div class="modal fade" id="editSizeModal" tabindex="-1" role="dialog" aria-labelledby="editSizeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSizeModalLabel">Cập nhật kích thước</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="editSizeName">Size</label>
                                <input type="text" class="form-control" id="editSizeName"
                                    placeholder="Nhập tên kích thước" required />
                            </div>
                            <div class="form-group">
                                <label for="editCreateDate">Ngày tạo</label>
                                <input type="date" class="form-control" id="editCreateDate" required />
                            </div>
                            <div class="form-group">
                                <label for="editUpdateDate">Ngày cập nhật</label>
                                <input type="date" class="form-control" id="editUpdateDate" required />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Xóa Kích Thước -->
        <div class="modal fade" id="deleteSizeModal" tabindex="-1" role="dialog" aria-labelledby="deleteSizeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSizeModalLabel">Xóa kích thước</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa size <span id="deleteSizeName"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Chi tiết Kích Thước -->
        <div class="modal fade" id="detailSizeModal" tabindex="-1" role="dialog" aria-labelledby="detailSizeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailSizeModalLabel">Chi tiết kích thước</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Size:</strong> <span id="detailSizeName"></span></p>
                        <p><strong>Ngày tạo:</strong> <span id="detailSizeCreated"></span></p>
                        <p><strong>Ngày cập nhật:</strong> <span id="detailSizeUpdated"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        function loadEditData(name, createdAt, updatedAt) {
            document.getElementById("editSizeName").value = name;
            document.getElementById("editCreateDate").value = createdAt;
            document.getElementById("editUpdateDate").value = updatedAt;
        }

        function loadDetailData(name, createdAt, updatedAt) {
            document.getElementById("detailSizeName").textContent = name;
            document.getElementById("detailSizeCreated").textContent = createdAt;
            document.getElementById("detailSizeUpdated").textContent = updatedAt;
        }

        function setDeleteData(sizeName) {
            document.getElementById("deleteSizeName").textContent = sizeName;
        }

        function confirmDelete() {
            alert("Kích thước đã được xóa!");
            $("#deleteSizeModal").modal("hide");
        }
    </script>
</body>

</html>