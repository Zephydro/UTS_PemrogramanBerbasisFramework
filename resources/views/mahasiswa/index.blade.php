<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.pdf') }}" class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('mahasiswa.excel') }}" class="btn btn-success" target="_blank">
                    <i class="bi bi-file-excel"></i> Export Excel
                </a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                    + Tambah Mahasiswa
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Cari berdasarkan nama, NIM, atau email..." 
                               value="{{ $search ?? '' }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                    @if(isset($search))
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $m)
                        <tr>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->nim }}</td>
                            <td>{{ $m->email }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                                    <form action="{{ route('mahasiswa.destroy',$m->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($mahasiswa->isEmpty())
                    <p class="text-center text-muted">Belum ada data mahasiswa.</p>
                @endif

                <!-- Pagination Info -->
                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <small class="text-muted">
                        @if($mahasiswa->count() > 0)
                            Menampilkan data ke {{ ($mahasiswa->currentpage()-1) * $mahasiswa->perpage() + 1 }} 
                            sampai {{ ($mahasiswa->currentpage()-1) * $mahasiswa->perpage() + $mahasiswa->count() }}
                        @else
                            Tidak ada data
                        @endif
                    </small>
                    <div>
                        <ul class="pagination pagination-sm mb-0">
                            @if ($mahasiswa->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $mahasiswa->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @if ($mahasiswa->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $mahasiswa->nextPageUrl() }}">Next</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS for Pagination -->
    <style>
        .pagination {
            margin-bottom: 0;
        }
        .page-link {
            color: #6c757d;
            border: none;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            background: none;
        }
        .page-link:hover {
            color: #000;
            background: none;
            border: none;
        }
        .page-item.disabled .page-link {
            background: none;
            border: none;
            color: #ccc;
        }
        .page-item:not(:last-child) .page-link {
            margin-right: 0.5rem;
        }
    </style>
</body>
</html>
