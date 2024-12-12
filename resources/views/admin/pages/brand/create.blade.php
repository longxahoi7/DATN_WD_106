<form action="{{route('admin.brands.store')}}" method="POST" class="custom-form-container"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name" class="custom-label">Tên thương hiệu <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên thương hiệu" required />
    </div>

    <div class="form-group">
        <label for="slug" class="custom-label">Tên đường dẫn <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Nhập tên đường dẫn" required />
    </div>
    <div class="form-group">
        <label for="description" class="custom-label">Mô tả <span class="custom-required-star">*</span></label>
        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Nhập mô tả"
            required></textarea>
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
</form>