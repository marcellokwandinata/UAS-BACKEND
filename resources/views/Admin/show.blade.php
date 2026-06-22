<!DOCTYPE html>
<html>
<head>
    <title>Detail Nasabah</title>

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
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .navbar {
            background: #dcdcdc;
            padding: 18px 35px;
            font-size: 28px;
            font-weight: bold;
        }

        .container {
            width: 900px;
            margin: 30px auto;
        }

        h1 {
            margin-bottom: 5px;
        }

        .subtitle {
            color: gray;
            margin-bottom: 20px;
        }

        .card {
            background: #dcdcdc;
            border-radius: 10px;
            padding: 25px;
        }

        .box {
            background: white;
            border-radius: 10px;
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .value {
            color: #555;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            height: 45px;
            padding: 0 25px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: black;
        }

        .btn-danger {
            background: #ff4d4d;
            color: white;
        }

        .btn-primary {
            background: black;
            color: white;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING - ADMIN
</div>

<div class="container">

    <h1>Detail Nasabah</h1>
    <div class="subtitle">
        Informasi lengkap akun pengguna.
    </div>

    <div class="card">

        <div class="box">

            <div class="row">
                <div class="label">Nama Lengkap</div>
                <div class="value">{{ $user->full_name }}</div>
            </div>

            <div class="row">
                <div class="label">Email</div>
                <div class="value">{{ $user->email }}</div>
            </div>

            <div class="row">
                <div class="label">Nomor Rekening</div>
                <div class="value">{{ $user->account_number }}</div>
            </div>

            <div class="row">
                <div class="label">Tanggal Daftar</div>
                <div class="value">{{ $user->created_at }}</div>
            </div>

        </div>

        <div class="button-group">

            <a href="{{ route('admin.dashboard') }}" class="btn">
                Kembali
            </a>

            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus nasabah ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Hapus Nasabah
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>

