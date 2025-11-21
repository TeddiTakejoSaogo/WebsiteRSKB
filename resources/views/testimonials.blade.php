@extends('layouts.app')

@section('title', 'Testimoni Pasien')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-5">Testimoni Pasien</h1>
            
            <!-- Notifikasi -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Berhasil!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Error!</h5>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Form Testimoni -->
            <div class="card shadow-sm mb-5">
                <div class="card-body">
                    <h4 class="card-title">Kirim Testimoni Anda</h4>
                    <p class="text-muted">Bagikan pengalaman Anda selama berobat di rumah sakit kami</p>
                    
                    <form action="{{ route('testimonials.store') }}" method="POST" id="testimonialForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="patient_name" class="form-control" 
                                       value="{{ old('patient_name') }}" 
                                       placeholder="Masukkan nama lengkap" 
                                       required>
                                @error('patient_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="patient_email" class="form-control" 
                                       value="{{ old('patient_email') }}" 
                                       placeholder="Masukkan email" 
                                       required>
                                @error('patient_email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating *</label>
                            <div class="rating-stars mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="rating" 
                                               id="rating{{ $i }}" value="{{ $i }}" 
                                               {{ old('rating') == $i ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="rating{{ $i }}">
                                            @for($j = 1; $j <= $i; $j++)
                                                ⭐
                                            @endfor
                                            ({{ $i }})
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan & Kesan *</label>
                            <textarea name="message" class="form-control" rows="5" 
                                      placeholder="Tuliskan pengalaman Anda selama berobat di rumah sakit kami..." 
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Minimal 10 karakter, maksimal 1000 karakter.
                                <span id="charCount" class="float-end">0/1000</span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Testimoni
                            </button>
                        </div>
                        
                        <small class="text-muted d-block mt-2 text-center">
                            <i class="fas fa-info-circle me-1"></i>
                            Testimoni akan ditampilkan setelah disetujui oleh admin
                        </small>
                    </form>
                </div>
            </div>

            <!-- Daftar Testimoni yang Disetujui -->
            <h3 class="mb-4">Testimoni Pasien</h3>
            
            @forelse($testimonials as $testimonial)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px;">
                            <span class="text-white fw-bold">
                                {{ substr($testimonial->patient_name, 0, 2) }}
                            </span>
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0">{{ $testimonial->patient_name }}</h5>
                            <small class="text-muted">{{ $testimonial->created_at->translatedFormat('d F Y') }}</small>
                        </div>
                    </div>
                    <p class="card-text">"{{ $testimonial->message }}"</p>
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"></i>
                        @endfor
                        <span class="text-muted ms-2">({{ $testimonial->rating }}/5)</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada testimoni yang disetujui</h5>
                <p class="text-muted">Jadilah yang pertama membagikan pengalaman Anda!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.rating-stars .form-check-input {
    margin-right: 0.3rem;
}
.rating-stars .form-check-label {
    cursor: pointer;
    padding: 0.3rem 0.5rem;
    border-radius: 5px;
    transition: all 0.2s ease;
}
.rating-stars .form-check-input:checked + .form-check-label {
    background-color: #e3f2fd;
    color: #1976d2;
}
.alert {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
}
.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('testimonialForm');
    const submitBtn = document.getElementById('submitBtn');
    const messageTextarea = document.querySelector('textarea[name="message"]');
    const charCount = document.getElementById('charCount');

    // Character count
    messageTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length + '/1000';
        
        if (length > 1000) {
            charCount.classList.add('text-danger');
        } else {
            charCount.classList.remove('text-danger');
        }
    });

    // Form validation and submission
    form.addEventListener('submit', function(e) {
        const message = messageTextarea.value.trim();
        
        if (message.length < 10) {
            e.preventDefault();
            alert('Pesan testimoni minimal 10 karakter.');
            return;
        }
        
        if (message.length > 1000) {
            e.preventDefault();
            alert('Pesan testimoni maksimal 1000 karakter.');
            return;
        }

        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Mengirim...';
        submitBtn.disabled = true;
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Rating stars interaction
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            ratingInputs.forEach(i => {
                i.parentElement.classList.remove('active');
            });
            this.parentElement.classList.add('active');
        });
    });
});
</script>
@endsection