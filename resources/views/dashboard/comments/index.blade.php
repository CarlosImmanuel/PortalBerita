@extends('layouts.dashboard')

@section('content')
    <div class="mb-4">
        <h2>Manage Comments</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
    <table class="table table-hover align-middle mb-0 text-body">
        <thead class="border-bottom border-secondary">
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="25%">News Title</th>
                <th width="20%">Username</th>
                <th width="30%">Comment</th>
                <th width="10%" class="text-center">Date</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comments as $index => $komen)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>

                    <td>
                            @if(!empty($komen->judul_berita))
                                {{ $komen->judul_berita }}
                            @else
                                <span class="text-danger fw-semibold">
                                    <i class="fas fa-exclamation-circle me-1"></i> News not found
                                </span>
                            @endif
                    </td>

                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div>
                                <div class="fw-bold">{{ $komen->nama ?? 'User tidak ditemukan' }}</div>
                            </div>
                        </div>
                    </td>

                    <td title="{{ $komen->isi }}">
                        {{ Str::limit($komen->isi, 80) }}
                    </td>

                    <td class="text-center small text-muted">
                        {{ \Carbon\Carbon::parse($komen->created_at)->format('d M Y') }}<br>
                        {{ \Carbon\Carbon::parse($komen->created_at)->format('H:i') }}
                    </td>

                    <td class="text-center">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $komen->id }}" title="Hapus komentar">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal{{ $komen->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $komen->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $komen->id }}">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the comment from <strong>{{ $komen->nama ?? 'User tidak ditemukan' }}</strong>?<br>
                                        <span class="text-muted small">"{{ Str::limit($komen->isi, 80) }}"</span>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('comments.destroy', $komen->id) }}" method="POST">
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
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">There is no comment data yet</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
