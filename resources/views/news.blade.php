@extends('layouts.app')

@section('title', 'Berita & Artikel')

@section('content')
<div class="container py-5">
     @if(isset($hospitalProfile) && $hospitalProfile->description)
    <div class="row mb-5">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <p class="mb-0">{{ $hospitalProfile->description }}</p>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        @foreach($articles as $article)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $article->image_url }}" class="card-img-top" 
                     alt="{{ $article->title }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">{{ $article->category }}</span>
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->excerpt }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $article->created_at->format('d M Y') }}</small>
                        <a href="{{ route('news.detail', $article->slug) }}" class="btn btn-sm btn-outline-primary">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($articles->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
        <p class="text-muted">Belum ada artikel yang dipublikasikan.</p>
    </div>
    @endif
</div>
@endsection