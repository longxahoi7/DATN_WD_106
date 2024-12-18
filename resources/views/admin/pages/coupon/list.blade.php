@extends('admin.index')
@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
@section('content')


<body>
    <div class="container">
        <div class="button-header">
            <button>Danh Sách phiếu giảm giá <i class="fa fa-star"></i></button>
        </div>
        <a href="{{route('admin.coupons.create')}}"><button class="btn add-button">Thêm mới</button></a>

        <table class="product-table table table-bordered text-center align-middle mb-5">
            <thead class="thead-dark">
                <tr>
                    <th>STT</th>
                    <th>Tên </th>
                    <th>Loại</th>
                    <!-- <th>Số lượng</th> -->
                    <!-- <th>Giá tối thiểu</th>
                    <th>Giá tối đa</th> -->
                    <th>Ngày bắt đầu </th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($coupons as $key => $coupon)
                <tr>
                    <td>{{$coupon->coupon_id}}</td>
                    <td>{{$coupon->code}}</td>
                    @if($coupon->discount_amount)
                    <td>{{ number_format($coupon->discount_amount, 0, ',', '.') }}</td>
                    @else
                    <td>{{$coupon->discount_percentage	}}%</td>
                    @endif
                    <!-- <td>{{$coupon->quantity}}</td> -->
                    <!-- <td>{{ number_format($coupon->min_order_value, 0, ',', '.') }}</td>
                    <td>{{ number_format($coupon->max_order_value, 0, ',', '.') }}</td> -->
                    <td>{{ \Carbon\Carbon::parse($coupon->start_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($coupon->end_date)->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.coupons.toggle', $coupon->coupon_id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                class="custom-btn-active-admin {{ $coupon->is_active ? 'btn-danger' : 'btn-success' }}">
                                <p>{{ $coupon->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}</p>
                            </button>
                        </form>
                    </td>
                    <td class="action-icons">
                        <div class="icon-product d-flex justify-content-center gap-2">
                            <!-- xem chi tiết -->
                            <!-- <a href="{{route('admin.coupons.detail',$coupon->coupon_id)}}" class="action-btn eye">
                                <i class="fas fa-eye"></i>
                            </a> -->
                            <!-- Chỉnh sửa -->
                            <a href="{{route('admin.coupons.edit',$coupon->coupon_id)}}" class="action-btn edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Form xóa -->
                            <form action="{{ route('admin.coupons.delete', $coupon->coupon_id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa màu sắc này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @endforeach


            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
    </script>
    @endpush
</body>
@endsection