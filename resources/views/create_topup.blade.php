<!DOCTYPE html>
<html>
<head>
    <title>Form Top Up</title>

    <style>
        body {
            font-family: system-ui, sans-serif;
            padding: 30px;
        }

        .saldo {
            margin-top: 12px;
            padding: 8px 12px;
            border: 2px solid #000;
            width: fit-content;
            font-size: 14px;      
            font-weight: bold;
        }

        form {
            margin-top: 20px;
            width: 280px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 6px 8px;         
            margin-top: 5px;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 1vh 2vw;
            border: 1px solid #000;
            background: #f0f0f0;
            color: black;
            text-decoration: none;
            font-size: 1vw;
            cursor: pointer;
            margin-right: 1vw;
        }

        .btn:hover {
            background: #ddd;
        }

        .btn-primary {
            background: #000;
            color: #fff;
            border: 1px solid #000;
        }

    </style>
</head>

<body>

<h1>Form Top Up</h1>

<!-- TOMBOL -->
<a href="/" class="btn">Beranda</a>
<a href="/topups" class="btn">Kembali</a>

<div class="saldo">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<!-- FORM -->
<form action="/topups" method="POST">
    @csrf

    <label>Metode Pembayaran</label>
    <select name="payment_method">
        <option value="QRIS">QRIS</option>
        <option value="Transfer">Transfer Bank</option>
        <option value="E-Wallet">E-Wallet</option>
    </select>

    <label>Nominal</label>
    <input type="text" name="nominal">

    <button type="submit">Proses Transaksi</button>
</form>

</body>
</html>