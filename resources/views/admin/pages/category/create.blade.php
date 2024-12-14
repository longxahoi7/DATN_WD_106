<link rel="stylesheet" href="{{asset('css/admin/formAddCategory.css')}}">
<form action="{{route('admin.categories.store')}}" method="POST" class="custom-form-container"
    enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <div class="d-flex align-items-center">
            <!-- Image Preview Area -->
            <div class="img-container mr-3">
                <img src="#" alt="Ảnh danh mục" id="imagePreview" />
                <span id="noImageText">Ảnh danh mục</span>
            </div>
            <!-- Upload Button -->
            <button type="button" class="custom-btn-upload-admin" onclick="document.getElementById('image').click();">
                <i class="bi bi-upload"></i> <span class="ml-2"> Tải lên</span>
            </button>
            <input type="file" class="form-control-file d-none" id="image" name="image" accept="image/*"
                onchange="showImage(event)" />
        </div>
    </div>
    <div class="form-group">
        <label class="custom-label" for="name">Tên danh mục <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required />
    </div>

    <div class="form-group">
        <label class="custom-label" for="slug">Tên đường dẫn <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Nhập tên đường dẫn" required />
    </div>
    <div class="form-group">
        <label class="custom-label" for="productCategory">Danh mục chính</label>
        <select class="form-control" id="productCategory" name="parent_id" required>
            <option value="0">Chọn danh mục chính </option>
            @foreach($categories as $category)
            <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="custom-label" for="description">Mô tả<span class="custom-required-star">*</span></label>
        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Nhập mô tả"
            required></textarea>
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
</form>

<script>
function showImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("imagePreview");
    const noImageText = document.getElementById("noImageText");

    if (file) {
        const reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
            preview.classList.add("show");
            noImageText.style.display = "none";
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = "#";
        preview.classList.remove("show");
        noImageText.style.display = "block";
    }
}
</script>