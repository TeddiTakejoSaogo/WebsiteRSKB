@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Kelola Testimoni Pasien</h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Testimoni
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pendingTestimonials->count() + $approvedTestimonials->total() + $rejectedTestimonials->total() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Menunggu Persetujuan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTestimonials->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Disetujui
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvedTestimonials->total() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ditolak
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejectedTestimonials->total() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs mb-4" id="testimonialTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
            <i class="fas fa-clock me-2"></i>Menunggu
            <span class="badge bg-warning ms-2">{{ $pendingTestimonials->count() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">
            <i class="fas fa-check-circle me-2"></i>Disetujui
            <span class="badge bg-success ms-2">{{ $approvedTestimonials->total() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
            <i class="fas fa-times-circle me-2"></i>Ditolak
            <span class="badge bg-danger ms-2">{{ $rejectedTestimonials->total() }}</span>
        </button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="testimonialTabsContent">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Pending Testimonials Tab -->
    <div class="tab-pane fade show active" id="pending" role="tabpanel">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-clock me-2"></i> Testimoni Menunggu Persetujuan
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($pendingTestimonials as $testimonial)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">{{ $testimonial->patient_name }}</h6>
                                    <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-2">{{ $testimonial->message }}</p>
                                <div class="text-warning small mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                    @endfor
                                    <span class="text-muted ms-2">({{ $testimonial->rating }}/5)</span>
                                </div>
                                <small class="text-muted">Email: {{ $testimonial->patient_email }}</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Hapus testimoni ini secara permanen?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted py-4">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <p>Tidak ada testimoni yang menunggu persetujuan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Approved Testimonials Tab -->
    <div class="tab-pane fade" id="approved" role="tabpanel">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-check-circle me-2"></i> Testimoni Disetujui
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($approvedTestimonials as $testimonial)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">{{ $testimonial->patient_name }}</h6>
                                    <div>
                                        <span class="badge bg-success">Disetujui</span>
                                        <small class="text-muted ms-2">{{ $testimonial->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="mb-2">{{ $testimonial->message }}</p>
                                <div class="text-warning small mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                    @endfor
                                    <span class="text-muted ms-2">({{ $testimonial->rating }}/5)</span>
                                </div>
                                <small class="text-muted">Email: {{ $testimonial->patient_email }}</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-undo"></i> Batalkan Persetujuan
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Hapus testimoni ini secara permanen?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted py-4">
                        <i class="fas fa-comments fa-2x mb-2"></i>
                        <p>Belum ada testimoni yang disetujui</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination for Approved -->
                @if($approvedTestimonials->hasPages())
                <div class="mt-4">
                    {{ $approvedTestimonials->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Rejected Testimonials Tab -->
    <div class="tab-pane fade" id="rejected" role="tabpanel">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-times-circle me-2"></i> Testimoni Ditolak
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Testimoni yang ditolak tetap disimpan dan dapat dikembalikan ke status pending jika diperlukan.
                </div>
                
                <div class="list-group">
                    @forelse($rejectedTestimonials as $testimonial)
                    <div class="list-group-item border-left border-danger border-3">
                        <div class="d-flex w-100 justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0 text-danger">
                                        <i class="fas fa-ban me-2"></i>{{ $testimonial->patient_name }}
                                    </h6>
                                    <div>
                                        <span class="badge bg-danger">Ditolak</span>
                                        <small class="text-muted ms-2">{{ $testimonial->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="mb-2 text-muted">{{ $testimonial->message }}</p>
                                <div class="text-warning small mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                                    @endfor
                                    <span class="text-muted ms-2">({{ $testimonial->rating }}/5)</span>
                                </div>
                                <small class="text-muted">Email: {{ $testimonial->patient_email }}</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <form action="{{ route('admin.testimonials.restore', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-redo"></i> Kembalikan ke Pending
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Hapus testimoni ini secara permanen?')">
                                    <i class="fas fa-trash"></i> Hapus Permanen
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted py-4">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <p>Tidak ada testimoni yang ditolak</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination for Rejected -->
                @if($rejectedTestimonials->hasPages())
                <div class="mt-4">
                    {{ $rejectedTestimonials->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 1rem 1.5rem;
}

.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-bottom: 3px solid #0d6efd;
}

.nav-tabs .nav-link:hover {
    border: none;
    color: #0d6efd;
}

.list-group-item {
    border: 1px solid rgba(0,0,0,.125);
    margin-bottom: 0.5rem;
    border-radius: 0.375rem !important;
}

.border-left-danger {
    border-left: 4px solid #dc3545 !important;
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,.125);
}

/* Custom badge styles */
.badge {
    font-size: 0.7em;
    padding: 0.35em 0.65em;
}

/* Hover effects */
.list-group-item:hover {
    background-color: #f8f9fa;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .nav-tabs .nav-link {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    
    .btn-sm {
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-activate tab from URL hash
    const urlHash = window.location.hash;
    if (urlHash) {
        const triggerTab = document.querySelector(`[data-bs-target="${urlHash}"]`);
        if (triggerTab) {
            new bootstrap.Tab(triggerTab).show();
        }
    }

    // Update URL hash when tab changes
    const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', function (e) {
            window.location.hash = e.target.getAttribute('data-bs-target');
        });
    });

    // Auto-scroll to alerts
    const alert = document.querySelector('.alert');
    if (alert) {
        alert.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
});
</script>
@endsection