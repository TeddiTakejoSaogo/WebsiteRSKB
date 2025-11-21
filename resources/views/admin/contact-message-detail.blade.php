@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Detail Pesan Kontak</h1>
            <a href="{{ route('admin.contact-messages') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pengirim</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Nama</strong></label>
                        <p>{{ $message->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Email</strong></label>
                        <p>{{ $message->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Telepon</strong></label>
                        <p>{{ $message->phone ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>Subjek</strong></label>
                        <p>{{ $message->subject }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Pesan</strong></label>
                    <div class="border p-3 bg-light rounded">
                        {{ $message->message }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Dikirim: {{ $message->created_at->translatedFormat('d F Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Status Update -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kelola Pesan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact-messages.update', $message->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="unread" {{ $message->status == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Admin</label>
                        <textarea name="admin_notes" class="form-control" rows="4" 
                                  placeholder="Tambahkan catatan internal...">{{ old('admin_notes', $message->admin_notes) }}</textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

                <hr>

                <!-- Quick Actions -->
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                       class="btn btn-success" target="_blank">
                        <i class="fas fa-reply"></i> Balas via Email
                    </a>
                    
                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                          method="POST" class="d-grid">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Hapus pesan ini?')">
                            <i class="fas fa-trash"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Status -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <span class="badge {{ $message->status_badge }} fs-6">
                        {{ $message->status_text }}
                    </span>
                </div>
                @if($message->admin_notes)
                <div class="mt-3">
                    <label class="form-label"><strong>Catatan:</strong></label>
                    <p class="small">{{ $message->admin_notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection