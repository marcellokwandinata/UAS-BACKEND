<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Nasabah</title>

    <style>
        body {
            margin: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #dcdcdc;
            padding: 18px 35px;
            font-size: 28px;
            font-weight: bold;
        }

        .container {
            width: 1000px;
            margin: 25px auto;
        }

        h1 {
            margin-bottom: 5px;
        }

        .subtitle {
            color: gray;
            margin-bottom: 20px;
        }

        .top {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: #dcdcdc;
            border-radius: 10px;
            padding: 20px;
        }

        .card-title {
            color: gray;
            margin-bottom: 15px;
        }

        .saldo {
            font-size: 38px;
            font-weight: bold;
            margin-top: 30px;
        }

        .section {
            background: #dcdcdc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .section-title {
            color: gray;
            margin-bottom: 15px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .menu a,
        .menu form {
            margin: 0;
        }

        .menu button {
            width: 100%;
            height: 55px;
            border: none;
            border-radius: 8px;
            background: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .menu button:hover {
            background: #f0f0f0;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>


<div class="container">

    <h1>Dashboard Nasabah</h1>
    <div class="subtitle">
        Selamat datang kembali, {{ $user->full_name }}!
    </div>

    <div class="top">

        <div class="card">
            <h3>Informasi Nasabah</h3>

            <p><b>Nama:</b> {{ $user->full_name }}</p>
            <p><b>No Rekening:</b> {{ $user->account_number }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>
        </div>

        <div class="card">
            <div class="card-title">
                Saldo
            </div>

            <div class="saldo">
                Rp {{ number_format($user->balance,0,',','.') }}
            </div>
        </div>

    </div>

    <div class="section">
        <div class="section-title">
            Menu Utama
        </div>

        <div class="menu">

            <a href="/topups/create">
                <button>Top Up Saldo</button>
            </a>

            <a href="{{ route('transfer.form') }}">
                <button>Transfer Saldo</button>
            </a>

            <a href="{{ route('transaction.index') }}">
                <button>Riwayat Transaksi</button>
            </a>

            <a href="/histories">
                <button>Riwayat Top Up</button>
            </a>

            <a href="{{ route('beneficiaries.index') }}">
                <button>Daftar Favorit</button>
            </a>

            <a href="{{ route ('saving.index') }}">
                <button>Tabungan Saya</button>
            </a>
        </div>
    </div>

    

    <div class="section">
        <div class="section-title">
            Akun
        </div>

        <div class="menu">

            <a href="{{ route('cards.byUser', $user->id) }}">
                <button>Kartu Saya</button>
            </a>

            <a href="{{ route('user.edit', $user->id) }}">
                <button>Edit Profil</button>
            </a>

            <a href="{{ route('security.changePasswordForm') }}">
            <button>Ganti Password</button>
            </a>

            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </div>
    </div>

</div>
</body>
</html>

