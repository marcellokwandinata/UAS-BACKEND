<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Top Up</title>

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

        .button-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
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
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Riwayat Top Up</h1>

    <div class="subtitle">
        Daftar seluruh transaksi top up Anda.
    </div>

    <div class="card">

        <div class="button-group">
            <a href="{{ route('user.index') }}" class="btn">
                ← Halaman Utama
            </a>

            <a href="/topups/create" class="btn">
                Top Up Baru
            </a>
        </div>

        <form action="/histories" method="GET">

            <div class="search-box">
                <input type="text"
                       name="id"
                       placeholder="Cari kode transaksi (TRX001)">

                <button type="submit" class="btn btn-dark">
                    Cari
                </button>
            </div>

        </form>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <div class="info">
            Total Riwayat: <b>{{ count($histories) }}</b>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Transaksi</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Saldo Akhir</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>

            @forelse($histories as $history)

                <tr>
                    <td>{{ $history->transaction_code }}</td>

                    <td>{{ $history->title }}</td>

                    <td>{{ $history->description }}</td>

                    <td>
                        Rp {{ number_format($history->amount,0,',','.') }}
                    </td>

                    <td>
                        Rp {{ number_format($history->balance_after ?? 0,0,',','.') }}
                    </td>

                    <td>
                        {{ $history->transaction_time
                        ? \Carbon\Carbon::parse($history->transaction_time)->format('d-m-Y H:i')
                        : '-' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        Belum ada riwayat top up.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>