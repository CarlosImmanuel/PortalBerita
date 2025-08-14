@extends('layouts.dashboard')

@section('content')
    <h2>Add New Account</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There is an error!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username"
                value="{{ old('username') }}"
                class="form-control" required pattern="[a-zA-Z0-9_]{4,20}"
                title="Username hanya boleh huruf, angka, dan underscore, minimal 4 karakter">

            <small class="text-muted">
                Username must be unique and may only contain letters, numbers, or underscores, and be 4–20 characters long.
            </small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email') }}"
                class="form-control" required>

            <small class="text-muted">
                Only email from <code>@gmail.com</code>, <code>@yahoo.com</code>, or <code>@outlook.com</code> are allowed.
            </small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="" disabled selected>Select a role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password"
                class="form-control" required minlength="6">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-save me-1"></i> Save
            </button>
        </div>
    </form>
@endsection

