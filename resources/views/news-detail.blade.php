@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news') }}">Berita</a></li>
                    <li class="breadcrumb-item active">{{ $article->category }}</li>
                </ol>
            </nav>

            <!-- Article Content -->
            <article class="card shadow-sm">
                @if($article->image)
                <img src="{{ $article->image_url }}" class="card-img-top" 
                     alt="{{ $article->title }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ $article->category }}</span>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $article->created_at->translatedFormat('d F Y') }}
                        </small>
                    </div>
                    
                    <h1 class="card-title h2 mb-4">{{ $article->title }}</h1>
                    
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>
                    
                    <!-- Article Meta -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-user-edit me-1"></i>
                                    Ditulis oleh Admin
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Dibaca: 1.2k kali
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Share Buttons -->
            <div class="card shadow-sm mt-4">
                <div class="card-body text-center">
                    <h6 class="card-title mb-3">Bagikan Artikel</h6>
                    <div class="share-buttons">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fab fa-facebook me-1"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-outline-info btn-sm me-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm me-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="#" class="btn btn-outline-dark btn-sm">
                            <i class="fas fa-link me-1"></i> Copy Link
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Articles -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-newspaper me-2"></i>Artikel Terbaru</h6>
                </div>
                <div class="card-body">
                    @foreach($recentArticles as $recent)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6 class="card-title">
                            <a href="{{ route('news.detail', $recent->slug) }}" 
                               class="text-decoration-none">{{ $recent->title }}</a>
                        </h6>
                        <small class="text-muted">
                            {{ $recent->created_at->diffForHumans() }}
                        </small>
                    </div>
                    @endforeach
                    
                    @if($recentArticles->isEmpty())
                    <p class="text-muted text-center">Belum ada artikel lainnya.</p>
                    @endif
                </div>
            </div>

            <!-- Categories -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="fas fa-tags me-2"></i>Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-light text-dark">Kesehatan Umum</span>
                        <span class="badge bg-light text-dark">Kesehatan Anak</span>
                        <span class="badge bg-light text-dark">Kesehatan Jantung</span>
                        <span class="badge bg-light text-dark">Penyakit Dalam</span>
                        <span class="badge bg-light text-dark">Gizi & Diet</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.article-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.article-content h2 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.article-content h3 {
    color: #34495e;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.article-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.article-content ul, .article-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-content li {
    margin-bottom: 0.5rem;
}

.article-content blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6c757d;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.article-content table {
    width: 100%;
    margin: 1.5rem 0;
    border-collapse: collapse;
}

.article-content table th,
.article-content table td {
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    text-align: left;
}

.article-content table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

@media (max-width: 768px) {
    .article-content {
        font-size: 1rem;
    }
    
    .share-buttons .btn {
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy link functionality
    const copyLinkBtn = document.querySelector('.btn-outline-dark');
    if (copyLinkBtn) {
        copyLinkBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const url = window.location.href;
            
            navigator.clipboard.writeText(url).then(function() {
                const originalText = copyLinkBtn.innerHTML;
                copyLinkBtn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
                copyLinkBtn.classList.remove('btn-outline-dark');
                copyLinkBtn.classList.add('btn-outline-success');
                
                setTimeout(function() {
                    copyLinkBtn.innerHTML = originalText;
                    copyLinkBtn.classList.remove('btn-outline-success');
                    copyLinkBtn.classList.add('btn-outline-dark');
                }, 2000);
            });
        });
    }
});
</script>
@endsection