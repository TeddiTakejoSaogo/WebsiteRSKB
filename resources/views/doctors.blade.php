@extends('layouts.app')

@section('title', 'Dokter Spesialis Kami')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; padding: 100px 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Dokter Spesialis Kami</h1>
                <p class="lead mb-4">Tim dokter profesional dan berpengalaman siap memberikan pelayanan kesehatan terbaik untuk Anda dan keluarga</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <span class="badge bg-primary fs-6 p-3">
                        <i class="fas fa-user-md me-2"></i>Dokter Berpengalaman
                    </span>
                    <span class="badge bg-success fs-6 p-3">
                        <i class="fas fa-stethoscope me-2"></i>Spesialis Lengkap
                    </span>
                    <span class="badge bg-info fs-6 p-3">
                        <i class="fas fa-clock me-2"></i>Jadwal Fleksibel
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Doctors Section -->
<section class="py-5">
    <div class="container">
        <!-- Search and Filter Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cari nama dokter atau spesialisasi..." id="searchInput">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-select form-select-lg" id="specializationFilter">
                                    <option value="">Semua Spesialisasi</option>
                                    <option value="Penyakit Dalam">Penyakit Dalam</option>
                                    <option value="Anak">Spesialis Anak</option>
                                    <option value="Bedah">Spesialis Bedah</option>
                                    <option value="Gigi">Spesialis Gigi</option>
                                    <option value="Jantung">Spesialis Jantung</option>
                                    <option value="Kulit">Spesialis Kulit</option>
                                    <option value="Mata">Spesialis Mata</option>
                                    <option value="Saraf">Spesialis Saraf</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-primary btn-lg w-100" onclick="resetFilters()">
                                    <i class="fas fa-refresh me-2"></i>Reset Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctors Grid -->
        <div class="row" id="doctorsGrid">
            @foreach($doctors as $doctor)
            <div class="col-xl-4 col-lg-6 mb-4 doctor-card" data-specialization="{{ $doctor->specialization }}">
                <div class="card doctor-card h-100 shadow-sm border-0">
                    <div class="card-img-wrapper position-relative">
                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/400x400?text=Doctor' }}" 
                             class="card-img-top doctor-image" 
                             alt="{{ $doctor->name }}"
                             style="height: 300px; object-fit: cover;">
                        <div class="card-img-overlay d-flex align-items-end">
                            <div class="specialization-badge">
                                <span class="badge bg-primary fs-6">{{ $doctor->specialization }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary mb-2">{{ $doctor->name }}</h5>
                        <p class="card-text text-muted mb-3">
                            <i class="fas fa-graduation-cap me-2"></i>{{ $doctor->education }}
                        </p>
                        
                        @if($doctor->experience)
                        <div class="experience-badge mb-3">
                            <span class="badge bg-success fs-7">
                                <i class="fas fa-award me-1"></i>{{ $doctor->experience }} Pengalaman
                            </span>
                        </div>
                        @endif

                        @if($doctor->description)
                        <p class="card-text doctor-description">{{ Str::limit($doctor->description, 120) }}</p>
                        @endif

                        <!-- Jadwal Praktik -->
                        <div class="schedule-section mt-4">
                            <h6 class="fw-bold mb-3 text-dark">
                                <i class="fas fa-calendar-alt me-2"></i>Jadwal Praktik
                            </h6>
                            <div class="schedule-list">
                                @foreach($doctor->getActiveSchedules() as $schedule)
                                <div class="schedule-item d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-medium">{{ $schedule->day_name }}</span>
                                    <span class="text-primary fw-bold">{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-lg" onclick="showDoctorModal({{ $doctor->id }})">
                                <i class="fas fa-calendar-plus me-2"></i>Buat Janji
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="text-center py-5" style="display: none;">
            <i class="fas fa-user-md fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Tidak ada dokter yang ditemukan</h4>
            <p class="text-muted">Coba gunakan kata kunci atau filter yang berbeda</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Butuh Konsultasi dengan Dokter?</h3>
                <p class="mb-0">Hubungi kami untuk informasi lebih lanjut atau buat janji temu dengan dokter spesialis</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-phone me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Doctor Detail Modal -->
<div class="modal fade" id="doctorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="doctorModalLabel">Detail Dokter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="doctorModalBody">
                <!-- Content will be loaded via JavaScript -->
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    position: relative;
}

.doctor-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.doctor-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.card-img-wrapper {
    overflow: hidden;
}

.doctor-image {
    transition: transform 0.3s ease;
}

.doctor-card:hover .doctor-image {
    transform: scale(1.05);
}

.specialization-badge {
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.63), rgba(235, 238, 235, 0.658));
    padding: 8px 16px;
    border-radius: 25px;
    backdrop-filter: blur(10px);
}

.schedule-item {
    transition: all 0.2s ease;
}

.schedule-item:hover {
    background: #e3f2fd !important;
    transform: translateX(5px);
}

.doctor-description {
    line-height: 1.6;
    color: #666;
}

/* Animation for cards */
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

.doctor-card {
    animation: fadeInUp 0.6s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .doctor-card {
        margin-bottom: 2rem;
    }
}

/* Loading animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}
</style>
<script>
// Show doctor modal with real data
function showDoctorModal(doctorId) {
    const modalBody = document.getElementById('doctorModalBody');
    const modalTitle = document.getElementById('doctorModalLabel');
    
    // Show loading state
    modalBody.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Memuat informasi dokter...</p>
        </div>
    `;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('doctorModal'));
    modal.show();
    
    // Fetch doctor details from API
    fetch(`/api/doctors/${doctorId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const doctor = data.data;
                
                // Build schedules HTML
                let schedulesHTML = '';
                if (doctor.schedules && doctor.schedules.length > 0) {
                    doctor.schedules.forEach(schedule => {
                        schedulesHTML += `
                            <div class="d-flex justify-content-between mb-2">
                                <span>${schedule.day_name}</span>
                                <span class="fw-bold text-primary">${schedule.time_range}</span>
                            </div>
                        `;
                    });
                } else {
                    schedulesHTML = '<p class="text-muted">Jadwal praktik belum tersedia.</p>';
                }
                
                // Update modal content with real data
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="${doctor.photo}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 alt="${doctor.name}" 
                                 style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="fw-bold text-primary">${doctor.name}</h5>
                            <span class="badge bg-primary">${doctor.specialization}</span>
                            ${doctor.experience ? `<p class="mt-2"><small class="text-muted">${doctor.experience}</small></p>` : ''}
                        </div>
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3">Tentang Dokter</h6>
                            <p class="mb-4">${doctor.description || 'Tidak ada deskripsi tersedia.'}</p>
                            
                            <h6 class="fw-bold mb-3">Pendidikan</h6>
                            <p class="mb-4">${doctor.education}</p>
                            
                            <h6 class="fw-bold mb-3">Jadwal Praktik</h6>
                            <div class="mb-4">
                                ${schedulesHTML}
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calendar-plus me-2"></i>Buat Janji Temu
                                </a>
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                // Update modal title
                modalTitle.textContent = `Detail - ${doctor.name}`;
                
            } else {
                // Show error message
                modalBody.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h5>Data Tidak Ditemukan</h5>
                        <p class="text-muted">${data.message || 'Terjadi kesalahan saat memuat data dokter.'}</p>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching doctor details:', error);
            
            // Show error message
            modalBody.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5>Terjadi Kesalahan</h5>
                    <p class="text-muted">Gagal memuat data dokter. Silakan coba lagi.</p>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            `;
        });
}

// Add click event to all doctor cards
document.addEventListener('DOMContentLoaded', function() {
    // Add click event to doctor cards
    const doctorCards = document.querySelectorAll('.card-hover');
    doctorCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Cegah trigger jika yang diklik adalah button
            if (!e.target.closest('button')) {
                const doctorId = this.querySelector('button')?.getAttribute('onclick')?.match(/\d+/)?.[0];
                if (doctorId) {
                    showDoctorModal(parseInt(doctorId));
                }
            }
        });
    });
});
</script>
@endsection