@extends('layouts.app')

@section('title', 'Keamanan Akun')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-shield-lock"></i> Pengaturan Keamanan</h4>
    <a href="{{ route('security.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Keamanan
    </a>
</div>

<div class="row g-4">
    {{-- Card PIN --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold"><i class="bi bi-lock text-primary"></i> PIN Transaksi</h6>
                    <small class="text-muted">Terakhir diubah: 01 Jan 2025</small>
                </div>
                <a href="{{ route('security.edit', 'pin') }}" class="btn btn-sm btn-outline-primary">Ubah</a>
            </div>
        </div>
    </div>

    {{-- Card 2FA --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold"><i class="bi bi-phone text-success"></i> Two-Factor Authentication</h6>
                    <small class="text-muted">Status: <span class="badge bg-success">Aktif</span></small>
                </div>
                <a href="{{ route('security.edit', '2fa') }}" class="btn btn-sm btn-outline-success">Kelola</a>
            </div>
        </div>
    </div>

    {{-- Card Sesi Aktif --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold"><i class="bi bi-laptop text-warning"></i> Sesi Aktif</h6>
                    <small class="text-muted">2 perangkat aktif</small>
                </div>
                <a href="{{ route('security.show', 'sessions') }}" class="btn btn-sm btn-outline-warning">Lihat</a>
            </div>
        </div>
    </div>

    {{-- Card Blokir Akun --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold"><i class="bi bi-slash-circle text-danger"></i> Blokir Akun</h6>
                    <small class="text-muted">Nonaktifkan akun sementara</small>
                </div>
                <a href="{{ route('security.edit', 'block') }}" class="btn btn-sm btn-outline-danger">Kelola</a>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Data Security --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">Log Aktivitas Keamanan</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($securities as $index => $security)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $security->name }}</td>
                    <td>{{ $security->type }}</td>
                    <td>
                        <span class="badge {{ $security->status === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($security->status) }}
                        </span>
                    </td>
                    <td>{{ $security->created_at->format('d M Y, H:i') }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('security.show', $security->id) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('security.edit', $security->id) }}" class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('security.destroy', $security->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data keamanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection