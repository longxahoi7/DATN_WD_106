<form action="{{ route('admin.brands.update', $detailBrand->brand_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name" class="custom-label">Tên thương hiệu <span class="required">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $detailBrand->name }}"
            placeholder="Nhập tên thương hiệu" required />
    </div>

    <div class="form-group">
        <label for="slug" class="custom-label">Tên đường dẫn</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $detailBrand->slug }}"
            placeholder="Nhập tên đường dẫn" />
    </div>

    <div class="form-group">
        <label for="description" class="custom-label">Mô tả</label>
        <textarea class="form-control" id="description" name="description" rows="3"
            placeholder="Nhập mô tả">{{ $detailBrand->description }}</textarea>
    </div>

    <div class="button-container">
        <button type="submit" class="btn btn-primary">Sửa mới thương hiệu</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Hủy</a>
    </div>
</form>