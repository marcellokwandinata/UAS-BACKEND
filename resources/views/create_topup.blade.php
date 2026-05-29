<!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>

    <style>
        body {
            padding: 3vh 3vw;
            font-family: system-ui, sans-serif;
        }

        h1 {
            margin-bottom: 1vh; 
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

        form {
            width: 40vw;
        }

        label {
            display: block;
            margin-top: 2vh;
        }

        input, select {
            width: 100%;
            padding: 1vh 1vw;
            margin-top: 1vh;
        }

        .btn-submit {
            margin-top: 3vh;
        }

        .saldo-box {
            display: inline-block;
            padding: 1vh 2vw;
            border: 2px solid #000;
            background: #fff;
            font-size: 1.2vw;
            font-weight: bold;
            margin: 2vh 0;
        }
    </style>
</head>

<body>

<h1>Create Topup</h1>

<a href="/" class="btn">Home</a>
<a href="/topups" class="btn">Kembali ke List</a>

<div class="saldo-box">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<form action="/topups" method="POST">
    @csrf

    <label>Payment Method</label>
    <select name="payment_method" required>
        <option value="">-- Pilih --</option>
        <option value="Transfer to Bank">Transfer to Bank</option>
        <option value="QRIS">QRIS</option>
        <option value="TopUp E-Wallet">TopUp E-Wallet</option>
    </select>

    <label>Nominal</label>
    <input type="text" name="nominal" required>

    <button type="submit" class="btn btn-submit">Send</button>
</form>

</body>
</html>