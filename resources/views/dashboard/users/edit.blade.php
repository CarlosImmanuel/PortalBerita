@extends('layouts.dashboard')

@section('content')
    <h2>Edit account</h2>

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

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email', $user->email) }}"
                class="form-control" required>

            <small class="text-muted">
                Only email from <code>@gmail.com</code>, <code>@yahoo.com</code>, or <code>@outlook.com</code> are allowed.
            </small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Cancel
            </a>
            <!-- Tombol untuk membuka modal konfirmasi update -->
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">
                <i class="fas fa-save me-1"></i> Update
            </button>
        </div>

        <!-- Modal Konfirmasi Update -->
        <div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUpdateModalLabel">Confirm Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to update this user's data?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <!-- Submit form saat klik "Update" -->
                        <button type="submit" class="btn btn-primary" onclick="document.querySelector('form').submit();">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
