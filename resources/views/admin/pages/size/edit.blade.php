<form action="{{route('admin.sizes.store')}}" method="POST" class="custom-form-container" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name" class="custom-label">Tên kích thước <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{$size->name}}"
            placeholder="Nhập tên thương hiệu" required />
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>