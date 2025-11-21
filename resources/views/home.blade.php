@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">Selamat Datang di Rumah Sakit Khusus Bedah</h1>
            <h1 class="display-4 mb-4">ROPANASURI</h1>
            <a href="{{ route('services') }}" class="btn btn-primary btn-lg me-2">Lihat Layanan</a>
            <a href="{{ route('doctors') }}" class="btn btn-outline-light btn-lg">Dokter Kami</a>
        </div>
    </section>

    <!-- Quick Info Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-user-md fa-3x text-primary mb-3"></i>
                            <h4>Dokter Profesional</h4>
                            <p>Tim dokter spesialis berpengalaman siap melayani Anda</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-procedures fa-3x text-primary mb-3"></i>
                            <h4>Fasilitas Lengkap</h4>
                            <p>Fasilitas medis modern dan lengkap untuk perawatan optimal</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                            <h4>24 Jam</h4>
                            <p>Layanan IGD dan rawat inap tersedia 24 jam non-stop</p>
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
                    <h2>Tentang Rumah Sakit Kami</h2>
                    <p>Rumah Sakit kami telah melayani masyarakat dengan dedikasi tinggi dalam memberikan pelayanan kesehatan yang berkualitas. Dengan tim medis yang profesional dan fasilitas yang lengkap, kami berkomitmen untuk memberikan perawatan terbaik bagi pasien.</p>
                    <a href="{{ route('about') }}" class="btn btn-primary">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>
@endsection