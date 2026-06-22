@extends('layouts.app')

@section('title', 'Detail Kartu')

@section('content')
<div class="container py-4">
    <div class="mb-3">
        <a href="{{ route('cards_index') }}" class="btn btn-sm btn-light border">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Kartu
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-5">
            {{-- Tampilan Visual Kartu Fisik --}}
            <div class="card text-white bg-dark shadow-lg border-0 mb-4 position-relative" style="border-radius: 16px; overflow: hidden; height: 240px;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="bi bi-cpu" style="font-size: 5rem;"></i>
                </div>
                
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase tracking-wider opacity-75" style="font-size: 0.75rem;">Tipe Kartu</small>
                            <h5 class="fw-bold mb-0">{{ strtoupper($card->card_type ?? 'CREDIT') }}</h5>
                        </div>
                        <i class="bi bi-credit-card-2-front-fill fs-2"></i>
                    </div>

                    {{-- Format nomor kartu dengan spasi setiap 4 digit --}}
                    <div class="my-3">
                        <span class="fs-4 fw-mono tracking-widest">
                            {{ isset($card->card_number) ? implode(' ', str_split($card->card_number, 4)) : '•••• •••• •••• ••••' }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <small class="text-uppercase tracking-wider opacity-75 d-block" style="font-size: 0.65rem;">User ID Pemilik</small>
                            <span class="fw-bold text-uppercase">{{ $card->user_id }}</span>
                        </div>
                        <div>
                            <small class="text-uppercase tracking-wider opacity-75 d-block" style="font-size: 0.65rem;">Expired At</small>
                            <span class="fw-bold">{{ $card->expired_at ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Informasi Metadata Tabel --}}
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-info-circle text-primary"></i> Informasi Lengkap Kartu
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th class="ps-4 py-3" style="width: 30%;">ID Kartu</th>
                                <td class="py-3 text-muted"><code>{{ $card->id }}</code></td>
                            </tr>
                            <tr>
                                <th class="ps-4 py-3">Nomor Kartu</th>
                                <td class="py-3 fw-bold">{{ $card->card_number }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4 py-3">Tipe/Kategori</th>
                                <td class="py-3"><span class="badge bg-secondary">{{ ucfirst($card->card_type) }}</span></td>
                            </tr>
                            <tr>
                                <th class="ps-4 py-3">Masa Berlaku</th>
                                <td class="py-3 text-danger fw-bold"><i class="bi bi-calendar-x"></i> {{ $card->expired_at }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4 py-3">Status Aktif</th>
                                <td class="py-3">
                                    <span class="badge {{ $card->status === 'aktif' || $card->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($card->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-4 py-3">Dibuat Pada</th>
                                <td class="py-3">{{ \Carbon\Carbon::parse($card->created_at)->format('d F Y, H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                {{-- Aksi Cepat Terkait Status (Blokir / Aktifkan Kembali) --}}
                <div class="card-footer bg-light d-flex justify-content-end gap-2 py-3">
                    @if($card->status === 'aktif' || $card->status === 'active')
                        <a href="{{ route('cards.block', $card->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('Blokir kartu ini?')">
                            <i class="bi bi-slash-circle"></i> Blokir Kartu
                        </a>
                    @else
                        <a href="{{ route('cards.unblock', $card->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Aktifkan kembali kartu ini?')">
                            <i class="bi bi-check-circle"></i> Aktifkan Kartu
                        </a>
                    @endif

                    <form action="{{ route('cards.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Hapus kartu ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection