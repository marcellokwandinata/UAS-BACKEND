<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

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
            width: 1100px;
            margin: 25px auto;
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
            padding: 20px;
        }

        .section-title {
            color: gray;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 280px;
            height: 40px;
            padding: 0 10px;
            border: none;
            border-radius: 8px;
        }

        .search-box button,
        .search-box a {
            display: inline-block;
            height: 40px;
            padding: 0 20px;
            line-height: 40px;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            background: white;
            color: black;
            cursor: pointer;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #ececec;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .btn-detail {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            background: #4da6ff;
            color: white;
            cursor: pointer;
        }

        .btn-delete {
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            background: #ff6b6b;
            color: white;
            cursor: pointer;
        }

        .logout {
            margin-top: 20px;
        }

        .logout button {
            width: 140px;
            height: 45px;
            border: none;
            border-radius: 8px;
            background: white;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Dashboard Admin</h1>

    <div class="subtitle">
        Selamat datang kembali, {{ Auth::guard('admin')->user()->full_name }}!
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="section-title">
            Daftar Semua Nasabah
        </div>

        <div class="search-box">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="Cari nama atau nomor rekening">

                <button type="submit">
                    Cari
                </button>

                <a href="{{ route('admin.dashboard') }}">
                    Reset
                </a>
            </form>
        </div>

        @if ($users->isEmpty())

            <p>Belum ada nasabah yang terdaftar.</p>

        @else

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Rekening</th>
                    <th>Opsi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->account_number }}</td>

                    <td style="white-space: nowrap;">
                        <a href="{{ route('admin.user.show', $user->id) }}"
                        style="text-decoration:none;">
                            <button type="button" class="btn-detail">
                                Detail
                            </button>
                        </a>

                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                            method="POST"
                            style="display:inline; margin:0;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Yakin ingin hapus nasabah ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        @endif

    </div>

    <div class="logout">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit">
                Logout
            </button>
        </form>
    </div>

</div>

</body>
</html>