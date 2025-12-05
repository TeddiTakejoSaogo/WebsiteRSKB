@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 mb-3">Kontak Kami</h1>
            <p class="lead">Hubungi kami untuk informasi lebih lanjut atau janji temu dengan dokter</p>
        </div>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                    </div>
                    <h5>Alamat</h5>
                    <p class="text-muted">
                       Jl. Aur No.8 Ujung Gurun <br>
                    Kota Padang, Sumatera Barat 25114
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-phone fa-2x text-white"></i>
                    </div>
                    <h5>Telepon</h5>
                    <p class="text-muted">
                        (0751) 31938<br>
                        (0751) 33854<br>
                        <strong>IGD: 119</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-envelope fa-2x text-white"></i>
                    </div>
                    <h5>Email & Media Sosial</h5>
                    <p class="text-muted">
                        rskbropanasuripadang@gmail.com<br>
                        <div class="mt-2">
                            <a href="#" class="text-primary me-3"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="#" class="text-info me-3"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="text-danger me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-success"><i class="fab fa-whatsapp fa-lg"></i></a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
            <!-- Contact Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                    value="{{ old('name') }}" required>
                                <div class="invalid-feedback">Harap isi nama lengkap</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                    value="{{ old('email') }}" required>
                                <div class="invalid-feedback">Harap isi email yang valid</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                    value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Subjek *</label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="">Pilih Subjek</option>
                                    <option value="Janji Temu Dokter" {{ old('subject') == 'JTM' ? 'selected' : '' }}>Janji Temu Dokter</option>
                                    <option value="Informasi Layanan" {{ old('subject') == 'IL'? 'selected' : '' }}>Informasi Layanan</option>
                                    <option value="Keluhan & Saran" {{ old('subject') == 'Kesan' ? 'selected' : '' }}>Keluhan & Saran</option>
                                    <option value="Kemitraan" {{ old('subject') == 'Kemitraan' ? 'selected' : '' }}>Kemitraan</option>
                                    <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <div class="invalid-feedback">Harap pilih subjek</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" 
                                    placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                            <div class="invalid-feedback">Harap isi pesan</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Operating Hours -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Jam Operasional</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-2">
                            <span>Senin - Jumat</span>
                            <span class="fw-bold">07:00 - 21:00</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Sabtu</span>
                            <span class="fw-bold">07:00 - 18:00</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Minggu</span>
                            <span class="fw-bold">08:00 - 16:00</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2 pt-2 border-top">
                            <span><strong>IGD</strong></span>
                            <span class="fw-bold text-danger">24 Jam</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span><strong>Apotek</strong></span>
                            <span class="fw-bold">24 Jam</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-ambulance me-2"></i>Darurat</h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-ambulance fa-3x text-danger mb-3"></i>
                        <h4 class="text-danger">119</h4>
                        <p class="text-muted">Layanan Gawat Darurat 24 Jam</p>
                    </div>
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-phone me-2"></i>Panggil Ambulans
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <!-- OpenStreetMap Section -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-map me-2"></i>Lokasi Kami</h5>
            </div>
            <div class="card-body p-0">
                <!-- OpenStreetMap Embed -->
                <div class="map-container">
                    <iframe 
                        src="https://www.openstreetmap.org/export/embed.html?bbox=100.35746276378633%2C-0.9366768575757999%2C100.36100327968599%2C-0.9340593704145732&amp;layer=mapnik"
                        width="100%" 
                        height="400" 
                        style="border: 1px solid #ccc">
                    </iframe>
                </div>
                
                <!-- Map Controls -->
                <div class="p-3 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Alamat Lengkap:</h6>
                            <p class="mb-2">
                                @if(isset($hospitalProfile))
                                    {{ $hospitalProfile->address }}
                                @else
                                    Jl. Aur No.8, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25142
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="https://www.openstreetmap.org/?#map=19/-0.935368/100.359233" 
                               class="btn btn-primary" target="_blank">
                                <i class="fas fa-directions me-2"></i>Buka di Peta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Pertanyaan Umum</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq1">
                                    Bagaimana cara membuat janji temu dengan dokter?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat membuat janji temu melalui telepon (0751) 31938, 
                                    melalui form di website, atau datang langsung ke rumah sakit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq2">
                                    Apakah rumah sakit melayani BPJS?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, kami melayani pasien BPJS. Silakan bawa kartu BPJS dan surat rujukan 
                                    dari faskes pertama.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#faq3">
                                    Berapa lama waktu tunggu untuk IGD?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Waktu tunggu di IGD tergantung tingkat kegawatan. Pasien dengan kondisi 
                                    gawat darurat akan ditangani segera.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.map-container {
    position: relative;
    overflow: hidden;
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: var(--primary-color);
}

.invalid-feedback {
    display: none;
}

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic form validation
        if (!contactForm.checkValidity()) {
            e.stopPropagation();
            contactForm.classList.add('was-validated');
            return;
        }
        
        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        submitBtn.disabled = true;
        
        // Prepare form data
        const formData = new FormData(contactForm);
        
        // Send AJAX request
        fetch('{{ route("contact.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 5000,
                    timerProgressBar: true,
                    didClose: () => {
                        // Reset form
                        contactForm.reset();
                        contactForm.classList.remove('was-validated');
                        // Scroll to top of form
                        contactForm.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            } else {
                // Show error notification
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Coba Lagi'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
        })
        .finally(() => {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });

    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,4}/g).join('-');
            }
            e.target.value = value;
        });
    }

    // Real-time validation
    const inputs = contactForm.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (!this.checkValidity()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
});
</script>

<style>
.is-valid {
    border-color: #198754 !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.swal2-popup {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Smooth transition for validation states */
.form-control {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>

@endsection