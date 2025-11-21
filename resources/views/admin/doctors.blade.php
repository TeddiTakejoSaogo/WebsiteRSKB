@extends('admin.layouts.app')

@section('title', 'Kelola Data Dokter')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Data Dokter</h1>
            <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Dokter
            </a>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.doctors') }}" method="GET" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari nama dokter atau spesialisasi..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th width="50">#</th>
                                <th width="80">Foto</th>
                                <th>Nama Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Pendidikan</th>
                                <th>Jadwal Praktek</th>
                                <th width="100">Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://via.placeholder.com/50x50?text=No+Image' }}" 
                                         alt="{{ $doctor->name }}" 
                                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                </td>
                                <td>
                                    <strong>{{ $doctor->name }}</strong>
                                    @if($doctor->experience)
                                    <br><small class="text-muted">{{ $doctor->experience }}</small>
                                    @endif
                                </td>
                                <td>{{ $doctor->specialization }}</td>
                                <td>{{ $doctor->education }}</td>
                                <td>
                                    @if($doctor->schedules->count() > 0)
                                        <ul class="list-unstyled small mb-0">
                                            @foreach($doctor->schedules as $schedule)
                                                <li>{{ $schedule->day_name }}: {{ $schedule->time_range }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Belum ada jadwal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $doctor->status === 'active' ? 'success' : 'danger' }}">
                                        {{ $doctor->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" 
                                        class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Tombol Toggle Status -->
                                        <form action="{{ route('admin.doctors.toggle-status', $doctor->id) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $doctor->status === 'active' ? 'secondary' : 'success' }}" 
                                                    title="{{ $doctor->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                    onclick="return confirm('Yakin ingin {{ $doctor->status === 'active' ? 'menonaktifkan' : 'mengaktifkan' }} dokter ini?')">
                                                <i class="fas fa-{{ $doctor->status === 'active' ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" 
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data dokter {{ $doctor->name }}? Tindakan ini tidak dapat dibatalkan!')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-user-md fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada data dokter.</p>
                                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Dokter Pertama
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection