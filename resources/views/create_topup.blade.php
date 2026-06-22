<!DOCTYPE html>
<html>
<head>
    <title>Top Up Saldo</title>

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

        .saldo {
            background: white;
            padding: 12px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            height: 42px;
            border: none;
            border-radius: 8px;
            padding: 0 10px;
            font-size: 15px;
            box-sizing: border-box;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: black;
        }

        .btn-primary {
            background: black;
            color: white;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Top Up Saldo</h1>
    <div class="subtitle">
        Tambahkan saldo ke rekening Anda.
    </div>

    <div class="card">

        <div class="saldo">
            Saldo Saat Ini:
            Rp {{ number_format(Auth::user()->balance,0,',','.') }}
        </div>

        <form action="/topups" method="POST">
            @csrf

            <label>Metode Pembayaran</label>
            <select name="payment_method">
                <option value="QRIS">QRIS</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>

            <label>Nominal Top Up</label>
            <input type="number"
                   name="nominal"
                   placeholder="Contoh: 100000"
                   required>

            <div class="button-group">

                <a href="{{ route('user.index') }}" class="btn">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Proses Top Up
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>