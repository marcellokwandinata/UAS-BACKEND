<!DOCTYPE html>
<html>
<head>
    <title>Topup List</title>

    <style>
        body {
            font-family: Arial;
            padding: 3vh 3vw;
        }

        h1 {
            font-size: 2vw;
        }

        .btn {
            display: inline-block;
            padding: 1vh 1.5vw;
            margin-right: 1vw;
            border: 1px solid #000;
            font-size: 1vw;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2vh;
            font-size: 1vw;
        }

        th, td {
            border: 1px solid #000;
            padding: 1.5vh 1vw;
        }

        th {
            background: #f0f0f0;
        }

        .hapus {
            color: red;
        }
    </style>
</head>

<body>

<h1>Topup Data</h1>

<a href="/welcome" class="btn">Home</a>
<a href="/create_topup" class="btn">Tambah Topup</a>

<br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

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
            <a href="/topups/delete/{{ $topup->id }}" class="hapus">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>