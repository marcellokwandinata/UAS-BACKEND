<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>

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
            margin-bottom: 15px;
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

        .income {
            color: green;
            font-weight: bold;
        }

        .outcome {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Riwayat Transaksi</h1>
    <div class="subtitle">
        Semua aktivitas keuangan Anda tercatat di sini.
    </div>

    <div class="card">

        <div class="button-group">
            <a href="{{ route('user.index') }}" class="btn">
                ← Halaman Utama
            </a>

            <a href="{{ route('transfer.form') }}" class="btn">
                Transfer Saldo
            </a>
        </div>

        <form method="GET" action="">
            <div class="search-box">
                <input type="text" name="search" placeholder="Cari transaksi...">
                <button type="submit" class="btn btn-dark">Cari</button>
            </div>
        </form>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($transactions ?? [] as $transaction)

                @php
                    $isIncoming = $transaction->recipient_account === auth()->user()->account_number;
                @endphp

                <tr>
                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>

                    <td>{{ ucfirst($transaction->type) }}</td>

                    <td>{{ $transaction->description }}</td>

                    <td>
                        @if($transaction->type === 'deposit' || $isIncoming)
                            <span class="income">
                                +Rp {{ number_format($transaction->amount,0,',','.') }}
                            </span>
                        @else
                            <span class="outcome">
                                -Rp {{ number_format($transaction->amount,0,',','.') }}
                            </span>
                        @endif
                    </td>

                    <td>{{ ucfirst($transaction->status) }}</td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" style="color:#888;">
                        Belum ada transaksi
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>

</body>
</html>