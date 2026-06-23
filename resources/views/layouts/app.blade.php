@extends('layouts.app')

@section('title', 'Daftar Kartu')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kartu</h1>
        <a href="{{ route('create_cards') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
            + Tambah Kartu
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

    @if($pinSecurity)
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded mb-6 text-sm">
            PIN terakhir diperbarui: {{ \Carbon\Carbon::parse($pinSecurity->updated_at)->format('d M Y H:i') }}
        </div>
    @endif

    @if($cards->isEmpty())
        <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">
            Belum ada kartu terdaftar.
        </div>
    @else
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Cardholder</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nomor Kartu</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Expired</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Limit</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Balance</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($cards as $i => $card)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $card->cardholder_name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $card->card_number }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($card->card_type == 'credit') bg-purple-100 text-purple-700
                                @elseif($card->card_type == 'debit') bg-blue-100 text-blue-700
                                @elseif($card->card_type == 'prepaid') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                {{ ucfirst($card->card_type ?? $card->type ?? '-') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $card->expired_at ?? $card->expiry_date ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($card->card_limit, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($card->balance, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($card->status == 'aktif') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700
                                @endif">
                                {{ ucfirst($card->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex gap-2">
                                <a href="{{ url('/cards/' . $card->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ url('/cards/' . $card->id . '/edit') }}"
                                   class="text-yellow-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ url('/cards/' . $card->id) }}"
                                      onsubmit="return confirm('Hapus kartu ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection