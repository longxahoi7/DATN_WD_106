@extends('admin.index')

@section('content')
<div class="container">
    <h1>Danh sách người dùng</h1>

    <!-- Bộ lọc vai trò -->
    <form id="filterForm" method="GET" action="{{ route('admin.users.listUser') }}" class="mb-4">
        <label for="role">Lọc theo vai trò:</label>
        <select name="role" id="role" class="form-select w-25 d-inline-block">
            <option value="">Tất cả</option>
            <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>Admin</option>
            <option value="2" {{ request('role') == 2 ? 'selected' : '' }}>User</option>
            <option value="3" {{ request('role') == 3 ? 'selected' : '' }}>Manager</option>
        </select>
    </form>

    <!-- Bảng danh sách người dùng -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Chỉnh sửa quyền</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @switch($user->role)
                            @case(1)
                                Admin
                                @break
                            @case(2)
                                User
                                @break
                            @case(3)
                                Manager
                                @break
                            @default
                                Khác
                        @endswitch
                    </td>
                    <td>
                    @if (auth()->user()->role == 1) <!-- Kiểm tra nếu người dùng hiện tại là Admin -->
                            <form method="POST" action="{{ route('admin.users.update-role', $user->user_id) }}" style="display: inline;">
                                @csrf
                                <select name="role" class="form-select w-50 d-inline-block" onchange="this.form.submit()">
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Manager</option>
                                </select>
                            </form>
                        @else
                            <span>Không thể chỉnh sửa</span> <!-- Nếu người dùng không phải Admin, hiển thị thông báo -->
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có người dùng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Script -->
<script>
    document.getElementById('role').addEventListener('change', function () {
        // Tự động submit form khi thay đổi tùy chọn
        document.getElementById('filterForm').submit();
    });
</script>
@endsection
