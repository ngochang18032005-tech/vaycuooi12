@extends('layout.shop.layout')
@section('title', 'Đăng nhập')
@section('content')

<x-notification />

<div class="d-flex align-items-center justify-content-center">
    <div class="p-4" style="width:100%;max-width:500px;">

        <div class="d-flex tab-form-account align-items-center justify-content-center mb-4">
            <h3><a href="{{ route('shop.login') }}" class="text-decoration-none link-dark px-4">Đăng nhập</a></h3>
            <h4 class="text-muted p-0">|</h4>
            <h3><a href="{{ route('shop.registration') }}" class="text-decoration-none text-muted px-4">Đăng ký</a></h3>
        </div>

        <form action="{{ route('shop.doLogin') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-lg"
                    placeholder="Tên đăng nhập" required>
                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu"
                    required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Đăng nhập</button>

            <div class="text-center mt-4">
                Chưa có tài khoản? <a href="{{ route('shop.registration') }}" class="text-decoration-none">Đăng ký
                    ngay</a>
            </div>
        </form>

    </div>
</div>
@endsection