<div class="row">
    <div class="col-md-10">
        @if(auth()->check())
            <h4>Xin chào: {{ auth()->user()->fullname }} !</h4>
        @else
            <h4>Xin chào!</h4>
        @endif
    </div>
    <div class="col-md-2 text-center">
        @if(auth()->check())
            <a class="btn btn-danger" href="{{ route('admin.logout') }}">
                <i class="fas fa-sign-out-alt me-1"></i>Đăng xuất
            </a>
        @endif
    </div>
</div>
<hr>
