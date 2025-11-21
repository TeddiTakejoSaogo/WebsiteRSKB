@extends('admin.layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Artikel</h1>
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
                <form action="{{ route('admin.news.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Judul Artikel *</label>
                            <input type="text" name="title" class="form-control" 
                                   value="{{ old('title', $article->title) }}" required>
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kategori *</label>
                            <input type="text" name="category" class="form-control" 
                                   value="{{ old('category', $article->category) }}" required>
                            @error('category')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Artikel</label>
                        @if($article->image)
                        <div class="mb-2">
                            <img src="{{ $article->image_url }}" alt="Current image" 
                                 class="img-thumbnail" width="150">
                            <br>
                            <small class="text-muted">Gambar saat ini</small>
                        </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Artikel *</label>
                        <textarea name="content" class="form-control" rows="12" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-select" required>
                                <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
@endsection