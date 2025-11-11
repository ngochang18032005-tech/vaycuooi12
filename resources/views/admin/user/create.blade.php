@extends('layout.admin.layout')
@section('title', 'Thêm Người Dùng')
@section('content')

<div class="container mt-3">
    <div class="card shadow-sm">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Thêm Người Dùng</h4>
        </div>

        <x-notification />

        <div class="card-body">
            <form action="{{ route('admin.userStore') }}" method="POST">
                @csrf

                <!-- Tên người dùng -->
                <div class="mb-3">
                    <label for="fullname" class="form-label">Tên đầy đủ</label>
                    <input type="text" class="form-control border" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                </div>

                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control border" id="username" name="username" value="{{ old('username') }}" required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control border" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>

                <!-- Giới tính -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Giới tính</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control border" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <!-- Mật khẩu -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control border" id="password" name="password" required>
                </div>

                <!-- Xác nhận mật khẩu -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control border" id="password_confirmation" name="password_confirmation" required>
                </div>

                <!-- Quyền người dùng -->
                <div class="mb-3">
                    <label for="role" class="form-label">Quyền người dùng</label>
                    <select class="form-select border" id="role" name="role" required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Người dùng</option>
                    </select>
                </div>


                <!-- Nút Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-25">Thêm người dùng</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
