@extends('admin.layouts.app')

@section('title', 'Kelola Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Galeri</h1>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Foto
            </a>
        </div>
    </div>
</div>

<div class="row">
    @foreach($galleries as $gallery)
    <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
        <div class="card shadow">
            <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" 
                 alt="{{ $gallery->title }}" style="height: 200px; object-fit: cover;">
            <div class="card-body text-center">
                <h6 class="card-title">{{ $gallery->title }}</h6>
                <p class="card-text text-muted small">{{ $gallery->type_name }}</p>
                @if($gallery->description)
                <p class="card-text small">{{ Str::limit($gallery->description, 50) }}</p>
                @endif
                <p class="card-text text-muted small">Ditambahkan: {{ $gallery->created_at->format('d M Y') }}</p>
                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Hapus foto ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @if($galleries->isEmpty())
    <div class="col-12">
        <div class="text-center py-5">
            <i class="fas fa-images fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada foto di galeri.</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Foto Pertama
            </a>
        </div>
    </div>
    @endif
</div>
@endsection