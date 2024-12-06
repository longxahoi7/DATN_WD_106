@extends('admin.index')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/huongDetail.css') }}">
@endpush

@section('content')
<div class="container">
            <h1 class="text-center">Danh sách chi tiết sản phẩm</h1>
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Kích cỡ</th>
                    <th>Màu</th>
                    <th>Gíai</th>
                    <th>Số lượng</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($attPros as $attPro )
                <tr>
                <td>{{$attPro->product->sku}}</td>
                    <td>{{$attPro->product->name}}</td>
                    <td>{{$attPro->size->name}}</td>
                    <td>{{$attPro->color->name}}</td>
                    <td>{{ number_format($attPro->price, 0, ',', '.') }} đ</td>   
                    <td>{{$attPro->in_stock}}</td>
                </tr>
               
                @endforeach
                    <!-- Có thể thêm nhiều hàng hơn ở đây -->
                </tbody>
            </table>
        <div class="button-group">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quay lại</a>
            </div>

        </div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush
@endsection
