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

<a href="/">Home</a>

<br><br>

<a href="/topups/create">Tambah Topup</a>

<br><br>

<form action="/topups/" method="GET">
    <input type="number" name="id" placeholder="Cari ID">
</form>

<br>

<table>
    <tr>
        <th>ID</th>
        <th>Payment Method</th>
        <th>Nominal</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($topups as $topup)
    <tr>
        <td>{{ $topup->id }}</td>
        <td>{{ $topup->payment_method }}</td>
        <td>{{ $topup->nominal }}</td>
        <td>{{ $topup->status }}</td>

        <td>
            <a href="/topups/delete/{{ $topup->id }}">
                Hapus
            </a>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>