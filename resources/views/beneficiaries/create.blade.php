<!DOCTYPE html>
<html>
<head>
    <title>Tambah Beneficiary</title>

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

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
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

    <h1>Tambah Beneficiary</h1>
    <div class="subtitle">
        Simpan rekening tujuan agar transfer lebih mudah.
    </div>

    <div class="card">

        <form method="POST" action="{{ route('beneficiaries.store') }}">
            @csrf

            <label>Nama Beneficiary</label>
            <input name="beneficiary_name" required>

            <label>Nomor Rekening</label>
            <input name="account_number" required>

            <div class="button-group">

                <a href="{{ route('beneficiaries.index') }}" class="btn">
                    ← Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

</body>
</html>