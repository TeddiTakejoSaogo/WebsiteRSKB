@extends('admin.layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Tambah Data Dokter</h1>
            <a href="{{ route('admin.doctors') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" id="doctorForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dokter *</label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name') }}" placeholder="Dr. Nama Lengkap, Spesialisasi" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spesialisasi *</label>
                            <input type="text" name="specialization" class="form-control" 
                                   value="{{ old('specialization') }}" placeholder="Contoh: Spesialis Anak" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pendidikan *</label>
                            <input type="text" name="education" class="form-control" 
                                   value="{{ old('education') }}" placeholder="Contoh: Universitas Indonesia" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengalaman</label>
                            <input type="text" name="experience" class="form-control" 
                                   value="{{ old('experience') }}" placeholder="Contoh: 10 tahun">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Dokter</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        <div id="photoPreview" class="mt-2" style="display: none;">
                            <img id="previewImage" class="img-thumbnail" width="150">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" 
                                  placeholder="Deskripsi singkat tentang dokter...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Jadwal Praktek -->
                    <div class="mb-3">
                        <label class="form-label">Jadwal Praktek *</label>
                        <div id="schedules-container">
                            <!-- Schedule item template untuk create -->
                            <div class="schedule-item row mb-2">
                                <div class="col-md-4">
                                    <select name="schedules[0][day]" class="form-select" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="monday">Senin</option>
                                        <option value="tuesday">Selasa</option>
                                        <option value="wednesday">Rabu</option>
                                        <option value="thursday">Kamis</option>
                                        <option value="friday">Jumat</option>
                                        <option value="saturday">Sabtu</option>
                                        <option value="sunday">Minggu</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="schedules[0][start_time]" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="time" name="schedules[0][end_time]" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-schedule" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-schedule">
                            <i class="fas fa-plus"></i> Tambah Jadwal
                        </button>
                        <small class="text-muted d-block mt-1">Minimal 1 jadwal praktek harus diisi</small>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Dokter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('doctorForm');
    const submitBtn = document.getElementById('submitBtn');
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');

    let scheduleCount = 1; // Mulai dari 1 karena sudah ada 1 jadwal default
    
    // Photo preview
    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                photoPreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            photoPreview.style.display = 'none';
        }
    });

    // Add schedule functionality
    document.getElementById('add-schedule').addEventListener('click', function() {
        const container = document.getElementById('schedules-container');
        
        const newSchedule = document.createElement('div');
        newSchedule.className = 'schedule-item row mb-2';
        newSchedule.innerHTML = `
            <div class="col-md-4">
                <select name="schedules[${scheduleCount}][day]" class="form-select" required>
                    <option value="">Pilih Hari</option>
                    <option value="monday">Senin</option>
                    <option value="tuesday">Selasa</option>
                    <option value="wednesday">Rabu</option>
                    <option value="thursday">Kamis</option>
                    <option value="friday">Jumat</option>
                    <option value="saturday">Sabtu</option>
                    <option value="sunday">Minggu</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="time" name="schedules[${scheduleCount}][start_time]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="time" name="schedules[${scheduleCount}][end_time]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-schedule">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newSchedule);
        
        scheduleCount++;
        
        // Show remove buttons untuk semua jadwal
        document.querySelectorAll('.remove-schedule').forEach(btn => {
            btn.style.display = 'block';
        });
    });
    
    // Remove schedule functionality
    document.getElementById('schedules-container').addEventListener('click', function(e) {
        if (e.target.closest('.remove-schedule')) {
            const scheduleItems = document.querySelectorAll('.schedule-item');
            if (scheduleItems.length > 1) {
                e.target.closest('.schedule-item').remove();
                
                // Reindex schedules
                const remainingSchedules = document.querySelectorAll('.schedule-item');
                remainingSchedules.forEach((item, index) => {
                    const daySelect = item.querySelector('select[name$="[day]"]');
                    const startTime = item.querySelector('input[name$="[start_time]"]');
                    const endTime = item.querySelector('input[name$="[end_time]"]');
                    
                    if (daySelect) daySelect.name = `schedules[${index}][day]`;
                    if (startTime) startTime.name = `schedules[${index}][start_time]`;
                    if (endTime) endTime.name = `schedules[${index}][end_time]`;
                });
                
                scheduleCount = remainingSchedules.length;
            } else {
                alert('Minimal harus ada satu jadwal praktek.');
            }
        }
    });

    // Form submission dengan validasi
    form.addEventListener('submit', function(e) {
        console.log('Form submitted - Create Doctor');
        
        // Validasi jadwal
        const scheduleItems = document.querySelectorAll('.schedule-item');
        let hasValidSchedule = false;
        let scheduleErrors = [];
        
        scheduleItems.forEach((item, index) => {
            const day = item.querySelector('select[name$="[day]"]').value;
            const startTime = item.querySelector('input[name$="[start_time]"]').value;
            const endTime = item.querySelector('input[name$="[end_time]"]').value;
            
            if (day && startTime && endTime) {
                hasValidSchedule = true;
            } else {
                scheduleErrors.push(`Jadwal ${index + 1} tidak lengkap`);
            }
        });
        
        if (!hasValidSchedule) {
            e.preventDefault();
            alert('Harap isi minimal satu jadwal praktek yang lengkap (hari, jam mulai, jam selesai)!');
            return;
        }
        
        // Update button state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
        
        console.log('Form validation passed, submitting...');
    });

    // Show remove buttons jika multiple schedules
    const scheduleItems = document.querySelectorAll('.schedule-item');
    if (scheduleItems.length > 1) {
        document.querySelectorAll('.remove-schedule').forEach(btn => {
            btn.style.display = 'block';
        });
    }
});
</script>

<style>
.schedule-item {
    align-items: center;
}
.remove-schedule {
    display: none;
}
</style>
@endsection