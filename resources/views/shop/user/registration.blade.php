@extends('layout.shop.layout')
@section('title', 'Đăng ký')
@section('content')

<div class="d-flex align-items-center justify-content-center">
    <div class="p-4" style="width:100%;max-width:600px;">

        <div class="d-flex tab-form-account align-items-center justify-content-center mb-4">
            <h3><a href="{{ route('shop.login') }}" class="text-decoration-none text-muted px-4">Đăng nhập</a></h3>
            <h4 class="text-muted p-0">|</h4>
            <h3><a href="{{ route('shop.registration') }}" class="text-decoration-none link-dark px-4">Đăng ký</a></h3>
        </div>

        <form action="{{ route('shop.doRegistration') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control form-control-lg" placeholder="Họ và tên" required>
                @error('fullname') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg" placeholder="Tên đăng nhập" required>
                @error('username') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Email" required>
                @error('email') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control form-control-lg" placeholder="Số điện thoại" required>
                @error('phone') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <textarea name="address" class="form-control form-control-lg" rows="2" placeholder="Địa chỉ">{{ old('address') }}</textarea>
                @error('address') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control form-control-lg">
                @error('birthday') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <select name="gender" class="form-select form-select-lg" required>
                    <option value="">-- Chọn giới tính --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                </select>
                @error('gender') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Avatar</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">
                @error('avatar') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
                @error('password') <small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Nhập lại mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Đăng ký</button>

            <div class="text-center mt-4">
                Bạn đã có tài khoản?
                <a href="{{ route('shop.login') }}" class="text-decoration-none">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</div>
@endsection
