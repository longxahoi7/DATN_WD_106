<body>
    <form action="{{ route('admin.coupons.update', $coupon->coupon_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <!-- phiếu -->
            <div class="form-section">
                <h1>Phiếu Giảm Giá</h1>
                <div class="form-group">
                    <label for="tenMaGiamGia">Tên mã giảm giá:</label>
                    <input type="text" id="tenMaGiamGia" name="code" value="{{$coupon->code}}"
                        placeholder="Nhập tên mã giảm giá" />
                </div>
                <div class="form-group">
                    <label for="tenMaGiamGia">Gía trị giảm giá</label>
                    <select class="form-select" id="value" aria-label="Default select example">
                        @if($coupon->discount_amount)
                        <option value="1" selected>Số tiền giảm giá</option>
                        <option value="2">Phần trăm giảm giá</option>
                        @elseif($coupon->discount_percentage)
                        <option value="2" selected>Phần trăm giảm giá</option>
                        <option value="1">Số tiền giảm giá</option>
                        @else
                        <option selected>Chọn loại giảm giá</option>
                        <option value="1">Số tiền giảm giá</option>
                        <option value="2">Phần trăm giảm giá</option>
                        @endif
                    </select>
                </div>
                <div class="form-group" id="value1">
                    <label for="discount">Gía trị</label>
                    @if($coupon->discount_amount)
                    <input type="number" value="{{$coupon->discount_amount}}" name="discount_amount" id="discount"
                        placeholder="Nhập điều kiện áp dụng" />
                    @elseif($coupon->discount_percentage)
                    <input type="number" value="{{$coupon->discount_percentage}}" name="discount_percentage"
                        id="discount" placeholder="Nhập điều kiện áp dụng" />
                    @else
                    <input type="number" id="discount" placeholder="Nhập điều kiện áp dụng" />
                    @endif
                </div>
                <div class="form-group">
                    <label for="condition">Gía trị tối thiểu</label>
                    <input type="number" id="condition" value="{{$coupon->min_order_value}}" name="min_order_value"
                        placeholder="Nhập điều kiện áp dụng" />
                </div>
                <div class="form-group">
                    <label for="max_order_value">Giá trị tối đa:</label>
                    <input type="number" id="max_order_value" value="{{$coupon->min_order_value}}"
                        name="max_order_value" placeholder="Nhập giá trị tối đa" />
                </div>
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" value="{{$coupon->quantity}}"
                        placeholder="Nhập số lượng" />
                </div>
                <div class="form-group">
                    <label for="start_date">Thời gian từ ngày:</label>
                    <input type="datetime-local" name="start_date" value="{{$coupon->created_at}}" id="start_date" />
                </div>
                <div class="form-group">
                    <label for="end_date">Thời gian đến ngày:</label>
                    <input type="datetime-local" name="end_date" value="{{$coupon->updated_at}}" id="end_date" />
                </div>
                <div class="form-group">
                    <label>Chọn kiểu</label>
                    @if($coupon->is_public)
                    <div class="form-check">
                        <input type="radio" name="is_public" id="public" value="1" class="form-check-input" checked>
                        <label for="public" class="form-check-label">Public</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="is_public" id="private" value="0" class="form-check-input">
                        <label for="private" class="form-check-label">Private</label>
                    </div>
                    @else
                    <div class="form-check">
                        <input type="radio" name="is_public" id="public" value="1" class="form-check-input">
                        <label for="public" class="form-check-label">Public</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="is_public" id="private" value="0" class="form-check-input" checked>
                        <label for="private" class="form-check-label">Private</label>
                    </div>

                    @endif
                </div>
            </div>
            <!-- table -->
            <div class="customer-section">
                <h2>Danh sách khách hàng</h2>
                <div class="search-group">
                    <i class="fas fa-search icon"></i>
                    <input type="text" placeholder="Tìm kiếm khách hàng" />
                    <button>Tìm kiếm</button>
                </div>
                <table class="customer-list">
                    <thead>
                        <tr>
                            <th><input type="checkbox" /></th>
                            <th>Tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            @if($userCoupon->contains('user_id', $user->user_id))
                            <td class="checkbox">
                                <input type="checkbox" checked name="user_id[]" value="{{ $user->user_id }}" />
                            </td>
                            @else
                            <td class="checkbox">
                                <input type="checkbox" name="user_id[]" value="{{ $user->user_id }}" />
                            </td>
                            @endif
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
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

value.addEventListener('change', function() {
    if (value.value == 1) {

        discount.setAttribute('placeholder', 'Nhập số tiền giảm giá')
        discount.setAttribute('name', 'discount_amount')
        discount.setAttribute('value', '')
    } else {

        discount.setAttribute('placeholder', 'Nhập phần trăm giảm giá')
        discount.setAttribute('name', 'discount_percentage')
        discount.setAttribute('value', '')
    }
});
</script>
@endpush
</body>
@endsection