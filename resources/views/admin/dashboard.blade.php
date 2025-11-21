@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">Dashboard Admin</h1>
    </div>
</div>

<div class="row">
    <!-- Statistik Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Dokter
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDoctors }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-md fa-2x text-gray-300"></i>
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
                            Layanan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalServices }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-procedures fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Testimoni Baru
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTestimonials }}</div>
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
                            Artikel
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalArticles }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru (7 Hari Terakhir)</h6>
            </div>
            <div class="card-body">
                @if($recentActivities->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($recentActivities as $activity)
                    <a href="{{ $activity['url'] }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas {{ $activity['icon'] }} text-{{ $activity['color'] }} me-3 fa-lg"></i>
                                <div>
                                    <h6 class="mb-1">{{ $activity['message'] }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $activity['time']->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <span class="badge bg-{{ $activity['color'] }} rounded-pill">
                                {{ ucfirst($activity['type']) }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada aktivitas dalam 7 hari terakhir</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Data -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-user-md"></i> Dokter
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.testimonials') }}" class="btn btn-success btn-block">
                            <i class="fas fa-comments"></i> Testimoni
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.news.create') }}" class="btn btn-info btn-block">
                            <i class="fas fa-newspaper"></i> Berita
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-images"></i> Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Testimonials -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Testimoni Terbaru</h6>
            </div>
            <div class="card-body">
                @if($recentTestimonials->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($recentTestimonials as $testimonial)
                    <div class="list-group-item px-0">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $testimonial->patient_name }}</h6>
                            <span class="badge bg-{{ $testimonial->status === 'approved' ? 'success' : 'warning' }}">
                                {{ $testimonial->status === 'approved' ? 'Approved' : 'Pending' }}
                            </span>
                        </div>
                        <p class="mb-1 small">{{ Str::limit($testimonial->message, 60) }}</p>
                        <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center mb-0">Belum ada testimoni</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Doctors & Articles -->
<div class="row mt-4">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dokter Terbaru</h6>
            </div>
            <div class="card-body">
                @if($recentDoctors->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($recentDoctors as $doctor)
                    <div class="list-group-item px-0">
                        <div class="d-flex align-items-center">
                            <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/40x40?text=DR' }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="rounded-circle me-3" width="40" height="40" style="object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $doctor->name }}</h6>
                                <small class="text-muted">{{ $doctor->specialization }}</small>
                            </div>
                            <span class="badge bg-{{ $doctor->status === 'active' ? 'success' : 'secondary' }}">
                                {{ $doctor->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center mb-0">Belum ada data dokter</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Terbaru</h6>
            </div>
            <div class="card-body">
                @if($recentArticles->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($recentArticles as $article)
                    <div class="list-group-item px-0">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ Str::limit($article->title, 50) }}</h6>
                            <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'secondary' }}">
                                {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        <p class="mb-1 small text-muted">{{ $article->category }}</p>
                        <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted text-center mb-0">Belum ada artikel</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection