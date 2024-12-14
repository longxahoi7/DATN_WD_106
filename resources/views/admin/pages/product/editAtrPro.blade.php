@extends('admin.index')
@push('styles')
<link rel="stylesheet" href="{{asset('css/admin/editAtrpro.css')}}">
@endpush
@section('content')

<body>
    <div class="container">
        <div class="button-header">
            <button>
                Điều chỉnh thông tin sản phẩm <i class="fa fa-star"></i>
            </button>
        </div>
        <div class="containerEditAtrpro">
            @foreach($groupedByColor as $color => $items)
            <?php
            $colorString = (string) $color;
            $parts = explode('-', $colorString);
                                                    ?>
            <table class="product-table table table-bordered text-center align-middle mb-4">
                <thead class="thead-dark">
                    <tr>
                        <td colspan="4" class="text-left color-header-custom">
                            <p class="text-custom">Sản phẩm màu: {{ $parts[0] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Gía </th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    @foreach($items as $item)
                    <tr class="col-4 data-attribute" data-attribute_product_id="{{ $item->attribute_product_id }}">
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->size->name }}</td>
                        <td><input type="number" name="price[]" class="form-control"
                                value="{{ number_format($item->price, 0, ',', '.') }}" required></td>
                        <td><input type="number" name="in_stock[]" class="form-control" value="{{ $item->in_stock }}"
                                required>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-center">
                            @CSRF
                            <label for="url_{{ $parts[1] }}" class="btn custom-upload-btn-atriPro">
                                <i class="fa fa-upload"></i> Tải lên
                            </label>
                            <input type="file" name="url[]" id="url_{{ $parts[1] }}" class="d-none" multiple>
                            <div id="imagePreviewContainer_{{ $parts[1] }}" class="mt-3 d-flex flex-wrap">
                                <!-- Ảnh sẽ hiển thị ở đây -->
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endforeach
            <div class="button-group">
                <button type="submit" id="submitForm" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </div>


    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
    let imagesData = [];

    $(document).ready(function() {
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function(event) {
                const files = event.target.files;
                const colorId = event.target.id.split('_')[1];
                const previewContainer = document.getElementById('imagePreviewContainer_' +
                    colorId);

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('position-relative', 'm-2');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '130px';
                        img.style.borderRadius = '5px';

                        const removeIcon = document.createElement('i');
                        removeIcon.classList.add('fa', 'fa-times-circle',
                            'position-absolute', 'text-danger');
                        removeIcon.style.top = '5px';
                        removeIcon.style.right = '5px';
                        removeIcon.style.cursor = 'pointer';

                        removeIcon.addEventListener('click', function() {
                            imgContainer.remove();
                            const updatedImagesData = imagesData.find(img => img
                                .color_id == colorId);
                            if (updatedImagesData) {
                                updatedImagesData.images = Array.from(
                                        previewContainer.querySelectorAll('img'))
                                    .map(img => img.src);
                            }
                        });

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeIcon);
                        previewContainer.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            });
        });

        $('#submitForm').click(function() {
            imagesData = [];

            $('.send-img').each(function() {
                const colorId = $(this).data('color-id');
                const files = $(this).find('input[type="file"]')[0].files;
                const imgArray = Array.from(files);

                imagesData.push({
                    color_id: colorId,
                    images: imgArray
                });
            });

            const attributesData = [];
            $('.data-attribute').each(function() {
                const attributeProductId = $(this).data('attribute_product_id');
                const prices = $(this).find('input[name="price[]"]').val();
                const inStocks = $(this).find('input[name="in_stock[]"]').val();
                attributesData.push({
                    attribute_product_id: attributeProductId,
                    prices: prices,
                    in_stock: inStocks
                });
            });

            const formData = new FormData();
            formData.append("img", JSON.stringify(imagesData));
            formData.append("attributeProducts", JSON.stringify(attributesData));
            formData.append("product_id", <?php echo $product_id?>);

            imagesData.forEach(img => {
                formData.append('color_id[]', img.color_id);
                img.images.forEach(image => {
                    formData.append(`images_${img.color_id}[]`, image);
                });
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            fetch("/admin/products/update-atrPro", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Lỗi khi gửi yêu cầu');
                    }
                    window.location.href = "/admin/products/list-product";
                })
                .catch(error => {
                    alert('Sai');
                });
        });
    });
    </script>
    @endpush
</body>
@endsection