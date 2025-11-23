@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h1 class="text-center mb-5">Tentang Kami</h1>

            <!-- Sejarah -->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="card-title mb-4">
                                <i class="fas fa-history text-primary me-2"></i>Sejarah Perjalanan Kami
                            </h3>
                            <p class="card-text" style="line-height: 1.8; text-align: justify;">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->history }}
                                @else
                                    Rumah Sakit Kami didirikan pada tahun 1990 dengan misi memberikan pelayanan kesehatan 
                                    yang berkualitas kepada masyarakat. Selama lebih dari 30 tahun, kami telah berkembang 
                                    menjadi rumah sakit terpercaya dengan fasilitas modern dan tim medis yang profesional.
                                    Dari awal yang sederhana, kami terus berinovasi dan berkembang untuk memenuhi kebutuhan
                                    kesehatan masyarakat dengan standar pelayanan tertinggi.
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-hospital fa-3x text-white"></i>
                            </div>
                            <h5>30+ Tahun</h5>
                            <p class="text-muted">Melayani Masyarakat</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Pencapaian & Statistik -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h3 class="mb-3">Pencapaian Kami</h3>
                    <p class="text-muted">Bukti komitmen kami dalam memberikan pelayanan terbaik</p>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-user-md fa-2x text-primary"></i>
                            </div>
                            <h3 class="text-primary mb-1">50+</h3>
                            <p class="text-muted mb-0">Dokter Spesialis</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-procedures fa-2x text-success"></i>
                            </div>
                            <h3 class="text-success mb-1">100+</h3>
                            <p class="text-muted mb-0">Bedah Sukses</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-smile fa-2x text-warning"></i>
                            </div>
                            <h3 class="text-warning mb-1">10,000+</h3>
                            <p class="text-muted mb-0">Pasien Puas</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-award fa-2x text-info"></i>
                            </div>
                            <h3 class="text-info mb-1">15+</h3>
                            <p class="text-muted mb-0">Penghargaan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Fasilitas Unggulan -->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h3 class="mb-3">Fasilitas Unggulan Kami</h3>
                            <p class="text-muted">Teknologi terkini untuk perawatan terbaik</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-heartbeat fa-2x text-primary me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>ICU & NICU</h5>
                                    <p class="text-muted mb-0">Unit perawatan intensif dengan monitoring 24 jam</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-microscope fa-2x text-success me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>Laboratorium Modern</h5>
                                    <p class="text-muted mb-0">Peralatan terbaru untuk diagnosis akurat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-x-ray fa-2x text-info me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>Radiologi Digital</h5>
                                    <p class="text-muted mb-0">Pencitraan medis dengan teknologi digital</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-ambulance fa-2x text-danger me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>IGD 24 Jam</h5>
                                    <p class="text-muted mb-0">Layanan gawat darurat siap siaga</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-baby fa-2x text-warning me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>Maternal & Neonatal</h5>
                                    <p class="text-muted mb-0">Perawatan khusus ibu dan bayi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-brain fa-2x text-purple me-3"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5>Neurosains</h5>
                                    <p class="text-muted mb-0">Spesialisasi saraf dan otak</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Tim Dokter Spesialis -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h3 class="mb-3">Tim Dokter Spesialis</h3>
                    <p class="text-muted">Dokter berpengalaman di bidangnya masing-masing</p>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-heart fa-2x text-white"></i>
                            </div>
                            <h5>Kardiologi</h5>
                            <p class="text-muted mb-0">Spesialis Jantung</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-brain fa-2x text-white"></i>
                            </div>
                            <h5>Neurologi</h5>
                            <p class="text-muted mb-0">Spesialis Saraf</p>
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
                            <h5>Pediatri</h5>
                            <p class="text-muted mb-0">Spesialis Anak</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-eye fa-2x text-white"></i>
                            </div>
                            <h5>Oftalmologi</h5>
                            <p class="text-muted mb-0">Spesialis Mata</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Visi & Misi -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-primary">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0"><i class="fas fa-eye me-2"></i>Visi Kami</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="line-height: 1.8;">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->vision }}
                                @else
                                    Menjadi rumah sakit pilihan utama masyarakat dengan pelayanan kesehatan 
                                    berkualitas internasional yang terjangkau dan berkelanjutan.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0"><i class="fas fa-bullseye me-2"></i>Misi Kami</h4>
                        </div>
                        <div class="card-body">
                            @if(isset($hospitalProfile))
                                @php
                                    $missions = is_array($hospitalProfile->mission) 
                                        ? $hospitalProfile->mission 
                                        : explode("\n", $hospitalProfile->mission);
                                @endphp
                                <ul class="list-unstyled">
                                    @foreach(array_filter($missions) as $mission)
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            {{ $mission }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Memberikan pelayanan kesehatan yang bermutu</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mengutamakan kepuasan pasien</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mengembangkan sumber daya manusia yang profesional</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Memiliki teknologi medis yang terkini</li>
                                    <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Berperan aktif dalam penelitian kesehatan</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Penghargaan & Sertifikasi -->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-4">Penghargaan & Sertifikasi</h3>
                            <p class="mb-4">Pengakuan atas komitmen kami dalam memberikan pelayanan kesehatan terbaik</p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-award text-warning fa-2x me-3"></i>
                                        <div>
                                            <h6 class="mb-0">Akreditasi JCI</h6>
                                            <small class="text-muted">Standar Internasional</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-shield-alt text-success fa-2x me-3"></i>
                                        <div>
                                            <h6 class="mb-0">KARS Paripurna</h6>
                                            <small class="text-muted">Akreditasi Nasional</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-trophy text-primary fa-2x me-3"></i>
                                        <div>
                                            <h6 class="mb-0">Hospital of the Year</h6>
                                            <small class="text-muted">2023 Award</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-info fa-2x me-3"></i>
                                        <div>
                                            <h6 class="mb-0">Patient Safety</h6>
                                            <small class="text-muted">Excellence Award</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-light rounded p-4">
                                <i class="fas fa-medal fa-4x text-warning mb-3"></i>
                                <h5>Terakreditasi</h5>
                                <p class="text-muted mb-0">Standar Internasional</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Lokasi & Kontak -->
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h3 class="card-title mb-4 text-center">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi & Kontak
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Informasi Kontak</h5>
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                <strong>Alamat:</strong><br>
                                <span class="ms-4">
                                    @if(isset($hospitalProfile))
                                        {{ $hospitalProfile->address }}
                                    @else
                                        Jl. Kesehatan No. 123, Jakarta Pusat 10110
                                    @endif
                                </span>
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <strong>Telepon:</strong><br>
                                <span class="ms-4">
                                    @if(isset($hospitalProfile))
                                        {{ $hospitalProfile->phone }}
                                    @else
                                        (021) 123-4567
                                    @endif
                                </span>
                            </div>
                            <div class="mb-3">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <strong>Email:</strong><br>
                                <span class="ms-4">
                                    @if(isset($hospitalProfile))
                                        {{ $hospitalProfile->email }}
                                    @else
                                        info@rumahsakit.com
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Jam Operasional</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2 d-flex justify-content-between">
                                    <span>Senin - Jumat</span>
                                    <strong>07:00 - 21:00</strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span>Sabtu</span>
                                    <strong>07:00 - 18:00</strong>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span>Minggu</span>
                                    <strong>08:00 - 16:00</strong>
                                </li>
                                <li class="mb-0 pt-2 border-top d-flex justify-content-between">
                                    <span><strong>IGD & Apotek</strong></span>
                                    <strong class="text-danger">24 Jam</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-purple {
    color: #6f42c1 !important;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.bg-primary.bg-opacity-10 {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.bg-success.bg-opacity-10 {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-warning.bg-opacity-10 {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.bg-info.bg-opacity-10 {
    background-color: rgba(13, 202, 240, 0.1) !important;
}
</style>
@endsection