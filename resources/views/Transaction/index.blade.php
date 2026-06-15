<h1>Riwayat Transaksi</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<div>
    <a href="{{ route('transfer.form') }}" style="color: blue; text-decoration: underline;">Transfer Saldo</a>
</div>

<br>

<table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f0f0f0;">
            <th>Tanggal</th>
            <th>Tipe</th>
            <th>Deskripsi</th>
            <th>Nominal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transactions ?? [] as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                <td>{{ ucfirst($transaction->type) }}</td>
                <td>{{ $transaction->description }}</td>
                <td>
                    @php
                        $isIncoming = $transaction->recipient_account === auth()->user()->account_number;
                    @endphp
                    @if($transaction->type === 'deposit' || $isIncoming)
                        +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    @else
                        -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    @endif
                </td>
                <td>{{ ucfirst($transaction->status) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #999;">Belum ada transaksi</td>
            </tr>
        @endforelse
    </tbody>
</table>

<br>
<a href="{{ route('user.index') }}" style="color: blue; text-decoration: underline;">Kembali ke Dashboard</a>
