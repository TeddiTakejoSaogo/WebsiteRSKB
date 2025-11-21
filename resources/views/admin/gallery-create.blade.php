@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Foto ke Galeri</h1>
            <a href="{{ route('admin.gallery') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Foto *</label>
                            <input type="text" name="title" class="form-control" 
                                   value="{{ old('title') }}" placeholder="Masukkan judul foto" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="facility" {{ old('type') == 'facility' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="activity" {{ old('type') == 'activity' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Acara</option>
                            </select>
                            @error('type')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" 
                                  placeholder="Deskripsi singkat tentang foto...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Foto *</label>
                        <input type="file" name="images[]" id="imageInput" class="form-control" 
                               accept="image/*" multiple required>
                        <small class="text-muted">Anda bisa memilih multiple file (tekan Ctrl untuk memilih banyak). Format: JPG, PNG, GIF. Max: 2MB per file</small>
                        @error('images')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        
                        <div id="imagePreviews" class="row mt-3"></div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const imagePreviews = document.getElementById('imagePreviews');
    const form = document.getElementById('galleryForm');
    const submitBtn = document.getElementById('submitBtn');

    // Multiple image preview
    imageInput.addEventListener('change', function() {
        imagePreviews.innerHTML = '';
        const files = this.files;
        
        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 mb-2';
                        col.innerHTML = `
                            <div class="card">
                                <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <small class="text-muted">${file.name}</small>
                                </div>
                            </div>
                        `;
                        imagePreviews.appendChild(col);
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    });

    // Form submission handling
    form.addEventListener('submit', function(e) {
        const files = imageInput.files;
        if (files.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu foto!');
            return;
        }
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengupload...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection