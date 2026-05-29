<!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>

    <style>
        body {
            font-family: Arial;
            padding: 3vh 3vw;
        }

        form {
            width: 40vw;
        }

        label {
            display: block;
            margin-top: 2vh;
            font-size: 1vw;
        }

        .btn {
            display: inline-block;
            padding: 1vh 1.5vw;
            margin-right: 1vw;
            border: 1px solid #000;
            font-size: 1vw;
        }

        input, select {
            width: 100%;
            padding: 1vh 1vw;
            font-size: 1vw;
            margin-top: 1vh;
        }

        button {
            margin-top: 3vh;
            padding: 1vh 2vw;
            font-size: 1vw;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h1>Create Topup</h1>

<a href="/" class="btn">Home</a>
<a href="/topups" class="btn">Kembali ke List</a>

<br>

<form action="/topups" method="POST">
    @csrf

    <label>Payment Method</label>
    <select name="payment_method" required>
        <option value="">-- Pilih Payment Method --</option>
        <option value="Transfer to Bank">Transfer to Bank</option>
        <option value="QRIS">QRIS</option>
        <option value="TopUp E-Wallet">TopUp E-Wallet</option>
    </select>

    <label>Nominal</label>
    <input type="text" name="nominal" required>

    <label>Status</label>
    <select name="status" required>
        <option value="">-- Pilih Status --</option>
        <option value="Success">Success</option>
        <option value="TidakBerhasil">Tidak Berhasil</option>
    </select>

    <button type="submit">Simpan</button>
</form>

</body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>
</head>
<body>

<h1>Tambah Topup</h1>

<form action="/topups" method="POST">
    @csrf

    <div>
        <label>Payment Method</label>
        <input type="text" name="payment_method">
    </div>

    <br>

    <div>
        <label>Nominal</label>
        <input type="text" name="nominal">
    </div>

    <br>

    <div>
        <label>Status</label>
        <input type="text" name="status">
    </div>

    <br>

    <button type="submit">
        Simpan
    </button>
</form>
</body>
</html> -->