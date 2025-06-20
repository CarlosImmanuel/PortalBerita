<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="modal-container">

            @if(session('status'))
                <div class="alert-custom alert-success">
                    {{ session('status') }}
                    <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <div class="modal-header">
                <h2 class="modal-title">Reset Your Password</h2>
            </div>

            <div class="modal-body">
                <p>Enter your registered email to receive a password reset link.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red; font-size: 12px;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="login-button">Send Reset Link</button>

                    <div class="register-link">
                        Remembered your password? <a href="{{ route('login') }}">Log In</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @include('layouts.footer')
</body>
</html>
