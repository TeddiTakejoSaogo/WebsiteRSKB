@extends('admin.layouts.app')

@section('title', 'Kelola Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Pesan Kontak</h1>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pesan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $messages->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Belum Dibaca
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $messages->where('status', 'unread')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sudah Dibalas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $messages->where('status', 'replied')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-reply fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.contact-messages') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari nama, email, atau subjek..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                            <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Filter
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                                <th width="120">Status</th>
                                <th width="120">Tanggal</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                            <tr class="{{ $message->status == 'unread' ? 'table-warning' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                    @if($message->phone)
                                    <br><small class="text-muted">{{ $message->phone }}</small>
                                    @endif
                                </td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ Str::limit($message->message, 50) }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $message->status_badge }}">
                                        {{ $message->status_text }}
                                    </span>
                                </td>
                                <td>{{ $message->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                           class="btn btn-info" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($message->status != 'replied')
                                        <form action="{{ route('admin.contact-messages.replied', $message->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success" 
                                                    title="Tandai Sudah Dibalas">
                                                <i class="fas fa-reply"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Hapus pesan ini?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-envelope fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada pesan kontak.</p>
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