@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    /* Partners Marquee Styles */
    .partners-marquee {
        overflow: hidden;
        position: relative;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px 0;
    }

    .partners-marquee::before,
    .partners-marquee::after {
        content: '';
        position: absolute;
        top: 0;
        width: 100px;
        height: 100%;
        z-index: 2;
    }

    .partners-marquee::before {
        left: 0;
        background: linear-gradient(to right, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%);
    }

    .partners-marquee::after {
        right: 0;
        background: linear-gradient(to left, rgba(248,249,250,1) 0%, rgba(248,249,250,0) 100%);
    }

    .marquee-content {
        display: flex;
        animation: marquee 30s linear infinite;
    }

    .partner-item {
        flex: 0 0 auto;
        margin: 0 30px;
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .partner-item:hover {
        transform: translateY(-5px);
    }

    .partner-item img {
        height: 60px;
        width: auto;
        object-fit: contain;
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }

    .partner-item:hover img {
        filter: grayscale(0%);
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /* Pause animation on hover */
    .partners-marquee:hover .marquee-content {
        animation-play-state: paused;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .partner-item {
            margin: 0 15px;
        }
        
        .partner-item img {
            height: 40px;
        }
        
        .partners-marquee::before,
        .partners-marquee::after {
            width: 50px;
        }
    }

    /* Stats cards hover effect */
    .border.rounded.p-3.bg-white {
        transition: all 0.3s ease;
    }

    .border.rounded.p-3.bg-white:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 mb-4 fw-bold">Selamat Datang di<br> 
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->name }}
                        @else
                            Rumah Sakit Kami
                        @endif
                    </h1>
                    <p class="lead mb-4 fs-5">
                           "Profesional, Berintegritas, Responsif, dan Fokus Pada Keselamatan Pasien"
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('services') }}" class="btn btn-primary btn-lg px-4 py-3">
                            <i class="fas fa-procedures me-2"></i>Lihat Layanan
                        </a>
                        <a href="{{ route('doctors') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-user-md me-2"></i>Dokter Kami
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4 py-3">
                            <i class="fas fa-phone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="row mt-5 pt-4">
                        <div class="col-md-3 col-6">
                            <div class="text-white">
                                <h3 class="fw-bold mb-1">20+</h3>
                                <small>Dokter Spesialis</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-white">
                                <h3 class="fw-bold mb-1">24/7</h3>
                                <small>Layanan IGD</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-white">
                                <h3 class="fw-bold mb-1">12+</h3>
                                <small>Kamar Rawat</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-white">
                                <h3 class="fw-bold mb-1">35+</h3>
                                <small>Tahun Pengalaman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Preview -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->name }}
                        @else
                            Rumah Sakit Kami
                        @endif
                    </h2>
                    <p class="mb-4">
                        @if(isset($hospitalProfile) && $hospitalProfile->description)
                            {{ $hospitalProfile->description }}
                        @else
                            Rumah Sakit kami telah melayani masyarakat dengan dedikasi tinggi dalam memberikan pelayanan kesehatan yang berkualitas. Dengan tim medis yang profesional dan fasilitas yang lengkap, kami berkomitmen untuk memberikan perawatan terbaik bagi pasien.
                        @endif
                    </p>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border rounded p-3 bg-white">
                                <i class="fas fa-user-md fa-2x text-primary mb-2"></i>
                                <h5 class="mb-1">20+</h5>
                                <small class="text-muted">Dokter Spesialis</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3 bg-white">
                                <i class="fas fa-procedures fa-2x text-success mb-2"></i>
                                <h5 class="mb-1">12+</h5>
                                <small class="text-muted">Kamar Rawat</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3 bg-white">
                                <i class="fas fa-users fa-2x text-warning mb-2"></i>
                                <h5 class="mb-1">10K+</h5>
                                <small class="text-muted">Pasien/Tahun</small>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('about') }}" class="btn btn-primary me-2">Selengkapnya</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative">
                        @if(isset($hospitalProfile) && $hospitalProfile->logo)
                            <img src="{{ asset('storage/' . $hospitalProfile->logo) }}" 
                                alt="{{ $hospitalProfile->name }}" 
                                class="img-fluid rounded shadow" 
                                style="max-height: 400px; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-19494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                                alt="Rumah Sakit Kami" 
                                class="img-fluid rounded shadow">
                        @endif
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 rounded-end">
                            <h5 class="mb-0"><i class="fas fa-award me-2"></i>Terpercaya Sejak 1988</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Accreditation Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h3 class="mb-3">Dokter Spesialis</h3>
                    <p class="text-muted">Dokter berpengalaman di bidangnya masing-masing</p>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                 <i class="fas fa-lungs fa-2x text-white"></i>
                            </div>
                            <h5>Jantung</h5>
                            <p class="text-muted mb-0">Spesialis Jantung</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-heart fa-2x text-white"></i>
                            </div>
                            <h5>Bedah</h5>
                            <p class="text-muted mb-0">Spesialis Bedah</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                 <i class="fa-solid fa-person-dots-from-line fa-2x text-white"></i>
                            </div>
                            <h5>Penyakit Dalam</h5>
                            <p class="text-muted mb-0">Spesialis Penyakit Dalam</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                 <i class="fa-solid fa-head-side-mask fa-2x text-white"></i>
                            </div>
                            <h5>THT</h5>
                            <p class="text-muted mb-0">Spesialis THT</p>
                        </div>
                    </div>
                </div>

                 <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-brain fa-2x text-white"></i>
                            </div>
                            <h5>Onkologi</h5>
                            <p class="text-muted mb-0">Spesialis Onkologi</p>
                        </div>
                    </div>
                </div>

                 <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-baby fa-2x text-white"></i>
                            </div>
                            <h5>Urologi</h5>
                            <p class="text-muted mb-0">Spesialis Urologi</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-pills fa-2x text-white"></i>
                            </div>
                            <h5>Orthopedi</h5>
                            <p class="text-muted mb-0">Spesialis Orthopedi</p>
                        </div>
                    </div>
                </div>

            </div>
                <div class="col-12 text-center">
                    <h2 class="display-5 mb-3">Akreditasi & Sertifikasi</h2>
                    <p class="lead">Bukti komitmen kami dalam memberikan pelayanan kesehatan terbaik dengan standar tertinggi</p>
                </div>
            </div>

            {{-- <div class="row">
                @foreach($accreditations as $accreditation)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card accreditation-card shadow-sm border-0 h-100">
                        <div class="card-body text-center p-4">
                            <div class="accreditation-icon mb-3">
                                <i class="{{ $accreditation['icon'] }} fa-3x text-primary"></i>
                            </div>
                            <div class="accreditation-badge mb-3">
                                <span class="badge bg-primary fs-6 px-3 py-2">{{ $accreditation['level'] }}</span>
                            </div>
                            <h4 class="card-title mb-3">{{ $accreditation['title'] }}</h4>
                            <p class="card-text text-muted mb-3">{{ $accreditation['description'] }}</p>
                            <div class="accreditation-year">
                                <small class="text-primary fw-bold">Tahun {{ $accreditation['year'] }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> --}}

            <!-- Accreditation Details -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <h3 class="mb-4">Standar Akreditasi Kami</h3>
                                    <div class="accreditation-features">
                                        <div class="feature-item d-flex mb-3">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <div>
                                                <h6 class="mb-1">Patient-Centered Care</h6>
                                                <p class="text-muted mb-0">Pelayanan berfokus pada kebutuhan dan keselamatan pasien</p>
                                            </div>
                                        </div>
                                        <div class="feature-item d-flex mb-3">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <div>
                                                <h6 class="mb-1">Clinical Excellence</h6>
                                                <p class="text-muted mb-0">Standar klinis tertinggi dengan teknologi medis terkini</p>
                                            </div>
                                        </div>
                                        <div class="feature-item d-flex mb-3">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <div>
                                                <h6 class="mb-1">Safety & Quality</h6>
                                                <p class="text-muted mb-0">Sistem keselamatan pasien dan mutu pelayanan terintegrasi</p>
                                            </div>
                                        </div>
                                        <div class="feature-item d-flex">
                                            <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                                            <div>
                                                <h6 class="mb-1">Continuous Improvement</h6>
                                                <p class="text-muted mb-0">Evaluasi dan peningkatan berkelanjutan untuk kualitas terbaik</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <div class="accreditation-visual">
                                        <div class="certificate-badge mb-4">
                                            <div class="badge-container">
                                                <img src="{{ asset('storage/gallery/logokars.png') }}" alt="Deskripsi Gambar" style="max-height: 150px; object-fit: cover;">
                                                <h4 class="text-primary">TERAKREDITASI</h4>
                                                <p class="text-muted">Paripurna • KARS</p>
                                            </div>
                                        </div>
                                        <div class="accreditation-stats">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <h3 class="text-primary mb-1">99%</h3>
                                                    <small class="text-muted">Kepuasan Pasien</small>
                                                </div>
                                                <div class="col-4">
                                                    <h3 class="text-primary mb-1">24/7</h3>
                                                    <small class="text-muted">Pelayanan</small>
                                                </div>
                                                <div class="col-4">
                                                    <h3 class="text-primary mb-1">20+</h3>
                                                    <small class="text-muted">Dokter Spesialis</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners & Insurance Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-3">Mitra & Asuransi Kami</h2>
                <p class="text-muted">Bekerja sama dengan berbagai mitra terpercaya dan menerima asuransi kesehatan</p>
            </div>
            <!-- Logo Marquee -->
            <div class="partners-marquee">
                <div class="marquee-content">
                    <!-- Asuransi -->
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (1).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (2).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (3).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (4).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (5).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (6).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (7).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (8).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (9).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (10).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (11).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (12).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (13).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (14).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (15).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (16).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (17).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (18).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (19).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (20).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (21).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (22).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (23).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    <div class="partner-item">
                        <img src="{{ asset('storage/gallery/logo1 (24).jpg') }}" style="max-height: 100px; object-fit: cover;" alt="BPJS" class="img-fluid">
                    </div>
                    
                </div>
            </div>

            <!-- Insurance Cards -->
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                            <h5>Asuransi Diterima</h5>
                            <p class="text-muted">Kami menerima berbagai jenis asuransi kesehatan untuk kenyamanan pasien</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                            <h5>Kemitraan Strategis</h5>
                            <p class="text-muted">Bekerja sama dengan rumah sakit dan institusi kesehatan terkemuka</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-file-invoice-dollar fa-3x text-warning mb-3"></i>
                            <h5>Klaim Mudah</h5>
                            <p class="text-muted">Proses klaim asuransi yang cepat dan mudah bagi pasien</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection