@extends('layouts.dashboard')

@section('content')
    <h2>Tambah Akun Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
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
                Username harus unik dan hanya boleh mengandung huruf, angka, atau underscore, panjang 4–20 karakter.
            </small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email') }}"
                class="form-control" required>

            <small class="text-muted">
                Hanya email dari <code>@gmail.com</code>, <code>@yahoo.com</code>, atau <code>@outlook.com</code> yang diperbolehkan.
            </small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password"
                class="form-control" required minlength="6">
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
