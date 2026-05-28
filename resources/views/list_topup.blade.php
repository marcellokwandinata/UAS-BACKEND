<!DOCTYPE html>
<html>
<head>
    <title>Topup List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 3vh 3vw;
        }

        table {
            border-collapse: collapse;
            width: 70vw;
        }

        th, td {
            border: 1px solid black;
            padding: 1.5vh 1vw;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            padding: 1vh 1vw;
            background: black;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Topup Data</h1>

<a href="/">Home</a>

<br><br>

<a href="/topups/create">Tambah Topup</a>

<br><br>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="10">
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