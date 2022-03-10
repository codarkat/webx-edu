
<!DOCTYPE html>
<html lang="en">
@include('partials-main.head')
<body>
<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background" style="background-image: url('{{asset('public/assets/images/welcome.png')}}')">

    </div>
    <div class="app-auth-container">
        <div class="logo mb-5">
            <a href="{{route('admin.login')}}"><strong>MIREA</strong>VN <span class="text-danger"> ADMIN</span></a>
        </div>
        <form method="POST" action="{{ route('admin.check') }}">
            @csrf

            <div class="auth-credentials m-b-xxl">
                    <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control m-b-md @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control m-b-md @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    <a class="auth-forgot-password float-end" href="https://www.mireavn.ru/user/password-recovery">
                        Quên mật khẩu?
                    </a>
            </div>
        </form>
    </div>
</div>
@include('partials-main.script')
</body>
</html>
