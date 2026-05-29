<!DOCTYPE html>
<html>
<head>
    <title>Topup List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 3vh 3vw;
            background: #f6f7fb;
        }

        .container {
            width: 90vw;
            margin: auto;
        }

        h1 {
            font-size: 2vw;
            margin-bottom: 2vh;
        }

        .nav-btn {
            display: inline-block;
            padding: 1vh 1.5vw;
            margin-right: 1vw;
            background: #3498db;
            color: white;
            border-radius: 0.6vw;
            text-decoration: none;
            font-size: 1vw;
        }

        .add-btn {
            background: #2ecc71;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1vw;
            background: white;
            border-radius: 1vw;
            overflow: hidden;
        }

        th, td {
            padding: 1.5vh 1vw;
            border-bottom: 0.1vh solid #ddd;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
            padding: 0.8vh 1vw;
            border-radius: 0.5vw;
            text-decoration: none;
        }

        .msg-success { color: green; }
        .msg-error { color: red; }
    </style>
</head>

<body>

<div class="container">

<h1>Topup Data</h1>

<a href="/home" class="nav-btn">Home</a>
<a href="/topups/create" class="nav-btn add-btn">Tambah Topup</a>

@if(session('success'))
    <p class="msg-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="msg-error">{{ session('error') }}</p>
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
            <a href="/topups/delete/{{ $topup->id }}" class="btn-hapus">Hapus</a>
        </td>
    </tr>
    @endforeach

</table>

</div>

</body>
</html>