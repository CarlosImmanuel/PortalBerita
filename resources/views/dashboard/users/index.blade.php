@extends('layouts.dashboard')

@section('content')
    <h2>Manage Account</h2>

    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-user-plus me-1"></i> Add Account
    </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 text-body">
            <thead class="border-bottom border-secondary">
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="20%">Username</th>
                    <th width="25%">Email</th>
                    <th width="15%">Role</th>
                    <th width="15%">Status</th>
                    <th width="20%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @if ($user->status === 'banned')
                                <span class="badge bg-danger">Banned</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center flex-wrap gap-1">

                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}" title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>

                                @if ($user->status === 'banned')
                                    <form action="{{ route('users.unban', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-success btn-sm" title="Unban User">
                                            <i class="fas fa-unlock"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('users.ban', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-secondary btn-sm" title="Ban User">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            {{-- Modal Hapus User --}}
                            <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the user <strong>{{ $user->username }}</strong> with email <strong>{{ $user->email }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data user</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection
