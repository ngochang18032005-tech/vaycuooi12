@extends('layout.admin.layout')
@section('title', 'Quản lý người dùng')
@section('content')

<div class="container my-4">
    <!-- Tiêu đề trang -->
    <h1>Quản Lý Người Dùng</h1>

    <!-- Nút thêm người dùng mới -->
    <a href="{{ route('admin.userCreate') }}" class="btn btn-primary mb-3">Thêm người dùng</a>

    <!-- Thông báo -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Bảng người dùng -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center align-middle">
                <th style="width: 50px;">ID</th>
                <th>Tên đầy đủ</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th style="width: 100px;">Role</th>
                <th style="width: 150px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="text-center align-middle">
                <td>{{ $user->id }}</td>
                <td class="text-start">{{ $user->fullname }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <!-- Chi tiết -->
                    <a href="{{ route('admin.userShow', $user->id) }}" class="btn btn-success btn-sm bi bi-eye"
                        title="Chi tiết"></a>
                    <!-- Sửa -->
                    <a href="{{ route('admin.userEdit', $user->id) }}" class="btn btn-warning btn-sm bi bi-pencil"
                        title="Sửa"></a>
                    <!-- Xóa vĩnh viễn chỉ cho role=user -->
                    @if($user->role === 'user')
                    <form action="{{ route('admin.userForceDelete', $user->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này vĩnh viễn?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm bi bi-trash3" title="Xóa"></button>
                    </form>
                    @else
                    <button class="btn btn-danger btn-sm bi bi-trash3" disabled title="Không thể xóa Admin"></button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="container mt-4">
        <nav>
            <ul class="pagination justify-content-center">
                @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">«</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}">«</a>
                </li>
                @endif

                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach

                @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">»</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">»</span>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</div>

@endsection