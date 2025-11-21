@extends('admin.layouts.app')

@section('title', 'Kelola Berita & Artikel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Berita & Artikel</h1>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Artikel
            </a>
        </div>
    </div>
</div>

<div class="card-body">
    {{-- Search and Filter Form --}}
    <form action="{{ route('admin.news') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari judul atau konten..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Results Count --}}
    @if(request()->hasAny(['search', 'category', 'status']))
    <div class="alert alert-info py-2">
        <small>
            <i class="fas fa-info-circle"></i> 
            Menampilkan {{ $articles->count() }} hasil
            @if(request('search')) untuk "{{ request('search') }}"@endif
            @if(request('category')) dalam kategori {{ request('category') }}@endif
            @if(request('status')) dengan status {{ request('status') }}@endif
            <a href="{{ route('admin.news') }}" class="float-end text-decoration-none">
                <small>Reset filter</small>
            </a>
        </small>
    </div>
    @endif

    {{-- Table content tetap sama --}}
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" 
                                         class="img-thumbnail" width="60" height="60" style="object-fit: cover;">
                                </td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category }}</td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.news.edit', $article->id) }}" 
                                           class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.news.toggle-status', $article->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $article->status === 'published' ? 'secondary' : 'success' }}">
                                                <i class="fas fa-{{ $article->status === 'published' ? 'eye-slash' : 'eye' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.news.destroy', $article->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Hapus artikel ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection