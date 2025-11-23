@extends('layouts.app')

@section('title', 'Dokter Spesialis')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">Dokter Spesialis Kami</h1>
            <p class="lead text-muted">Tim dokter profesional yang siap memberikan pelayanan terbaik untuk kesehatan Anda</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('doctors') }}" method="GET" id="searchForm">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari nama dokter, spesialisasi, atau pendidikan..." 
                                           value="{{ request('search') }}"
                                           id="searchInput">
                                    <button class="btn btn-outline-primary" type="button" id="clearSearch">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="specialization" class="form-select form-select-lg" id="specializationSelect">
                                    <option value="">Semua Spesialisasi</option>
                                    @foreach($specializations as $spec)
                                        <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                            {{ $spec }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results Info -->
    @if(request()->hasAny(['search', 'specialization']))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info alert-dismissible fade show">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-3 fa-lg"></i>
                    <div>
                        <strong>Hasil Pencarian:</strong>
                        Menampilkan {{ $doctors->count() }} dokter
                        @if(request('search'))
                            untuk "<strong>{{ request('search') }}</strong>"
                        @endif
                        @if(request('specialization'))
                            dalam spesialisasi <strong>{{ request('specialization') }}</strong>
                        @endif
                    </div>
                </div>
                <a href="{{ route('doctors') }}" class="btn btn-sm btn-outline-info ms-3">
                    <i class="fas fa-times me-1"></i>Reset Pencarian
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Doctors Grid -->
    <div class="row" id="doctorsGrid">
        @forelse($doctors as $doctor)
        <div class="col-lg-4 col-md-6 mb-4 doctor-card">
            <div class="card h-100 shadow-sm border-0 doctor-card-inner">
                <div class="card-img-wrapper position-relative">
                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                         class="card-img-top" 
                         alt="{{ $doctor->name }}"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-img-overlay d-flex align-items-end justify-content-end">
                        <span class="badge bg-primary bg-opacity-90">{{ $doctor->specialization }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">{{ $doctor->name }}</h5>
                    <p class="card-text text-muted mb-2">
                        <i class="fas fa-graduation-cap me-2"></i>{{ $doctor->education }}
                    </p>
                    @if($doctor->experience)
                    <p class="card-text text-success mb-3">
                        <i class="fas fa-briefcase me-2"></i>{{ $doctor->experience }}
                    </p>
                    @endif
                    
                    @if($doctor->description)
                    <p class="card-text small">{{ Str::limit($doctor->description, 100) }}</p>
                    @endif

                    <!-- Jadwal Praktik -->
                    <div class="schedule-section mt-3">
                        <h6 class="fw-bold mb-2 text-dark">
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal Praktik:
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            @foreach($doctor->getActiveSchedules()->take(3) as $schedule)
                            <li class="mb-1">
                                <i class="fas fa-clock me-2 text-muted"></i>
                                <strong>{{ $schedule->day_name }}</strong>: 
                                {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </li>
                            @endforeach
                            @if($doctor->getActiveSchedules()->count() > 3)
                            <li class="text-primary small">
                                <i class="fas fa-plus me-1"></i>
                                {{ $doctor->getActiveSchedules()->count() - 3 }} jadwal lainnya
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 pt-0">
                    <div class="d-grid">
                        <button class="btn btn-outline-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#doctorModal{{ $doctor->id }}">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor Detail Modal -->
        <div class="modal fade" id="doctorModal{{ $doctor->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Detail Dokter</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                                     alt="{{ $doctor->name }}" 
                                     class="img-fluid rounded-circle mb-3"
                                     style="width: 200px; height: 200px; object-fit: cover;">
                                <h5 class="fw-bold">{{ $doctor->name }}</h5>
                                <span class="badge bg-primary fs-6">{{ $doctor->specialization }}</span>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-graduation-cap me-2"></i>Pendidikan
                                    </h6>
                                    <p class="mb-0">{{ $doctor->education }}</p>
                                </div>
                                
                                @if($doctor->experience)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-briefcase me-2"></i>Pengalaman
                                    </h6>
                                    <p class="mb-0">{{ $doctor->experience }}</p>
                                </div>
                                @endif
                                
                                @if($doctor->description)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-user-md me-2"></i>Profil
                                    </h6>
                                    <p class="mb-0">{{ $doctor->description }}</p>
                                </div>
                                @endif
                                
                                <div class="mb-3">
                                    <h6 class="fw-bold text-primary">
                                        <i class="fas fa-calendar-alt me-2"></i>Jadwal Praktik Lengkap
                                    </h6>
                                    <div class="row">
                                        @foreach($doctor->getActiveSchedules() as $schedule)
                                        <div class="col-md-6 mb-2">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body py-2">
                                                    <strong>{{ $schedule->day_name }}</strong><br>
                                                    <small class="text-muted">{{ $schedule->start_time }} - {{ $schedule->end_time }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="{{ route('contact') }}" class="btn btn-primary">
                            <i class="fas fa-calendar-check me-2"></i>Buat Janji
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12">
            <div class="text-center py-5">
                <div class="empty-state-icon mb-4">
                    <i class="fas fa-user-md fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">
                    @if(request()->hasAny(['search', 'specialization']))
                        Dokter Tidak Ditemukan
                    @else
                        Belum Ada Data Dokter
                    @endif
                </h4>
                <p class="text-muted mb-4">
                    @if(request()->hasAny(['search', 'specialization']))
                        Tidak ada dokter yang sesuai dengan kriteria pencarian Anda.
                    @else
                        Data dokter sedang dalam proses update.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'specialization']))
                <a href="{{ route('doctors') }}" class="btn btn-primary">
                    <i class="fas fa-undo me-2"></i>Tampilkan Semua Dokter
                </a>
                @endif
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
.doctor-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.doctor-card:hover {
    transform: translateY(-5px);
}

.doctor-card-inner {
    border-radius: 15px;
    overflow: hidden;
}

.card-img-wrapper {
    overflow: hidden;
}

.card-img-wrapper img {
    transition: transform 0.3s ease;
}

.doctor-card:hover .card-img-wrapper img {
    transform: scale(1.05);
}

.schedule-section {
    border-top: 1px solid #e9ecef;
    padding-top: 1rem;
}

.empty-state-icon {
    opacity: 0.5;
}

/* Search form styles */
.input-group-text {
    border: none;
}

.form-select, .form-control {
    border-radius: 8px;
}

/* Responsive design */
@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .doctor-card {
        margin-bottom: 1.5rem;
    }
    
    .input-group-lg > .form-control {
        font-size: 0.9rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const specializationSelect = document.getElementById('specializationSelect');

    // Clear search input
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
    });

    // Auto-submit when specialization changes
    specializationSelect.addEventListener('change', function() {
        searchForm.submit();
    });

    // Debounce search input
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length === 0 || this.value.length >= 3) {
                searchForm.submit();
            }
        }, 500);
    });

    // Enter key to submit form
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchForm.submit();
        }
    });

    // Show loading state during search
    searchForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        submitBtn.disabled = true;

        setTimeout(() => {
            submitBtn.innerHTML = originalHtml;
            submitBtn.disabled = false;
        }, 2000);
    });
});
</script>
@endsection