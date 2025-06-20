<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="modal-container">
            <div class="modal-header">
                <h2 class="modal-title">Reset Password</h2>
            </div>

            <div class="modal-body">
                <p>Enter your email and new password to reset your account.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', request()->email) }}" placeholder="Email" required readonly>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red; font-size: 12px;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="New Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red; font-size: 12px;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Confirm Password" required>
                    </div>

                    <button type="submit" class="login-button">Reset Password</button>

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
