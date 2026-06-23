<!DOCTYPE html>
<html>
<head>
    <title>Detail Profil Nasabah</title>

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

        .profile-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #333;
        }

        .value {
            color: #555;
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

    <h1>Detail Profil Nasabah</h1>
    <div class="subtitle">
        Informasi akun pengguna Anda.
    </div>

    <div class="card">

        <div class="profile-box">

            <div class="row">
                <div class="label">Nama Lengkap</div>
                <div class="value">{{ $user->full_name }}</div>
            </div>

            <div class="row">
                <div class="label">Nomor Rekening</div>
                <div class="value">{{ $user->account_number }}</div>
            </div>

            <div class="row">
                <div class="label">Email</div>
                <div class="value">{{ $user->email }}</div>
            </div>

        </div>

        <div class="button-group">
            <a href="{{ route('user.index') }}" class="btn btn-primary">
                ← Halaman Utama
            </a>
        </div>

    </div>

</div>

</body>
</html>