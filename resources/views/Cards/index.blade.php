@extends('layouts.app')

@section('title', 'Manajemen Kartu')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Kartu</h1>
        <a href="{{ route('create_cards') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
            + Tambah Kartu Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        {{-- PIN --}}
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-800">PIN Transaksi</p>
                <p class="text-sm text-gray-500">
                    Terakhir diubah:
                    @if($pinSecurity)
                        {{ \Carbon\Carbon::parse($pinSecurity->updated_at)->format('d M Y') }}
                    @else
                        Belum pernah diubah
                    @endif
                </p>
            </div>
            <a href="{{ route('security.pin') }}"
               class="text-sm border border-blue-500 text-blue-600 px-3 py-1 rounded hover:bg-blue-50">
                Ubah
            </a>
        </div>

        {{-- 2FA --}}
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-800">Two-Factor Authentication</p>
                <p class="text-sm text-gray-500">Status: <span class="text-green-600 font-medium">Aktif</span></p>
            </div>
            <a href="{{ route('security.index') }}"
               class="text-sm border border-green-500 text-green-600 px-3 py-1 rounded hover:bg-green-50">
                Kelola
            </a>
        </div>

        {{-- Sesi Aktif --}}
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-800">Sesi Aktif</p>
                <p class="text-sm text-gray-500">2 perangkat aktif</p>
            </div>
            <a href="{{ route('security.loginHistory') }}"
               class="text-sm border border-yellow-500 text-yellow-600 px-3 py-1 rounded hover:bg-yellow-50">
                Lihat
            </a>
        </div>

        {{-- Blokir Akun --}}
        <div class="bg-white rounded-xl shadow-sm p-4 flex justify-between items-center">
            <div>
                <p class="font-semibold text-gray-800">Blokir Akun</p>
                <p class="text-sm text-gray-500">Nonaktifkan akun sementara</p>
            </div>
            <a href="{{ route('security.index') }}"
               class="text-sm border border-red-500 text-red-600 px-3 py-1 rounded hover:bg-red-50">
                Kelola
            </a>
        </div>

    </div>

    {{-- Tabel Kartu --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 font-semibold text-gray-700">
            Daftar Kartu
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($cards as $index => $card)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $card->name ?? $card->cardholder_name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($card->type ?? $card->card_type ?? '-') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ in_array($card->status, ['aktif','active']) ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($card->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($card->created_at)->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('cards.edit', $card->id) }}"
                               class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('cards.destroy', $card->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus kartu ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data kartu</td>
                </tr>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">
        <i class="bi bi-credit-card-2-front"></i>
        Pengaturan Kartu
    </h4>

    <a href="{{ route('create_cards') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Tambah Kartu Baru
    </a>
</div>

{{-- PIN --}}
<div class="col-md-6 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">
                    <i class="bi bi-lock text-primary"></i>
                    PIN Transaksi
                </h6>

                <small class="text-muted">
                    Terakhir diubah:
                    @if($pinSecurity)
                        {{ \Carbon\Carbon::parse($pinSecurity->updated_at)->translatedFormat('d M Y') }}
                    @else
                        Belum pernah diubah
                    @endif
                </small>
            </div>

            <a href="{{ route('security.pin') }}"
               class="btn btn-sm btn-outline-primary">
                Ubah
            </a>
        </div>
    </div>
</div>

{{-- 2FA --}}
<div class="col-md-6 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">
                    <i class="bi bi-phone text-success"></i>
                    Two-Factor Authentication
                </h6>

                <small class="text-muted">
                    Status:
                    <span class="badge bg-success">Aktif</span>
                </small>
            </div>

            <a href="{{ route('security.index') }}"
               class="btn btn-sm btn-outline-success">
                Kelola
            </a>
        </div>
    </div>
</div>

{{-- SESI AKTIF --}}
<div class="col-md-6 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">
                    <i class="bi bi-laptop text-warning"></i>
                    Sesi Aktif
                </h6>

                <small class="text-muted">
                    2 perangkat aktif
                </small>
            </div>

            <a href="{{ route('show_cards', 'sessions') }}"
               class="btn btn-sm btn-outline-warning">
                Lihat
            </a>
        </div>
    </div>
</div>

{{-- BLOKIR AKUN --}}
<div class="col-md-6 mb-3">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">
                    <i class="bi bi-slash-circle text-danger"></i>
                    Blokir Akun
                </h6>

                <small class="text-muted">
                    Nonaktifkan akun sementara
                </small>
            </div>

            <a href="{{ route('security.index') }}"
               class="btn btn-sm btn-outline-danger">
                Kelola
            </a>
        </div>
    </div>
</div>

{{-- TABEL KARTU --}}
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">
        Log Aktivitas / Daftar Kartu
    </div>

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

                    <td>
                        {{ $card->cardholder_name ?? $card->name }}
                    </td>

                    <td>
                        {{ $card->card_type ?? $card->type }}
                    </td>

                    <td>
                        <span class="badge {{ $card->status == 'aktif' || $card->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($card->status) }}
                        </span>
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($card->created_at)->format('d M Y, H:i') }}
                    </td>

                    <td class="d-flex gap-1">

                        {{-- EDIT --}}
                        <a href="{{ route('cards.edit', $card->id) }}"
                           class="btn btn-sm btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('cards.destroy', $card->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="6"
                        class="text-center text-muted py-4">
                        Belum ada data kartu
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection