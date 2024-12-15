<link rel="stylesheet" href="{{asset('css/admin/formAddProduct.css')}}">
<form id="productForm" method="POST" action="{{ route('admin.products.store') }}" class="custom-form-container"
    enctype="multipart/form-data">
    @csrf
    <!-- Image -->
    <div class="row gx-2 mb-3">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <!-- Image Preview Area -->
                <div class="img-container me-3">
                    <img src="#" alt="Preview" id="imagePreview" />
                    <span id="noImageText">Ảnh sản phẩm</span>
                </div>
                <!-- Upload Button -->
                <button type="button" class="custom-btn-upload-admin"
                    onclick="document.getElementById('productImage').click();">
                    <i class="bi bi-upload"></i> <span class="ms-2">Tải lên</span>
                </button>
                <input type="file" class="form-control-file d-none" id="productImage" name="main_image_url"
                    accept="image/*" onchange="showImage(event)" />
            </div>
        </div>
    </div>

    <!-- First Row -->
    <div class="row gx-2 mb-3">
        <div class="col-md-6">
            <label class="custom-label" for="productName">Tên sản phẩm</label>
            <input type="text" class="form-control" id="productName" name="name" placeholder="Nhập tên sản phẩm"
                required maxlength="50" />
        </div>
        <div class="col-md-6">
            <label class="custom-label" for="productSKU">Mã sản phẩm</label>
            <input type="text" class="form-control" id="productSKU" name="sku" placeholder="Nhập mã sản phẩm" required
                maxlength="50" />
        </div>
    </div>

    <div class="row gx-2 mb-3">
        <div class="col-12">
            <label for="productSubtitle">Chú thích sản phẩm</label>
            <input type="text" class="form-control" id="productSubtitle" name="subtitle"
                placeholder="Nhập Chú thích sản phẩm" required maxlength="50" />
        </div>
    </div>

    <!-- Second Row -->
    <div class="row gx-2 mb-3">
        <div class="col-md-6">
            <label class="custom-label" for="productCategory">Danh mục sản phẩm</label>
            <select class="form-control" id="productCategory" name="product_category_id" required>
                <option value="0">Chọn danh mục sản phẩm</option>
                @foreach($categories as $category)
                <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="custom-label" for="productBrand">Thương hiệu sản phẩm</label>
            <select class="form-control" id="productBrand" name="brand_id" required>
                <option value="">Chọn thương hiệu sản phẩm</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Third Row -->
    <div class="row gx-2 mb-3">
        <!-- Dropdown Kích thước sản phẩm -->
        <div class="col-6">
            <label class="custom-label">Kích thước sản phẩm</label>
            <div class="checkbox-group size-group">
                <input type="checkbox" id="selectAllSizes" onclick="toggleAll('size')">
                <label for="selectAllSizes">Chọn tất cả</label>
                <hr />
                @foreach($sizes as $size)
                <div>
                    <input type="checkbox" id="size{{ $size->id }}" name="size_id[]" value="{{ $size->size_id }}">
                    <label for="size{{ $size->id }}">{{ $size->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Dropdown Màu sắc sản phẩm -->
        <div class="col-6">
            <label class="custom-label">Màu sắc sản phẩm</label>
            <div class="checkbox-group color-group">
                <input type="checkbox" id="selectAllColors" onclick="toggleAll('color')">
                <label for="selectAllColors">Chọn tất cả</label>
                <hr />
                @foreach($colors as $color)
                <div>
                    <input type="checkbox" id="color{{ $color->color_id }}" name="color_id[]"
                        value="{{ $color->color_id }}">
                    <label for="color{{ $color->color_id }}">{{ $color->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Fifth Row -->
    <div class="row gx-2 mb-3">
        <div class="col-12">
            <label class="custom-label" for="productDescription">Mô tả sản phẩm</label>
            <textarea class="form-control" id="productDescription" name="description" placeholder="Nhập mô tả sản phẩm"
                rows="5" required maxlength="255" required></textarea>
        </div>
    </div>

    <!-- Buttons -->
    <div class="button-group">
        <button type="submit" class="btn btn-primary">Tiếp tục</button>
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

function toggleAll(type) {
    console.log("Toggled type:", type);

    let idToFind;
    if (type === 'size') {
        idToFind = 'selectAllSizes';
    } else if (type === 'color') {
        idToFind = 'selectAllColors';
    }

    console.log("Trying to find id:", idToFind);

    const selectAllCheckbox = document.getElementById(idToFind);

    if (!selectAllCheckbox) {
        console.log("Không tìm thấy checkbox 'select all'. Kiểm tra id.");
        return;
    }

    const checkboxes = document.querySelectorAll(`.${type}-group input[type="checkbox"]:not(#${idToFind})`);
    console.log("Checkboxes found:", checkboxes);

    const isChecked = selectAllCheckbox.checked;

    checkboxes.forEach(checkbox => {
        checkbox.checked = isChecked;
    });
    console.log(document.getElementById(idToFind));

}
</script>