<!DOCTYPE html>
<html>
<head>
    <title>Detail Security</title>
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
        table {
            margin-top: 20px;
            width: 400px;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
            width: 40%;
        }
    </style>
</head>
<body>
<h1>Detail Security</h1>

<!-- BUTTON -->
<a href="/" class="btn">Home</a>
<a href="/securities" class="btn">Kembali ke List</a>
<a href="/securities/{{ $security->id }}/edit" class="btn btn-primary">Edit</a>

<!-- SALDO -->
<div class="saldo">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<!-- DETAIL -->
<table>
    <tr>
        <th>ID</th>
        <td>{{ $security->id }}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $security->name }}</td>
    </tr>
    <tr>
        <th>Tipe</th>
        <td>{{ strtoupper($security->type) }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{ ucfirst($security->status) }}</td>
    </tr>
    <tr>
        <th>Dibuat Pada</th>
        <td>{{ $security->created_at->format('d M Y, H:i') }}</td>
    </tr>
    <tr>
        <th>Diubah Pada</th>
        <td>{{ $security->updated_at->format('d M Y, H:i') }}</td>
    </tr>
</table>
</body>
</html>