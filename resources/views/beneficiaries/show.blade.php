<!DOCTYPE html>
<html>
<head>
    <title>Detail Beneficiary</title>

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

        .info {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .value {
            font-size: 16px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background: white;
            color: black;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Detail Beneficiary</h1>
    <div class="subtitle">
        Informasi rekening tujuan.
    </div>

    <div class="card">

        <div class="info">
            <span class="label">Nama Beneficiary</span>
            <div class="value">
                {{ $beneficiary->beneficiary_name }}
            </div>
        </div>

        <div class="info">
            <span class="label">Nomor Rekening</span>
            <div class="value">
                {{ $beneficiary->account_number }}
            </div>
        </div>

        <a href="{{ route('user.index') }}" class="btn">
            ← Halaman Utama
        </a>



    </div>
</div>

</body>
</html>