@extends('layouts.app')

@section('title', 'Manajemen Kartu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-credit-card-2-front"></i> Pengaturan Kartu</h4>
    <a href="{{ route('create_cards') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kartu Baru
    </a>
</div>

{{-- Card PIN --}}
<div class="col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold"><i class="bi bi-lock text-primary"></i> PIN Transaksi</h6>
                <small class="text-muted">
                    Terakhir diubah: 
                    @if($pinSecurity)
                        {{ \Carbon\Carbon::parse($pinSecurity->updated_at)->translatedFormat('d M Y') }}
                    @else
                        Belum pernah diubah
                    @endif
                </small>
            </div>
            <a href="{{ route('security.pin') }}" class="btn btn-sm btn-outline-primary">Ubah</a>
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
                <a href="{{ route('security.index') }}" class="btn btn-sm btn-outline-success">Kelola</a>
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
                <a href="{{ route('show_cards', 'sessions') }}" class="btn btn-sm btn-outline-warning">Lihat</a>
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
                <a href="{{ route('security.index') }}" class="btn btn-sm btn-outline-danger">Kelola</a>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Data Cards (Diambil dari Database) --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">Log Aktivitas / Daftar Kartu</div>
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
                @forelse($cards as $index => $card)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->type }}</td>
                    <td>
                        <span class="badge {{ $card->status === 'aktif' || $card->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($card->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($card->created_at)->format('d M Y, H:i') }}</td>
                    <td class="d-flex gap-1">
                        {{-- Tombol Detail / Lihat --}}
                        <a href="{{ route('show_cards', $card->id) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Tombol Edit --}}
                        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- Tombol Hapus Data --}}
                        <form action="{{ route('cards.destroy', $card->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data kartu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection