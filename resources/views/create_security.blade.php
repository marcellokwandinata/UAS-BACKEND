<!DOCTYPE html>
<html>
<head>
    <title>Create Security</title>
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
<h1>Create Security</h1>

<!-- BUTTON -->
<a href="/" class="btn">← Halaman Utama</a>
<a href="/securities" class="btn">Kembali ke List</a>

<!-- SALDO (WAJIB MUNCUL) -->
<div class="saldo">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<!-- FORM -->
<form action="/securities" method="POST">
    @csrf

    <label>Nama Pengaturan</label>
    <input type="text" name="name" placeholder="Contoh: PIN Utama">

    <label>Tipe Keamanan</label>
    <select name="type">
        <option value="pin">PIN Transaksi</option>
        <option value="2fa">Two-Factor Authentication</option>
        <option value="password">Password</option>
        <option value="biometric">Biometrik</option>
    </select>

    <label>Nilai / Kode</label>
    <input type="password" name="value" placeholder="Masukkan PIN / Password">

    <label>Status</label>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
    </select>

    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Send</button>
</form>
</body>
</html>