<link rel="stylesheet" href="{{asset('css/admin/formAddCategory.css')}}">
<form action="{{ route('admin.categories.update', $category->category_id) }}" method="POST"
    class="custom-form-container" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name" class="custom-label">Tên danh mục <span class="custom-required-star">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
            placeholder="Nhập tên thương hiệu" required />
    </div>
    <div class="form-group">
        <label for="description" class="custom-label">Mô tả <span class="custom-required-star">*</span></label>
        <textarea class="form-control" id="description" name="description" rows="3"
            placeholder="Nhập mô tả">{{ $category->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="productCategory" class="custom-label">Chọn danh mục cha</label>
        <select class="form-control" id="category" name="parent_id">
            <option value="0">Chọn danh mục cha</option>
            @foreach($categories as $subCategory)
            <option value="{{ $subCategory['category_id'] }}" @if(old('parent_id', $category->parent_id) ==
                $subCategory['category_id']) selected @endif>
                {{ $subCategory['name'] }}
            </option>
            @endforeach
        </select>

    </div>

    <div class="form-group">
        <div class="d-flex align-items-center">
            <!-- Image Preview Area -->
            <div class="img-container mr-3">
                <img src="{{ asset('storage/' . $category->image) }}" alt="Ảnh danh mục" id="imagePreview" />
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

    <div class="button-group">
        <button type="submit" class="btn btn-primary">Lưu</button>
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
    }
}
</script>