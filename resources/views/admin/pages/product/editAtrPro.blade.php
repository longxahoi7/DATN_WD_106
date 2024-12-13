@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongListPro.css')}}">
    <style>
        /* Cải thiện bảng sản phẩm */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .product-table th,
        .product-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .product-table th {
            background-color: #f4f4f4;
        }

        .product-table tr:hover {
            background-color: #f9f9f9;
        }

        /* Cải thiện giao diện của ô input */
        input[type="number"],
        input[type="file"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }

        input[type="number"]:focus,
        input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Cải thiện giao diện của nút "Thêm mới" và "Lưu" */
        .btn.add-button,
        .btn.btn-primary {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
        }

        .btn.add-button:hover,
        .btn.btn-primary:hover {
            background-color: #0056b3;
        }

        /* Căn chỉnh ô input số và file trong bảng */
        .product-table td {
            vertical-align: middle;
            /* Đảm bảo các ô input cùng chiều dọc */
        }

        .product-table td input[type="number"] {
            width: 100%;
        }

        .product-table td input[type="file"] {
            width: auto;
            display: inline-block;
            float: right;
            /* Đẩy ô input file sang phải */
        }
    </style>
@endpush
@section('content')

<body>
    <div class="container">

        <h1 class="text-center">Danh Sách sản Phẩm</h1>
        @foreach($groupedByColor as $color => $items)
                <?php

            $colorString = (string) $color;
            $parts = explode('-', $colorString);
                                                    ?>
                <h3>Màu: {{ $parts[0] }}</h3>
                <table class="product-table">
                    <thead>
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
                                <td><input type="number" name="price[]" value="{{ number_format($item->price, 0, ',', '.')  }}VNĐ"></td>
                                <td><input type="number" name="in_stock[]" value="{{ $item->in_stock }}"></td>
                            </tr>

                        @endforeach


                    </tbody>
                </table>
                <div data-color-id="{{$parts[1]}}" class="form-group send-img">
                    <label for="url[]">Chọn ảnh cho màu {{ $parts[0] }}:</label>
                    <input type="file" name="url[]" id="url_{{ $parts[1] }}" multiple class="form-control-file">
                    <div id="imagePreviewContainer_{{ $parts[1] }}" style="display: flex; flex-wrap: wrap; margin-left: 20px;">
                        <!-- Các ảnh đã chọn sẽ hiển thị ở đây -->
                    </div>
                </div>
        @endforeach

        <div class="button-container">
            <button type="submit" id="submitForm" class="btn btn-primary">Cập nhật sản phẩm thuộc tính</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </div>


    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script>
            $(document).ready(function () {
                document.querySelectorAll('input[type="file"]').forEach(input => {
                    input.addEventListener('change', function (event) {
                        const files = event.target.files;
                        const colorId = event.target.id.split('_')[1]; // Lấy ID của thẻ input, ví dụ: "url_1", ta lấy phần sau dấu "_"
                        const previewContainer = document.getElementById('imagePreviewContainer_' + colorId);

                        // Xóa ảnh cũ trước khi hiển thị ảnh mới
                        previewContainer.innerHTML = '';

                        // Lặp qua từng file và hiển thị ảnh
                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const img = document.createElement('img');
                                img.src = e.target.result; // Đặt URL của ảnh
                                img.style.width = '100px'; // Cài đặt chiều rộng ảnh
                                img.style.height = '100px'; // Cài đặt chiều cao ảnh
                                img.style.marginRight = '10px'; // Khoảng cách giữa các ảnh
                                img.style.marginBottom = '10px'; // Khoảng cách dưới ảnh
                                previewContainer.appendChild(img); // Thêm ảnh vào container
                            };

                            reader.readAsDataURL(file); // Đọc ảnh thành Data URL
                        }
                    });
                });
                $('#submitForm').click(function () {
                    // Mảng 1 - Chứa dữ liệu từ các thẻ .send-img
                    var imagesData = [];
                    $('.send-img').each(function () {
                        var colorId = $(this).data('color-id');
                        var files = $(this).find('input[type="file"]')[0].files; // Lấy file input
                        var imgArray = [];

                        // Duyệt qua các file được chọn và lưu vào mảng imgArray
                        $.each(files, function (index, file) {
                            imgArray.push(file);
                        });

                        imagesData.push({
                            color_id: colorId,
                            images: imgArray
                        });
                    });

                    // Mảng 2 - Chứa dữ liệu từ các thẻ .data-attribute
                    var attributesData = [];
                    $('.data-attribute').each(function () {
                        var attributeProductId = $(this).data('attribute_product_id');
                        var prices = $(this).find('input[name="price[]"]').val();
                        var inStocks = $(this).find('input[name="in_stock[]"]').val();
                        attributesData.push({
                            attribute_product_id: attributeProductId,
                            prices: prices,
                            in_stock: inStocks
                        });
                    });
                    var formData = new FormData();
                    formData.append("img", JSON.stringify(imagesData));
                    formData.append("attributeProducts", JSON.stringify(attributesData));
                    formData.append("product_id", <?php echo $product_id?>);
                    imagesData.forEach(img => {
                        // Thêm color_id
                        formData.append('color_id[]', img.color_id);
                        // Thêm ảnh cho mỗi color_id (mảng ảnh)
                        img.images.forEach(image => {
                            formData.append(`images_${img.color_id}[]`, image); // 'images_1[]', 'images_2[]'
                        });
                    });
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                    const response = fetch("/admin/products/update-atrPro", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: formData
                    }).then(response => {

                        if (!response.ok) {
                            throw new Error('Lỗi khi gửi yêu cầu');
                        }
                        window.location.href="/admin/products/list-product"


                    })
                        .catch(error => {
                            alert('Sai')
                        });

                    // Dữ liệu có thể gửi qua AJAX hoặc xử lý theo yêu cầu
                });
            });


        </script>
    @endpush
</body>
@endsection