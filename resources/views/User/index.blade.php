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
<div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border: 1px solid #ddd; display: flex; gap: 30px;">
    <div style="flex: 1;">
        <h3>Tambah Saldo</h3>
        @if ($errors->has('amount'))
            <p style="color: red;">{{ $errors->first('amount') }}</p>
        @endif
        <form action="{{ route('user.addBalance') }}" method="POST">
            @csrf
            <label for="amount">Nominal (Rp):</label>
            <input type="number" id="amount" name="amount" min="1" required placeholder="Contoh: 100000">
            <button type="submit">Tambah Saldo</button>
        </form>
    </div>
    <div style="flex: 1;">
        <h3>Reset Saldo</h3>
        <form action="{{ route('user.resetBalance') }}" method="POST">
            @csrf
            <p style="margin-bottom: 10px; font-size: 14px;">Saldo akan direset ke Rp 0</p>
            <button type="submit" style="background-color: #ff6b6b; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Reset Saldo</button>
        </form>
    </div>
</div>

<div style="margin-bottom: 20px;">
    <a href="{{ route('transaction.index') }}"><button>Riwayat Transaksi</button></a>
    <a href="{{ route('transfer.form') }}"><button>Transfer Saldo</button></a>
</div>

<div style="margin-bottom: 20px;">
    <a href="{{ route('user.show', $user->id) }}"><button>Lihat Detail</button></a>
    <a href="{{ route('user.edit', $user->id) }}"><button>Edit Profil</button></a>
</div>

<br>
<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>
