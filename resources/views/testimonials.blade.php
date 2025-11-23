@extends('layouts.app')

@section('title', 'Testimoni Pasien')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">Testimoni Pasien</h1>
            <p class="lead text-muted">Pengalaman nyata dari pasien yang telah merasakan pelayanan kami</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card bg-gradient-primary text-white shadow-lg border-0">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="card-title mb-2">Bagikan Pengalaman Anda</h5>
                                    <p class="card-text mb-0">Bantu kami menjadi lebih baik dengan berbagi pengalaman Anda</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#testimonialModal">
                                        <i class="fas fa-edit me-2"></i>Tulis Testimoni
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x me-3"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Berhasil!</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Testimonials Grid -->
    <div class="row">
        @forelse($testimonials as $testimonial)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card testimonial-card h-100 shadow-sm border-0">
                <div class="card-body position-relative">
                    <!-- Rating Stars -->
                    <div class="rating-stars mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-light' }}"></i>
                        @endfor
                    </div>
                    
                    <!-- Testimonial Text -->
                    <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                    
                    <!-- Patient Info -->
                    <div class="d-flex align-items-center mt-4">
                        <div class="patient-avatar bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                            <span class="text-white fw-bold">{{ substr($testimonial->patient_name, 0, 2) }}</span>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $testimonial->patient_name }}</h6>
                            <small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    
                    <!-- Decorative Quote Icon -->
                    <div class="quote-icon">
                        <i class="fas fa-quote-right text-primary opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12">
            <div class="text-center py-5">
                <div class="empty-state-icon mb-4">
                    <i class="fas fa-comments fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Belum Ada Testimoni</h4>
                <p class="text-muted mb-4">Jadilah yang pertama membagikan pengalaman Anda</p>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#testimonialModal">
                    <i class="fas fa-plus me-2"></i>Tulis Testimoni Pertama
                </button>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($testimonials->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Testimoni pagination">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($testimonials->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">‹</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->previousPageUrl() }}" rel="prev">‹</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                        @if ($page == $testimonials->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($testimonials->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->nextPageUrl() }}" rel="next">›</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">›</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    @endif

    <!-- Stats Section -->
    <div class="row mt-5 pt-5">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body py-4">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="stat-number text-primary fw-bold display-6">{{ $testimonials->total() }}</div>
                            <div class="stat-label text-muted">Total Testimoni</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-number text-success fw-bold display-6">4.8</div>
                            <div class="stat-label text-muted">Rating Rata-rata</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-number text-info fw-bold display-6">98%</div>
                            <div class="stat-label text-muted">Kepuasan Pasien</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="stat-number text-warning fw-bold display-6">24/7</div>
                            <div class="stat-label text-muted">Layanan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial Modal -->
<div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="testimonialModalLabel">
                    <i class="fas fa-edit me-2"></i>Bagikan Pengalaman Anda
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('testimonials.store') }}" method="POST" id="testimonialForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="patient_name" class="form-control" 
                                   value="{{ old('patient_name') }}" required>
                            @error('patient_name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="patient_email" class="form-control" 
                                   value="{{ old('patient_email') }}" required>
                            @error('patient_email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="rating-input mb-3">
                            <div class="d-flex justify-content-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                           {{ old('rating') == $i ? 'checked' : '' }} class="d-none">
                                    <label for="star{{ $i }}" class="star-label me-2">
                                        <i class="far fa-star fa-2x"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        @error('rating')
                            <div class="text-danger small text-center">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan & Kesan *</label>
                        <textarea name="message" class="form-control" rows="5" 
                                  placeholder="Bagikan pengalaman Anda selama berobat di rumah sakit kami..." 
                                  required>{{ old('message') }}</textarea>
                        <small class="text-muted">Minimal 10 karakter, maksimal 500 karakter</small>
                        @error('message')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-2"></i>
                            Testimoni Anda akan ditampilkan. Terima kasih atas kontribusinya!
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="testimonialForm" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Kirim Testimoni
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.testimonial-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.testimonial-text {
    font-style: italic;
    line-height: 1.6;
    color: #555;
    margin-bottom: 0;
}

.patient-avatar {
    width: 50px;
    height: 50px;
    font-size: 1.1rem;
}

.rating-stars {
    font-size: 1.1rem;
}

.quote-icon {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 3rem;
    opacity: 0.1;
}

.empty-state-icon {
    opacity: 0.5;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #098652 0%, #108379 100%) !important;
}

/* Rating Input Styles */
.rating-input .star-label {
    cursor: pointer;
    transition: color 0.2s ease;
}

.rating-input .star-label:hover {
    color: #ffc107 !important;
}

.rating-input input:checked + .star-label i {
    color: #ffc107 !important;
}

.rating-input input:checked ~ .star-label i {
    color: #e4e5e9 !important;
}

.rating-input .star-label i {
    color: #e4e5e9;
    transition: color 0.2s ease;
}

.rating-input:hover .star-label i {
    color: #ffc107 !important;
}

.rating-input .star-label:hover ~ .star-label i {
    color: #e4e5e9 !important;
}

/* Pagination Styles */
.pagination .page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: none;
    color: #667eea;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #eef0ef 0%, #ffffff 100%);
    border: none;
}

.pagination .page-link:hover {
    background-color: #f8f9fa;
    color: #764ba2;
}

/* Responsive Design */
@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .testimonial-card {
        margin-bottom: 1.5rem;
    }
    
    .stat-number {
        font-size: 2.5rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rating star interaction
    const starInputs = document.querySelectorAll('.rating-input input');
    const starLabels = document.querySelectorAll('.star-label');
    
    starLabels.forEach((label, index) => {
        label.addEventListener('mouseenter', function() {
            highlightStars(index);
        });
        
        label.addEventListener('click', function() {
            // Remove all checked
            starInputs.forEach(input => input.checked = false);
            // Check the clicked one and all before it
            for (let i = 0; i <= index; i++) {
                starInputs[i].checked = true;
            }
        });
    });
    
    // Reset stars when mouse leaves rating area
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const checkedInput = document.querySelector('.rating-input input:checked');
        if (checkedInput) {
            const checkedIndex = Array.from(starInputs).indexOf(checkedInput);
            highlightStars(checkedIndex);
        } else {
            highlightStars(-1);
        }
    });
    
    function highlightStars(upToIndex) {
        starLabels.forEach((label, index) => {
            const icon = label.querySelector('i');
            if (index <= upToIndex) {
                icon.className = 'fas fa-star fa-2x text-warning';
            } else {
                icon.className = 'far fa-star fa-2x text-light';
            }
        });
    }
    
    // Auto-show modal if there are form errors
    @if($errors->any())
        const modal = new bootstrap.Modal(document.getElementById('testimonialModal'));
        modal.show();
    @endif
    
    // Character counter for message
    const messageTextarea = document.querySelector('textarea[name="message"]');
    if (messageTextarea) {
        const charCount = document.createElement('div');
        charCount.className = 'text-muted small mt-1 text-end';
        messageTextarea.parentNode.appendChild(charCount);
        
        messageTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
            
            if (length > 500) {
                charCount.className = 'text-danger small mt-1 text-end';
            } else if (length < 10) {
                charCount.className = 'text-warning small mt-1 text-end';
            } else {
                charCount.className = 'text-success small mt-1 text-end';
            }
        });
        
        // Trigger initial count
        messageTextarea.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection