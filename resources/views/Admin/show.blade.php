<!DOCTYPE html>
<html>
<head>
    <title>Detail Nasabah</title>
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

        .transaction-card h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .transaction-table th {
            background: #dcdcdc;
            padding: 12px;
            text-align: center;
        }

        .transaction-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .transaction-table tr:hover {
            background: #f8f8f8;
        }

        .status {
            background: #d4edda;
            color: green;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING - ADMIN
</div>

<div class="container">

    <h1>Detail Nasabah</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($user->is_blocked)
        <p style="color: red;"><strong>Status Akun: Diblokir</strong></p>
        <form action="{{ route('admin.user.unblock', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit">Buka Blokir</button>
        </form>
    @else
        <p style="color: green;"><strong>Status Akun: Aktif</strong></p>
        <form action="{{ route('admin.user.block', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" onclick="return confirm('Yakin ingin blokir akun ini?')">Blokir Akun</button>
        </form>
    @endif

    <div class="subtitle">
        Informasi lengkap akun pengguna.
    </div>


    <div class="card">

    <div class="card transaction-card">

    <h2>Riwayat Transaksi</h2>
        @if ($transactions->isEmpty())
            <p>Belum ada riwayat transaksi.</p>
        @else
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Rekening Tujuan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y H:i') }}</td>
                    <td>{{ ucfirst($trx->type) }}</td>
                    <td>
                        Rp {{ number_format($trx->amount,0,',','.') }}
                    </td>
                    <td>{{ $trx->recipient_account ?? '-' }}</td>
                    <td>{{ $trx->description ?? '-' }}</td>
                    <td>
                        <span class="status">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

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
                <div class="label">Saldo</div>
                <div class="value">
                    Rp {{ number_format($user->balance, 0, ',', '.') }}
                </div>
            </div>

            <div class="row">
                <div class="label">Tanggal Daftar</div>
                <div class="value">{{ $user->created_at }}</div>
            </div>

        </div>

        <div class="button-group">

            <a href="{{ route('admin.dashboard') }}" class="btn">
                ← Halaman Utama
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

