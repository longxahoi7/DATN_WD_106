@extends('admin.index')
@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/huongAcount.css')}}">
@endpush
@section('content')

<body>

    <body>
        <div class="container">
            <div class="header">
                <h1>Quản khác hàng</h1>
            </div>
            <!-- <div class="button-container">
                <button class="add-button">Thêm khách hàng</button>
            </div> -->
            <form action="">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            @foreach ($customers as $customer )
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>
                                @if($customer->role == 1)
                                Admin
                                @else
                                Khách hàng
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.customers.toggle', $customer->user_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $customer->is_active ? 'btn-danger' : 'btn-success' }}">
                                        {{ $customer->is_active ? 'Tắt hoạt động' : 'Kích hoạt' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <i
                                        class="fas fa-edit edit-icon"
                                        title="Sửa"></i>
                                    <i
                                        class="fas fa-trash delete-icon"
                                        title="Xóa"
                                        onclick="openModal()"></i>
                                </div>
                            </td>

                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    </body>
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