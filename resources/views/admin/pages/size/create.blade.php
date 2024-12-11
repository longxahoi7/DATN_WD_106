<form action="{{route('admin.sizes.store')}}" method="POST" class="custom-form-container" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name" class="custom-label">Tên kích thước <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên thương hiệu" required />
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
</form>