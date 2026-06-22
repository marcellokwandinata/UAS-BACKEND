<!DOCTYPE html>
<html>
<head>
    <title>Data Top Up</title>

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
            width: 1100px;
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
            padding: 20px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 0 20px;
            height: 42px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: black;
        }

        .btn-dark {
            background: black;
            color: white;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-box input {
            flex: 1;
            height: 42px;
            border: none;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 15px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 15px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background: #ececec;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background: #f8f8f8;
        }

        .saldo {
            background: #ececec;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Data Top Up</h1>
    <div class="subtitle">
        Riwayat semua transaksi top up Anda.
    </div>

    <div class="card">

        <div class="button-group">
            <a href="/" class="btn">Beranda</a>
            <a href="/topups/create" class="btn">Tambah Top Up</a>
        </div>

        <form action="/topups" method="GET">

            <div class="search-box">
                <input type="text" name="id" placeholder="Cari Kode Transaksi (TRX001)">
                <button type="submit" class="btn btn-dark">Cari</button>
            </div>

        </form>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <div class="saldo">
            Saldo Saat Ini:
            Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
        </div>

        <div class="info">
            Total Transaksi: <b>{{ count($topups) }}</b>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Metode</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($topups as $topup)
                <tr>
                    <td>{{ $topup->transaction_code }}</td>
                    <td>{{ $topup->payment_method }}</td>
                    <td>Rp {{ number_format($topup->nominal, 0, ',', '.') }}</td>
                    <td>
                        {{ $topup->status == 'Success' ? '✔ Berhasil' : '✖ Gagal' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data top up</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

</body>
</html>