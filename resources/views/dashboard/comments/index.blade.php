@extends('dashboard.index')

@section('content')
    <div class="mb-4">
        <h2>Kelola Komentar</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ID Berita</th>
                    <th>Nama User</th>
                    <th>Isi Komentar</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $index => $comment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $comment->berita_id }}</td>
                        <td>{{ $comment->nama ?? 'User tidak ditemukan' }}</td>
                        <td>{{ $comment->isi }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus komentar ini?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data komentar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
