@extends('admin.layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Kelola Testimoni Pasien</h1>
    </div>
</div>

<div class="row">
    <!-- Testimoni Menunggu Persetujuan -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-clock"></i> Menunggu Persetujuan ({{ $pendingTestimonials->count() }})
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($pendingTestimonials as $testimonial)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $testimonial->patient_name }}</h6>
                            <small>{{ $testimonial->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($testimonial->message, 100) }}</p>
                        <div class="text-warning small mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                            @endfor
                        </div>
                        <div class="mt-2">
                            <form action="{{ route('admin.testimonials.approve', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('admin.testimonials.reject', $testimonial->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <p>Tidak ada testimoni yang menunggu persetujuan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni Disetujui -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-check-circle"></i> Testimoni Disetujui ({{ $approvedTestimonials->count() }})
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse($approvedTestimonials as $testimonial)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $testimonial->patient_name }}</h6>
                            <small>{{ $testimonial->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $testimonial->message }}</p>
                        <div class="text-warning small mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                            @endfor
                        </div>
                        <small class="text-muted">Disetujui oleh Admin</small>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline float-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                    onclick="return confirm('Hapus testimoni ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted">
                        <i class="fas fa-comments fa-2x mb-2"></i>
                        <p>Belum ada testimoni yang disetujui</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Testimoni -->
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Testimoni
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pendingTestimonials->count() + $approvedTestimonials->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Disetujui
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvedTestimonials->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Menunggu
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
</div>
@endsection