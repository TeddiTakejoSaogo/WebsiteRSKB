@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Layanan Baru</h1>
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
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Layanan *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name') }}" placeholder="Contoh: Poli Umum" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon *</label>
                            <select name="icon" class="form-select" required>
                                <option value="">Pilih Icon</option>
                                <option value="stethoscope" {{ old('icon') == 'stethoscope' ? 'selected' : '' }}>Stethoscope</option>
                                <option value="tooth" {{ old('icon') == 'tooth' ? 'selected' : '' }}>Gigi</option>
                                <option value="baby" {{ old('icon') == 'baby' ? 'selected' : '' }}>Bayi</option>
                                <option value="syringe" {{ old('icon') == 'syringe' ? 'selected' : '' }}>Suntik</option>
                                <option value="ambulance" {{ old('icon') == 'ambulance' ? 'selected' : '' }}>Ambulance</option>
                                <option value="flask" {{ old('icon') == 'flask' ? 'selected' : '' }}>Laboratorium</option>
                                <option value="heart" {{ old('icon') == 'heart' ? 'selected' : '' }}>Jantung</option>
                                <option value="eye" {{ old('icon') == 'eye' ? 'selected' : '' }}>Mata</option>
                            </select>
                            @error('icon')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea name="description" class="form-control" rows="4" 
                                  placeholder="Deskripsi layanan..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Operasional *</label>
                        <input type="text" name="operational_hours" class="form-control" 
                               value="{{ old('operational_hours') }}" 
                               placeholder="Contoh: Senin - Minggu: 07:00 - 21:00" required>
                        @error('operational_hours')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection