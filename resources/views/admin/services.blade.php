@extends('admin.layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Kelola Layanan</h1>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Layanan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Icon</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi</th>
                                <th>Jam Operasional</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="{{ $service->icon_class }} fa-2x text-primary"></i></td>
                                <td>{{ $service->name }}</td>
                                <td>{{ Str::limit($service->description, 100) }}</td>
                                <td>{{ $service->operational_hours }}</td>
                                <td>
                                    <span class="badge bg-{{ $service->status === 'active' ? 'success' : 'danger' }}">
                                        {{ $service->status === 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.services.edit', $service->id) }}" 
                                           class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.toggle-status', $service->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-{{ $service->status === 'active' ? 'secondary' : 'success' }}">
                                                <i class="fas fa-{{ $service->status === 'active' ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.services.destroy', $service->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Hapus layanan ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection