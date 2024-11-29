<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <title>Quản lý Thương Hiệu</title>
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
        <h1 class="text-center">Quản lý thương hiệu</h1>
        <button class="btn add-button" data-toggle="modal" data-target="#addBrandModal">Thêm mới</button>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên Thương Hiệu</th>
                    <th>Mô Tả</th>
                    <th>Tên Đường Dẫn</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Thương hiệu A</td>
                    <td>Mô tả cho thương hiệu A</td>
                    <td>thuong-hieu-a</td>
                    <td class="action-icons">
                        <i class="fas fa-eye text-info" title="Chi tiết" data-toggle="modal"
                            data-target="#detailBrandModal"
                            onclick="loadDetailData('Thương hiệu A', 'Mô tả cho thương hiệu A', 'thuong-hieu-a', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-edit text-warning" title="Sửa" data-toggle="modal"
                            data-target="#editBrandModal"
                            onclick="loadEditData('Thương hiệu A', 'Mô tả cho thương hiệu A', 'thuong-hieu-a', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-trash text-danger" title="Xóa" data-toggle="modal"
                            data-target="#deleteBrandModal" onclick="setDeleteData('Thương hiệu A');"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Thêm Mới -->
        <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBrandModalLabel">Thêm mới thương hiệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="brandName">Tên thương hiệu *</label>
                                <input type="text" class="form-control" id="brandName"
                                    placeholder="Nhập tên thương hiệu" required />
                            </div>
                            <div class="form-group">
                                <label for="brandDescription">Mô tả</label>
                                <textarea class="form-control" id="brandDescription" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="brandSlug">Tên đường dẫn</label>
                                <input type="text" class="form-control" id="brandSlug"
                                    placeholder="Nhập tên đường dẫn" />
                            </div>
                            <div class="form-group">
                                <label for="createDate">Ngày tạo *</label>
                                <input type="date" class="form-control" id="createDate" required />
                            </div>
                            <div class="form-group">
                                <label for="updateDate">Ngày cập nhật *</label>
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

        <!-- Modal Sửa Thương Hiệu -->
        <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBrandModalLabel">Cập nhật thương hiệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="editBrandName">Tên thương hiệu *</label>
                                <input type="text" class="form-control" id="editBrandName"
                                    placeholder="Nhập tên thương hiệu" required />
                            </div>
                            <div class="form-group">
                                <label for="editBrandDescription">Mô tả</label>
                                <textarea class="form-control" id="editBrandDescription" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editBrandSlug">Tên đường dẫn</label>
                                <input type="text" class="form-control" id="editBrandSlug"
                                    placeholder="Nhập tên đường dẫn" />
                            </div>
                            <div class="form-group">
                                <label for="editCreateDate">Ngày tạo *</label>
                                <input type="date" class="form-control" id="editCreateDate" required />
                            </div>
                            <div class="form-group">
                                <label for="editUpdateDate">Ngày cập nhật *</label>
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

        <!-- Modal Xóa Thương Hiệu -->
        <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBrandModalLabel">Xóa thương hiệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa thương hiệu <span id="deleteBrandName"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete();">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Chi tiết Thương Hiệu -->
        <div class="modal fade" id="detailBrandModal" tabindex="-1" role="dialog"
            aria-labelledby="detailBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailBrandModalLabel">Chi tiết thương hiệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tên thương hiệu:</strong> <span id="detailBrandName"></span></p>
                        <p><strong>Mô tả:</strong> <span id="detailBrandDescription"></span></p>
                        <p><strong>Tên đường dẫn:</strong> <span id="detailBrandSlug"></span></p>
                        <p><strong>Ngày tạo:</strong> <span id="detailCreateDate"></span></p>
                        <p><strong>Ngày cập nhật:</strong> <span id="detailUpdateDate"></span></p>
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
        function loadEditData(name, description, slug, createdAt, updatedAt) {
            document.getElementById("editBrandName").value = name;
            document.getElementById("editBrandDescription").value = description;
            document.getElementById("editBrandSlug").value = slug;
            document.getElementById("editCreateDate").value = createdAt;
            document.getElementById("editUpdateDate").value = updatedAt;
        }

        function loadDetailData(name, description, slug, createdAt, updatedAt) {
            document.getElementById("detailBrandName").textContent = name;
            document.getElementById("detailBrandDescription").textContent = description;
            document.getElementById("detailBrandSlug").textContent = slug;
            document.getElementById("detailCreateDate").textContent = createdAt;
            document.getElementById("detailUpdateDate").textContent = updatedAt;
        }

        function setDeleteData(brandName) {
            document.getElementById("deleteBrandName").textContent = brandName;
        }

        function confirmDelete() {
            alert("Thương hiệu đã được xóa!");
            $("#deleteBrandModal").modal("hide");
        }
    </script>
</body>

</html>