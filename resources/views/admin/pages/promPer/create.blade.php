@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/huongCoupon.css')}}">
@endpush
@section('content')

<body>
    <form action="{{ route('admin.promotionPeriods.store') }}" method="POST">
        @csrf
        <div class="container">
            <!-- phiếu -->
            <div class="form-section">
                <h1>Phiếu Giảm Giá</h1>
                <div class="form-group">
                    <label for="tenMaGiamGia">Tên mã giảm giá:</label>
                    <input type="text" id="tenMaGiamGia" name="code" placeholder="Nhập tên mã giảm giá" />
                </div>
                <div class="form-group">
                    <label for="tenMaGiamGia">Gía trị giảm giá</label>
                    <select class="form-select" id="value" aria-label="Default select example">
                        <option selected>Chọn loại giảm giá</option>
                        <option value="1">Số tiền giảm giá</option>
                        <option value="2">Phần trăm giảm giá</option>

                    </select>
                </div>
                <div class="form-group" id="value1" style="display: none;">
                    <label for="discount">Gía trị</label>
                    <input type="number" id="discount" placeholder="Nhập điều kiện áp dụng" />
                </div>
                <div class="form-group">
                    <label for="start_date">Thời gian từ ngày:</label>
                    <input type="datetime-local" name="start_date" id="start_date" />
                </div>
                <div class="form-group">
                    <label for="end_date">Thời gian đến ngày:</label>
                    <input type="datetime-local" name="end_date"  id="end_date" />
                </div>
            </div>
            <!-- table -->
            <div class="customer-section">
                <h2>Danh sách sản phẩm</h2>
                <div class="search-group">
                    <i class="fas fa-search icon"></i>
                    <input type="text" placeholder="Tìm kiếm sản phẩm" />
                    <button>Tìm kiếm</button>
                </div>
                <table class="customer-list">
                    <thead>
                        <tr>
                            <th><input type="checkbox" /></th>
                            <th>Tên sản phẩm</th>
                        </tr>
                    </thead>
                    <tbody>
                   @foreach ($products as $product )
                   <tr>
                            <td class="checkbox">
                                <input type="checkbox" name="product_id[]" value="{{ $product->product_id }}" />
                            </td>
                            <td>{{ $product->name}}</td>
                           
                        </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        
        </div>
        <div class="add-button">
            <button type="submit">Thêm mới</button>
        </div>
        <!-- thêm -->
       
    </form>
</body>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
        value = document.getElementById('value');
        discount = document.getElementById('discount');

        value.addEventListener('change', function () {
            if (value.value == 1) {
                document.getElementById('value1').style.display = "block";
                discount.setAttribute('placeholder', 'Nhập số tiền giảm giá')
                discount.setAttribute('name', 'discount_amount')
            }
            else {
                document.getElementById('value1').style.display = "block";
                discount.setAttribute('placeholder', 'Nhập phần trăm giảm giá')
                discount.setAttribute('name', 'discount_percentage')
            }
        });
    </script>
@endpush
</body>
@endsection