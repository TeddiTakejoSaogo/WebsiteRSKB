@extends('layouts.app')

@section('title', 'Berita & Artikel Kesehatan')

@section('content')
<!-- Hero Section -->
<section class="news-hero bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-light">Beranda</a></li>
                        <li class="breadcrumb-item active text-light">Berita</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">Berita & Artikel Kesehatan</h1>
                <p class="lead mb-4">Informasi terbaru seputar kesehatan, tips hidup sehat, dan perkembangan medis terkini dari rumah sakit kami.</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-primary">Kesehatan Umum</span>
                    <span class="badge bg-light text-primary">Tips Sehat</span>
                    <span class="badge bg-light text-primary">Pengetahuan Medis</span>
                    <span class="badge bg-light text-primary">Update RS</span>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="hero-icon">
                    <i class="fas fa-newspaper fa-8x opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Article -->
@if($articles->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="h3 mb-3">Artikel Terbaru</h2>
                <p class="text-muted">Update informasi kesehatan terkini untuk Anda</p>
            </div>
        </div>

        <!-- Featured Article (Large) -->
        @php $featured = $articles->first(); @endphp
        @if($featured)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card featured-article border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <img src="{{ $featured->image_url }}" 
                                 class="img-fluid h-100" 
                                 alt="{{ $featured->title }}"
                                 style="object-fit: cover; min-height: 300px;">
                        </div>
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-lg-5 d-flex flex-column h-100">
                                <div class="mb-3">
                                    <span class="badge bg-primary mb-2">{{ $featured->category }}</span>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $featured->created_at->translatedFormat('d F Y') }}
                                    </small>
                                </div>
                                <h3 class="card-title h2 mb-3">{{ $featured->title }}</h3>
                                <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($featured->content), 200) }}</p>
                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <div class="reading-time">
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ ceil(str_word_count(strip_tags($featured->content)) / 200) }} min read
                                        </small>
                                    </div>
                                    <a href="{{ route('news.detail', $featured->slug) }}" 
                                       class="btn btn-primary btn-lg">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Articles Grid -->
        <div class="row">
            @foreach($articles->skip(1) as $article)
            <div class="col-xl-4 col-lg-6 mb-4">
                <article class="card article-card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-img-wrapper position-relative">
                        <img src="{{ $article->image_url }}" 
                             class="card-img-top" 
                             alt="{{ $article->title }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end p-3">
                            <span class="badge bg-primary">{{ $article->category }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-meta mb-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $article->created_at->translatedFormat('d M Y') }}
                            </small>
                            <small class="text-muted ms-3">
                                <i class="fas fa-clock me-1"></i>
                                {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min
                            </small>
                        </div>
                        <h5 class="card-title mb-3">
                            <a href="{{ route('news.detail', $article->slug) }}" 
                               class="text-decoration-none text-dark stretched-link">
                                {{ $article->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>
                                1.2k views
                            </small>
                            <a href="{{ route('news.detail', $article->slug) }}" 
                               class="btn btn-outline-primary btn-sm">
                                Baca
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @else
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-newspaper fa-4x text-muted"></i>
                    </div>
                    <h3 class="h4 text-muted mb-3">Belum ada artikel</h3>
                    <p class="text-muted mb-4">Artikel sedang dalam persiapan. Silakan kembali lagi nanti.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Newsletter Subscription -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-gradient-primary text-white border-0 shadow">
                    <div class="card-body p-4 p-lg-5">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h4 class="card-title mb-2">Tetap Update dengan Info Kesehatan</h4>
                                <p class="card-text mb-0">Dapatkan artikel kesehatan terbaru langsung ke email Anda</p>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#newsletterModal">
                                    <i class="fas fa-envelope me-2"></i>Berlangganan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="h3 mb-3">Kategori Artikel</h2>
                <p class="text-muted">Temukan artikel berdasarkan kategori yang Anda minati</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <a href="#" class="card category-card text-center border-0 shadow-sm text-decoration-none h-100">
                    <div class="card-body p-4">
                        <div class="category-icon mb-3">
                            <i class="fas fa-heartbeat fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title mb-2">Kesehatan Jantung</h5>
                        <p class="card-text text-muted small">Tips menjaga kesehatan jantung</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="#" class="card category-card text-center border-0 shadow-sm text-decoration-none h-100">
                    <div class="card-body p-4">
                        <div class="category-icon mb-3">
                            <i class="fas fa-baby fa-2x text-success"></i>
                        </div>
                        <h5 class="card-title mb-2">Kesehatan Anak</h5>
                        <p class="card-text text-muted small">Perawatan dan tumbuh kembang</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="#" class="card category-card text-center border-0 shadow-sm text-decoration-none h-100">
                    <div class="card-body p-4">
                        <div class="category-icon mb-3">
                            <i class="fas fa-apple-alt fa-2x text-warning"></i>
                        </div>
                        <h5 class="card-title mb-2">Gizi & Diet</h5>
                        <p class="card-text text-muted small">Pola makan sehat</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="#" class="card category-card text-center border-0 shadow-sm text-decoration-none h-100">
                    <div class="card-body p-4">
                        <div class="category-icon mb-3">
                            <i class="fas fa-brain fa-2x text-info"></i>
                        </div>
                        <h5 class="card-title mb-2">Kesehatan Mental</h5>
                        <p class="card-text text-muted small">Kesehatan jiwa dan pikiran</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Modal -->
<div class="modal fade" id="newsletterModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Berlangganan Newsletter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">Dapatkan update artikel kesehatan terbaru langsung ke email Anda.</p>
                <form id="newsletterForm">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="nama@email.com">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="newsletterConsent">
                        <label class="form-check-label small" for="newsletterConsent">
                            Saya setuju menerima newsletter dan promosi kesehatan
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="subscribeNewsletter()">Berlangganan</button>
            </div>
        </div>
    </div>
</div>

<style>
.news-hero {
    background: linear-gradient(135deg, #097c43 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.news-hero::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.1;
}

.featured-article {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.featured-article:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.article-card {
    transition: all 0.3s ease;
}

.article-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.card-img-wrapper {
    overflow: hidden;
}

.article-card .card-img-top {
    transition: transform 0.5s ease;
}

.article-card:hover .card-img-top {
    transform: scale(1.05);
}

.card-overlay {
    background: linear-gradient(transparent 60%, rgba(0,0,0,0.7));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.article-card:hover .card-overlay {
    opacity: 1;
}

.category-card {
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.category-card:hover {
    background: white;
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.category-icon {
    transition: transform 0.3s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.1);
}

.breadcrumb-light .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.7);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #42a1db 0%, #36dbf8 100%) !important;
}

.empty-state-icon {
    opacity: 0.5;
}

@media (max-width: 768px) {
    .news-hero {
        text-align: center;
        padding: 3rem 0;
    }
    
    .hero-icon {
        display: none;
    }
    
    .featured-article .row {
        flex-direction: column;
    }
}
</style>

<script>
function subscribeNewsletter() {
    const form = document.getElementById('newsletterForm');
    const consent = document.getElementById('newsletterConsent');
    
    if (!consent.checked) {
        alert('Harap setujui persyaratan newsletter terlebih dahulu.');
        return;
    }
    
    // Simulate subscription
    const modal = bootstrap.Modal.getInstance(document.getElementById('newsletterModal'));
    modal.hide();
    
    // Show success message
    const alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fade show mt-3';
    alert.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
        <strong>Terima kasih!</strong> Anda telah berhasil berlangganan newsletter kami.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.querySelector('.container').insertBefore(alert, document.querySelector('.row').nextSibling);
    
    // Reset form
    form.reset();
}

// Add some interactive effects
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all article cards
    document.querySelectorAll('.article-card, .category-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endsection