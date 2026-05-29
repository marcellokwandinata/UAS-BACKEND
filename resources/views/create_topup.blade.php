<!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>

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

<h1>Create Topup</h1>

<!-- BUTTON -->
<a href="/" class="btn">Home</a>
<a href="/topups" class="btn">Kembali ke List</a>

<!-- SALDO (WAJIB MUNCUL) -->
<div class="saldo">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<!-- FORM -->
<form action="/topups" method="POST">
    @csrf

    <label>Payment Method</label>
    <select name="payment_method">
        <option value="QRIS">QRIS</option>
        <option value="Transfer">Transfer</option>
        <option value="E-Wallet">E-Wallet</option>
    </select>

    <label>Nominal</label>
    <input type="text" name="nominal">

    <button type="submit">Send</button>
</form>

</body>
</html>