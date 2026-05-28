<!DOCTYPE html>
<html>
<head>
    <title>Topup Data</title>

    <style>
        table {
            border-collapse: collapse;
            width: 70%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Topup Data</h1>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@if(session('error'))
    <p style="color: red;">
        {{ session('error') }}
    </p>
@endif

<a href="/">Home</a>

<br><br>

<a href="/topups/create">Tambah Topup</a>

<br><br>

<form action="/topups/" method="GET">
    <input type="number" name="id" placeholder="Cari ID">
</form>

<br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Aksi</th>
    </tr>

    @foreach($topups as $topup)
    <tr>
        <td>{{ $topup->id }}</td>
        <td>{{ $topup->email }}</td>
        <td>{{ $topup->amount }}</td>
        <td>
            <a href="{{ route('topup.delete', $topup->id) }}">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>