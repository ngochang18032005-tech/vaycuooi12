@extends('layout.admin.layout')
@section('title', 'Chỉnh sửa người dùng')
@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chỉnh sửa người dùng</h4>
        </div>

        <x-notification />

        <div class="card-body">
            <form action="{{ route('admin.userUpdate', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Fullname + Username -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname"
                            class="form-control border" value="{{ old('fullname', $user->fullname) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username"
                            class="form-control border" value="{{ old('username', $user->username) }}" required>
                    </div>
                </div>

                <!-- Email + Phone -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control border" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Điện thoại</label>
                        <input type="text" name="phone" id="phone"
                            class="form-control border" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>

                <!-- Address + Birthday -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" name="address" id="address"
                            class="form-control border" value="{{ old('address', $user->address) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="birthday" class="form-label">Ngày sinh</label>
                        <input type="date" name="birthday" id="birthday"
                            class="form-control border" value="{{ old('birthday', $user->birthday) }}">
                    </div>
                </div>

                <!-- Gender -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label d-block">Giới tính</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                                {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                                {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Nữ</label>
                        </div>
                    </div>
                </div>

                <!-- Password + Confirm Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" class="form-control border" placeholder="Để trống nếu không đổi">
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border" placeholder="Xác nhận mật khẩu">
                    </div>
                </div>

                <!-- Avatar -->
                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh đại diện</label><br>
                    @if($user->avatar)
                        <img src="{{ asset('images/avatars/' . $user->avatar) }}" class="img-thumbnail mb-2" style="max-width: 150px;">
                    @endif
                    <input type="file" name="avatar" id="avatar" class="form-control border" accept="image/*">
                </div>

                <!-- Nút Cập nhật -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
