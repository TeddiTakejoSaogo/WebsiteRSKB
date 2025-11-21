@extends('layouts.app')

@section('title', 'Layanan')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Layanan Rumah Sakit</h1>
    
    <div class="row">
        @foreach($services as $service)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="{{ $service->icon_class }} fa-3x text-primary mb-3"></i>
                    <h4 class="card-title">{{ $service->name }}</h4>
                    <p class="card-text">{{ $service->description }}</p>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> {{ $service->operational_hours }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection