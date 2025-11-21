@extends('admin.layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Layanan</h1>
            <a href="{{ route('admin.services') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Layanan *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', $service->name) }}" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon *</label>
                            <select name="icon" class="form-select" required>
                                <option value="">Pilih Icon</option>
                                <option value="stethoscope" {{ $service->icon == 'stethoscope' ? 'selected' : '' }}>Stethoscope</option>
                                <option value="tooth" {{ $service->icon == 'tooth' ? 'selected' : '' }}>Gigi</option>
                                <option value="baby" {{ $service->icon == 'baby' ? 'selected' : '' }}>Bayi</option>
                                <option value="syringe" {{ $service->icon == 'syringe' ? 'selected' : '' }}>Suntik</option>
                                <option value="ambulance" {{ $service->icon == 'ambulance' ? 'selected' : '' }}>Ambulance</option>
                                <option value="flask" {{ $service->icon == 'flask' ? 'selected' : '' }}>Laboratorium</option>
                                <option value="heart" {{ $service->icon == 'heart' ? 'selected' : '' }}>Jantung</option>
                                <option value="eye" {{ $service->icon == 'eye' ? 'selected' : '' }}>Mata</option>
                            </select>
                            @error('icon')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Operasional *</label>
                        <input type="text" name="operational_hours" class="form-control" 
                               value="{{ old('operational_hours', $service->operational_hours) }}" required>
                        @error('operational_hours')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection