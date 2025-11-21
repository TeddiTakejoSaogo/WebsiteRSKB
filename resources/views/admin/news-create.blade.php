@extends('admin.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Artikel Baru</h1>
            <a href="{{ route('admin.news') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Judul Artikel *</label>
                            <input type="text" name="title" class="form-control" 
                                   value="{{ old('title') }}" placeholder="Masukkan judul artikel" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="category" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Kesehatan Umum" {{ old('category') == 'Kesehatan Umum' ? 'selected' : '' }}>Kesehatan Umum</option>
                                <option value="Kesehatan Anak" {{ old('category') == 'Kesehatan Anak' ? 'selected' : '' }}>Kesehatan Anak</option>
                                <option value="Kesehatan Jantung" {{ old('category') == 'Kesehatan Jantung' ? 'selected' : '' }}>Kesehatan Jantung</option>
                                <option value="Penyakit Dalam" {{ old('category') == 'Penyakit Dalam' ? 'selected' : '' }}>Penyakit Dalam</option>
                                <option value="Gizi & Diet" {{ old('category') == 'Gizi & Diet' ? 'selected' : '' }}>Gizi & Diet</option>
                                <option value="Kesehatan Mental" {{ old('category') == 'Kesehatan Mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                            </select>
                            @error('category')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Artikel</label>
                        <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <img id="preview" class="img-thumbnail" width="200">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Artikel *</label>
                        <textarea name="content" id="content" class="form-control" rows="12" 
                                  placeholder="Tulis konten artikel di sini..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include TinyMCE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // TinyMCE Editor
    tinymce.init({
        selector: '#content',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        height: 400,
        menubar: false,
        statusbar: false,
        content_style: `
            body { 
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
                font-size: 14px; 
                line-height: 1.6;
            }
            img { max-width: 100%; height: auto; }
        `,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    // Form submission handling
    const form = document.getElementById('articleForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection