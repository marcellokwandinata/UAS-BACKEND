<h1>Dashboard Nasabah</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="width: 150px">Nama Nasabah</th>
        <td>{{ $user->full_name }}</td>
    </tr>
    <tr>
        <th>Nomor Rekening</th>
        <td>{{ $user->account_number }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Saldo</th>
        <td>Rp {{ number_format($user->balance, 0, ',', '.') }}</td>
    </tr>
</table>

<br>

<div style="margin-bottom: 20px;">
    <a href="{{ route('transaction.index') }}"><button>Riwayat Transaksi</button></a>
    <a href="{{ route('transfer.form') }}"><button>Transfer Saldo</button></a>
</div>

<div style="margin-bottom: 20px;">
    <a href="{{ route('user.show', $user->id) }}"><button>Lihat Detail</button></a>
    <a href="{{ route('user.edit', $user->id) }}"><button>Edit Profil</button></a>
    <a href="{{ route('user.changePasswordForm', $user->id) }}"><button>Ganti Password</button></a>
</div>

<br>

<br><br>
<form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>