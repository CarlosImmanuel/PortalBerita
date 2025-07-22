<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="modal-container">

        @if(session()->has('success'))
            <div class="alert-custom alert-success">
                {{ session('success') }}
                <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if(session()->has('loginError'))
            <div class="alert-custom alert-error">
                {{ session('loginError') }}
                <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if(session()->has('failed'))
            <div class="alert-custom alert-error">
                {{ session('failed') }}
                <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

            <div class="modal-header">
                <h2 class="modal-title">Welcome to InfoNet!</h2>
            </div>

            <div class="modal-body">
                <p>Log in to your account to read the latest news and also discuss in the comments column!</p>

                {{-- action="{{ route('login') }}"DISAMPING  METHOD--}}
                <form action="/login" method="POST">
                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red; font-size: 12px;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="login-button">Log In</button>

                    <a href="/auth-google-redirect" class="btn btn-google" style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 0px; padding: 10px; border: 1px solid #000000; border-radius: 5px; background-color: #fff;">
                        <span class="google-icon">
                            <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                            </svg>
                        </span>
                        Or Login with Google
                    </a>

                    <div class="forgot-password" style="margin-top: 15px;">
                        <a href="{{ route('password.request') }}" style="font-weight: bold; text-decoration: underline;">
                            Forgot Password?
                        </a>
                    </div>

                    <div class="register-link">
                        You do not have account yet? <a href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
