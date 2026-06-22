<h1>Kartu Milik {{ $user->full_name ?? $user->name }}</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<a href="{{ route('create_cards') }}"><button>Tambah Kartu Baru</button></a>

<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemegang</th>
            <th>Nomor Kartu</th>
            <th>Tipe</th>
            <th>Expired</th>
            <th>Limit</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cards as $index => $card)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $card->cardholder_name ?? '-' }}</td>
            <td>**** **** **** {{ substr($card->card_number, -4) }}</td>
            <td>{{ $card->card_type ?? '-' }}</td>
            <td>{{ $card->expired_at ?? '-' }}</td>
            <td>
                @if($card->card_limit)
                    Rp {{ number_format($card->card_limit, 0, ',', '.') }}
                @else
                    -
                @endif
            </td>
            <td>{{ ucfirst($card->status) }}</td>
            <td>
                <a href="{{ route('cards.setLimitForm', $card->id) }}"><button>Set Limit</button></a>
                <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline;"
                    onsubmit="return confirm('Yakin hapus kartu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;">Belum ada kartu terdaftar</td>
        </tr>
        @endforelse
    </tbody>
</table>

<br>
<a href="{{ route('user.index') }}"><button>Kembali ke Dashboard</button></a>