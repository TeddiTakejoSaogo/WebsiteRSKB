@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-5">Tentang Kami</h1>
            
            <!-- Sejarah -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-history text-primary"></i> Sejarah</h3>
                    <p class="card-text">
                        @if(isset($hospitalProfile))
                            {{ $hospitalProfile->history }}
                        @else
                            Rumah Sakit Kami didirikan pada tahun 1990 dengan misi memberikan pelayanan kesehatan 
                            yang berkualitas kepada masyarakat. Selama lebih dari 30 tahun, kami telah berkembang 
                            menjadi rumah sakit terpercaya dengan fasilitas modern dan tim medis yang profesional.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-eye text-primary"></i> Visi</h4>
                            <p class="card-text">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->vision }}
                                @else
                                    Menjadi rumah sakit pilihan utama masyarakat dengan pelayanan kesehatan 
                                    berkualitas internasional yang terjangkau.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-bullseye text-primary"></i> Misi</h4>
                            @if(isset($hospitalProfile))
                                @php
                                    $missions = is_array($hospitalProfile->mission) 
                                        ? $hospitalProfile->mission 
                                        : explode("\n", $hospitalProfile->mission);
                                @endphp
                                <ul>
                                    @foreach(array_filter($missions) as $mission)
                                        <li>{{ $mission }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <ul>
                                    <li>Memberikan pelayanan kesehatan yang bermutu</li>
                                    <li>Mengutamakan kepuasan pasien</li>
                                    <li>Mengembangkan sumber daya manusia yang profesional</li>
                                    <li>Memiliki teknologi medis yang terkini</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lokasi & Kontak -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-map-marker-alt text-primary"></i> Lokasi & Kontak</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Alamat</h5>
                            <p>
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->address }}
                                @else
                                    Jl. Kesehatan No. 123<br>Jakarta Pusat 10110
                                @endif
                            </p>
                            
                            <h5>Telepon</h5>
                            <p>
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->phone }}
                                @else
                                    (021) 123-4567
                                @endif
                            </p>
                            
                            <h5>Email</h5>
                            <p>
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->email }}
                                @else
                                    info@rumahsakit.com
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Jam Operasional</h5>
                            <ul class="list-unstyled">
                                <li>Senin - Jumat: 07:00 - 21:00</li>
                                <li>Sabtu: 07:00 - 18:00</li>
                                <li>Minggu: 08:00 - 16:00</li>
                                <li><strong>IGD: 24 Jam</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection