@extends('layouts.app')

@section('title', 'Layanan Rumah Sakit')

@section('content')
<!-- Hero Section -->
<section class="services-hero bg-gradient-primary text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Layanan Kesehatan Terpadu</h1>
                <p class="lead mb-4">Kami menyediakan berbagai layanan kesehatan dengan teknologi terkini dan tim medis profesional untuk memberikan perawatan terbaik bagi Anda dan keluarga.</p>
                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-white text-primary fs-6 py-2 px-3">🩺 Dokter Spesialis</span>
                    <span class="badge bg-white text-primary fs-6 py-2 px-3">💊 Farmasi 24 Jam</span>
                    <span class="badge bg-white text-primary fs-6 py-2 px-3">🚑 IGD 24 Jam</span>
                </div>
            </div>
           <div class="col-lg-4 text-lg-end">
                <div class="hero-icon">
                    <i class="fa-solid fa-comment-medical fa-8x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Layanan Unggulan Kami</h2>
            <p class="section-subtitle">Berbagai layanan kesehatan komprehensif untuk kebutuhan medis Anda</p>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-xl-4 col-md-6">
                <div class="service-card card h-100 border-0 shadow-hover">
                    <div class="card-body p-4">
                        <div class="service-icon-wrapper mb-4">
                            <div class="service-icon">
                                <span class="icon-emoji">{{ $service->modern_icon }}</span>
                            </div>
                        </div>
                        <h4 class="service-title">{{ $service->name }}</h4>
                        <p class="service-description">{{ $service->description }}</p>
                        
                        <div class="service-meta mt-4">
                            <div class="operational-hours">
                                <i class="fas fa-clock text-primary me-2"></i>
                                <span class="text-muted">{{ $service->operational_hours }}</span>
                            </div>
                        </div>
                        
                        <div class="service-actions mt-4">
                            <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#serviceModal{{ $loop->index }}">
                                <i class="fas fa-info-circle me-1"></i> Detail
                            </button>
                            <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-calendar-check me-1"></i> Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Emergency Section -->
<section class="emergency-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="emergency-title">Layanan Gawat Darurat 24 Jam</h3>
                <p class="emergency-text">Tim medis kami siap melayani Anda kapan saja dengan respon cepat dan peralatan lengkap.</p>
                <div class="emergency-contacts">
                    <div class="contact-item">
                        <i class="fas fa-phone-alt text-danger"></i>
                        <span class="contact-number">(021) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-ambulance text-danger"></i>
                        <span class="contact-number">119 (Emergency)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="emergency-badge">
                    <div class="badge-content">
                        <i class="fas fa-ambulance fa-3x text-white"></i>
                        <h4 class="text-white mt-2">24/7</h4>
                        <p class="text-white mb-0">Emergency</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-user-md fa-2x text-primary"></i>
                    </div>
                    <h5>Dokter Berpengalaman</h5>
                    <p class="text-muted">Tim dokter spesialis dengan pengalaman luas di bidangnya masing-masing</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-microscope fa-2x text-primary"></i>
                    </div>
                    <h5>Teknologi Modern</h5>
                    <p class="text-muted">Peralatan medis terkini untuk diagnosis dan perawatan yang akurat</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-hand-holding-heart fa-2x text-primary"></i>
                    </div>
                    <h5>Pelayanan Ramah</h5>
                    <p class="text-muted">Staff medis yang ramah dan profesional siap melayani dengan hati</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Modals -->
@foreach($services as $service)
<div class="modal fade" id="serviceModal{{ $loop->index }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-wrapper">
                    <span class="modal-icon me-3">{{ $service->modern_icon }}</span>
                    <div>
                        <h5 class="modal-title">{{ $service->name }}</h5>
                        <p class="text-muted mb-0">{{ $service->operational_hours }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ $service->description }}</p>
                
                <div class="service-details mt-4">
                    <h6>Fasilitas yang Tersedia:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> Konsultasi dengan dokter spesialis</li>
                        <li><i class="fas fa-check text-success me-2"></i> Pemeriksaan lengkap</li>
                        <li><i class="fas fa-check text-success me-2"></i> Perawatan intensif</li>
                        <li><i class="fas fa-check text-success me-2"></i> Layanan rawat inap</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <i class="fas fa-calendar-check me-2"></i> Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
/* Hero Section */
.services-hero {
    background: linear-gradient(135deg, #1cccb4 0%, #93d1be 100%);
    position: relative;
    overflow: hidden;
}

.services-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.hero-image img {
    transform: perspective(1000px) rotateY(-5deg);
    transition: transform 0.3s ease;
}

.hero-image:hover img {
    transform: perspective(1000px) rotateY(0deg);
}

/* Section Titles */
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #0e808f 0%, #0d9b77 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 600px;
    margin: 0 auto;
}

/* Service Cards */
.service-card {
    border-radius: 20px;
    transition: all 0.3s ease;
    background: white;
    position: relative;
    overflow: hidden;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #6a6f83 0%, #0c915e 100%);
}

.shadow-hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.shadow-hover:hover {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    transform: translateY(-5px);
}

.service-icon-wrapper {
    text-align: center;
}

.service-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1eb891 0%, #10a372 100%);
    border-radius: 20px;
    margin: 0 auto;x    
}

.icon-emoji {
    font-size: 2rem;
}

.service-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.service-description {
    color: #6c757d;
    line-height: 1.6;
}

.service-meta {
    border-top: 1px solid #e9ecef;
    padding-top: 1rem;
}

/* Emergency Section */
.emergency-section {
    background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
    border-radius: 20px;
    margin: 0 1rem;
}

.emergency-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #e53e3e;
    margin-bottom: 1rem;
}

.emergency-text {
    font-size: 1.1rem;
    color: #4a5568;
    margin-bottom: 2rem;
}

.emergency-contacts {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
    font-weight: 600;
}

.contact-number {
    color: #2d3748;
}

.emergency-badge {
    display: inline-block;
    background: linear-gradient(135deg, #fc8181 0%, #e53e3e 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 25px rgba(229, 62, 62, 0.3);
}

.badge-content {
    text-align: center;
}

/* Feature Cards */
.feature-card {
    padding: 2rem 1rem;
}

.feature-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #f2f2f3 0%, #f4f3f5 100%);
    border-radius: 15px;
    margin: 0 auto;
    color: white;
}

/* Modal Styles */
.modal-title-wrapper {
    display: flex;
    align-items: center;
}

.modal-icon {
    font-size: 2rem;
}

.service-details ul li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.service-details ul li:last-child {
    border-bottom: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .services-hero {
        text-align: center;
        padding: 3rem 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .emergency-contacts {
        flex-direction: column;
        gap: 1rem;
    }
    
    .service-card {
        margin-bottom: 1rem;
    }
}

@media (max-width: 576px) {
    .hero-image img {
        transform: none;
    }
    
    .service-icon {
        width: 60px;
        height: 60px;
    }
    
    .icon-emoji {
        font-size: 1.5rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.service-card {
    animation: fadeInUp 0.6s ease forwards;
}

.service-card:nth-child(2) { animation-delay: 0.1s; }
.service-card:nth-child(3) { animation-delay: 0.2s; }
.service-card:nth-child(4) { animation-delay: 0.3s; }
.service-card:nth-child(5) { animation-delay: 0.4s; }
.service-card:nth-child(6) { animation-delay: 0.5s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add intersection observer for animations
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

    // Observe service cards
    document.querySelectorAll('.service-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Smooth scroll for emergency section
    const emergencySection = document.querySelector('.emergency-section');
    if (emergencySection) {
        emergencySection.style.opacity = '0';
        emergencySection.style.transform = 'translateY(30px)';
        emergencySection.style.transition = 'all 0.6s ease 0.3s';
        
        const emergencyObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        emergencyObserver.observe(emergencySection);
    }
});
</script>
@endsection