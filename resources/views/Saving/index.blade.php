<!DOCTYPE html>
<html>
<head>
    <title>Tabungan Saya</title>

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

        .btn-primary {
            background: black;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .success-box {
            background: #e6ffe6;
            color: green;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #bbb;
        }

        th {
            font-size: 14px;
        }

        td a {
            color: black;
            font-weight: bold;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .empty {
            padding: 20px;
            background: white;
            border-radius: 8px;
            text-align: center;
        }

        .progress {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Tabungan Saya</h1>
    <div class="subtitle">
        Kelola semua tabungan kamu di sini.
    </div>

    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="top-bar">
            <a href="/" class="btn">← Halaman Utama</a>
            <a href="{{ route('saving.create') }}" class="btn btn-primary">
                + Buat Tabungan Baru
            </a>
        </div>

        @if($savings->isEmpty())

            <div class="empty">
                Belum ada tabungan.
            </div>

        @else

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tabungan</th>
                        <th>Target</th>
                        <th>Terkumpul</th>
                        <th>Progress</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($savings as $saving)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <a href="{{ route('saving.show', $saving->id) }}">
                                {{ $saving->saving_name }}
                            </a>
                        </td>

                        <td>
                            Rp {{ number_format($saving->target_amount, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($saving->current_amount, 0, ',', '.') }}
                        </td>

                        <td class="progress">
                            @if($saving->target_amount > 0)
                                {{ round(($saving->current_amount / $saving->target_amount) * 100, 1) }}%
                            @else
                                0%
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

    </div>
</div>

</body>
</html>