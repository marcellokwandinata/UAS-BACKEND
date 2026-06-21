<h1>Detail Nasabah</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="width: 150px">Nama Lengkap</th>
        <td>{{ $user->full_name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Nomor Rekening</th>
        <td>{{ $user->account_number }}</td>
    </tr>
    <tr>
        <th>Saldo</th>
        <td>Rp {{ number_format($user->balance, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Tanggal Daftar</th>
        <td>{{ $user->created_at }}</td>
    </tr>
</table>

<br>
<h3>Riwayat Transaksi</h3>

@if ($transactions->isEmpty())
    <p>Belum ada riwayat transaksi.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 150px">Tanggal</th>
            <th style="width: 100px">Jenis</th>
            <th style="width: 150px">Nominal</th>
            <th style="width: 150px">Rekening Tujuan</th>
            <th style="width: 200px">Keterangan</th>
            <th style="width: 100px">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $trx)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $trx->created_at }}</td>
            <td style="text-align: center">{{ ucfirst($trx->type) }}</td>
            <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
            <td>{{ $trx->recipient_account ?? '-' }}</td>
            <td>{{ $trx->description ?? '-' }}</td>
            <td style="text-align: center">{{ ucfirst($trx->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br>
<a href="{{ route('admin.dashboard') }}">Kembali</a>

<br><br>
<form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Yakin ingin menutup akun nasabah ini?')">Tutup Akun Nasabah</button>
</form>
