@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')

<body>
    <div class="container">
        <h1 class="text-center">Quản lý danh mục</h1>
        <button class="btn add-button" data-toggle="modal" data-target="#addCategoryModal">
            Thêm mới
        </button>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>STT</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô Tả</th>
                    <th>Hình Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Danh mục A</td>
                    <td>Mô tả cho danh mục A</td>
                    <td>
                        <img src="https://via.placeholder.com/50" alt="Image" />
                    </td>
                    <td class="action-icons">
                        <i class="fas fa-eye text-info" title="Chi tiết" data-toggle="modal"
                            data-target="#detailCategoryModal"
                            onclick="loadDetailData('Danh mục A', 'Mô tả cho danh mục A', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-edit text-warning" title="Sửa" data-toggle="modal"
                            data-target="#editCategoryModal"
                            onclick="loadEditData('Danh mục A', 'Mô tả cho danh mục A', '2', '2024-01-01', '2024-01-02');"></i>
                        <i class="fas fa-trash text-danger" title="Xóa" data-toggle="modal"
                            data-target="#deleteCategoryModal" onclick="setDeleteData('Danh mục A');"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Thêm Mới -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">
                            Thêm mới danh mục
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Tên danh mục *</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="slug">Tên đường dẫn sản phẩm</label>
                                <input type="text" class="form-control" id="slug" placeholder="Nhập đường dẫn" />
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Danh mục thuộc</label>
                                <select class="form-control" id="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    <option value="1">Danh mục A</option>
                                    <option value="2">Danh mục B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Hoạt động</label>
                                <select class="form-control" id="status">
                                    <option value="active">
                                        Hoạt động
                                    </option>
                                    <option value="inactive">
                                        Ngừng hoạt động
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="main_image_url">Hình ảnh</label>
                                <input type="file" class="form-control-file" id="main_image_url" />
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

        <!-- Modal Sửa Danh Mục -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">
                            Cập nhật danh mục
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="editCategoryName">Tên danh mục *</label>
                                <input type="text" class="form-control" id="editCategoryName"
                                    placeholder="Nhập tên danh mục" required />
                            </div>
                            <div class="form-group">
                                <label for="editDescription">Mô tả</label>
                                <textarea class="form-control" id="editDescription" rows="3"
                                    placeholder="Nhập mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editProductLink">Tên đường dẫn sản phẩm</label>
                                <input type="text" class="form-control" id="editProductLink"
                                    placeholder="Nhập đường dẫn" />
                            </div>
                            <div class="form-group">
                                <label for="editParentCategory">Danh mục thuộc *</label>
                                <select class="form-control" id="editParentCategory" required>
                                    <option value="">Chọn danh mục</option>
                                    <option value="1">Danh mục A</option>
                                    <option value="2">Danh mục B</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editStatus">Hoạt động</label>
                                <select class="form-control" id="editStatus">
                                    <option value="active">
                                        Hoạt động
                                    </option>
                                    <option value="inactive">
                                        Ngừng hoạt động
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editImage">Hình ảnh</label>
                                <input type="file" class="form-control-file" id="editImage" />
                            </div>
                            <div class="form-group">
                                <label for="editCreateProduct">Ngày tạo sản phẩm *</label>
                                <input type="date" class="form-control" id="editCreateProduct" required />
                            </div>
                            <div class="form-group">
                                <label for="editUpdateProduct">Ngày cập nhật sản phẩm *</label>
                                <input type="date" class="form-control" id="editUpdateProduct" required />
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

        <!-- Modal Xóa Danh Mục -->
        <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel">
                            Xóa danh mục
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Bạn có chắc chắn muốn xóa danh mục
                            <span id="deleteCategoryName"></span>?
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

        <!-- Modal Chi tiết Danh Mục -->
        <div class="modal fade" id="detailCategoryModal" tabindex="-1" role="dialog"
            aria-labelledby="detailCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailCategoryModalLabel">
                            Chi tiết danh mục
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Tên danh mục:</strong>
                            <span id="detailCategoryName"></span>
                        </p>
                        <p>
                            <strong>Mô tả:</strong>
                            <span id="detailCategoryDescription"></span>
                        </p>
                        <p>
                            <strong>Ngày tạo:</strong>
                            <span id="detailCategoryCreated"></span>
                        </p>
                        <p>
                            <strong>Ngày cập nhật:</strong>
                            <span id="detailCategoryUpdated"></span>
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
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script>
            function loadEditData(
                name,
                description,
                parentId,
                created_at,
                updated_at
            ) {
                document.getElementById("editCategoryName").value = name;
                document.getElementById("editDescription").value = description;
                document.getElementById("editParentCategory").value = parentId;
                document.getElementById("editCreateProduct").value = created_at;
                document.getElementById("editUpdateProduct").value = updated_at;
            }

            function loadDetailData(name, description, created_at, updated_at) {
                document.getElementById("detailCategoryName").textContent =
                    name;
                document.getElementById(
                    "detailCategoryDescription"
                ).textContent = description;
                document.getElementById("detailCategoryCreated").textContent =
                    created_at;
                document.getElementById("detailCategoryUpdated").textContent =
                    updated_at;
            }

            function setDeleteData(categoryName) {
                document.getElementById("deleteCategoryName").textContent =
                    categoryName;
            }

            function confirmDelete() {
                alert("Danh mục đã được xóa!");
                $("#deleteCategoryModal").modal("hide");
            }
        </script>
    @endpush
</body>
@endsection