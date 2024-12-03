@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">>
@endpush
@section('content')

<body>
    <div class="container1 mt-4">
        <div class="form-row mb-4">
            <div class="col">
                <input type="date" class="form-control" placeholder="Từ ngày" />
            </div>
            <div class="col-auto">
                <span>-</span>
            </div>
            <div class="col">
                <input type="date" class="form-control" placeholder="Đến ngày" />
            </div>
        </div>
        <button class="btn btn-success mb-4">CHỌN LẠI</button>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tình trạng</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày mua hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>36</td>
                    <td>
                        <i class="fas fa-check-circle text-success"></i> Đã
                        giao hàng
                    </td>
                    <td>chiuroi</td>
                    <td>977.000 đ</td>
                    <td>2024-11-24 13:55:58</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                <tr>
                    <td>35</td>
                    <td>
                        <i class="fas fa-hourglass-half text-warning"></i>
                        Chờ xác nhận
                    </td>
                    <td>chiuroi</td>
                    <td>977.000 đ</td>
                    <td>2024-11-24 13:53:13</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                <tr>
                    <td>34</td>
                    <td>
                        <i class="fas fa-hourglass-half text-warning"></i>
                        Chờ xác nhận
                    </td>
                    <td>chiuroi</td>
                    <td>977.000 đ</td>
                    <td>2024-11-24 13:52:22</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                <tr>
                    <td>33</td>
                    <td>
                        <i class="fas fa-check-circle text-success"></i> Đã
                        giao hàng
                    </td>
                    <td>chiuroi</td>
                    <td>190.000 đ</td>
                    <td>2024-11-24 08:30:29</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>
                        <i class="fas fa-check-circle text-success"></i> Đã
                        hoàn thành
                    </td>
                    <td>chiuroi</td>
                    <td>389.000 đ</td>
                    <td>2024-11-23 18:01:10</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
                <tr>
                    <td>31</td>
                    <td>
                        <i class="fas fa-hourglass-half text-warning"></i>
                        Chờ xác nhận
                    </td>
                    <td>N/A</td>
                    <td>75 đ</td>
                    <td>2024-11-22 08:16:21</td>
                    <td>
                        <a href="/admin/detailorder" class="fas fa-eye text-success"></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endpush
</body>
@endsection

</html>