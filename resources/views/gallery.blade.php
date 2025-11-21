@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Galeri 
        @if(isset($hospitalProfile))
            {{ $hospitalProfile->name }}
        @else
            Rumah Sakit
        @endif
    </h1>
    <div class="row">
        @foreach($galleries as $gallery)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" 
                     alt="{{ $gallery->title }}" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $gallery->title }}</h6>
                    <span class="badge bg-secondary">{{ $gallery->type_name }}</span>
                    @if($gallery->description)
                    <p class="card-text small mt-2">{{ $gallery->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($galleries->isEmpty())
    <div class="text-center py-5">
        <i class="fas fa-images fa-3x text-muted mb-3"></i>
        <p class="text-muted">Belum ada foto di galeri.</p>
    </div>
    @endif
</div>
@endsection