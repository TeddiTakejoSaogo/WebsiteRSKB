@extends('layouts.app')

@section('title', 'Dokter')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Dokter Spesialis Kami</h1>
    
    <div class="row">
        @foreach($doctors as $doctor)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                     class="card-img-top" alt="{{ $doctor->name }}" style="height: 250px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $doctor->name }}</h5>
                    <p class="card-text text-muted">{{ $doctor->specialization }}</p>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-graduation-cap"></i> {{ $doctor->education }}
                        </small>
                    </p>
                    @if($doctor->description)
                    <p class="card-text small">{{ Str::limit($doctor->description, 100) }}</p>
                    @endif
                    
                    <!-- Jadwal Praktik -->
                    <div class="jadwal-praktik mt-3">
                        <h6 class="text-primary">
                            <i class="fas fa-calendar-alt me-1"></i> Jadwal Praktik:
                        </h6>
                        <ul class="list-unstyled small">
                            @foreach($doctor->getActiveSchedules() as $schedule)
                            <li class="mb-1">
                                <i class="fas fa-clock text-success me-1"></i>
                                {{ $schedule->simple_schedule }}
                            </li>
                            @endforeach
                            
                            @if($doctor->schedules->isEmpty())
                            <li class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Jadwal belum tersedia
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @if($doctors->isEmpty())
        <div class="col-12 text-center py-5">
            <i class="fas fa-user-md fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada data dokter.</p>
        </div>
        @endif
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.jadwal-praktik {
    border-top: 1px solid #e9ecef;
    padding-top: 15px;
}

.jadwal-praktik h6 {
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.jadwal-praktik li {
    font-size: 0.8rem;
    line-height: 1.4;
}
</style>
@endsection