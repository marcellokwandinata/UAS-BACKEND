<!DOCTYPE html>
<html>
<head>
    <title>History List</title>

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

        .search {
            margin: 2vh 0;
        }

        input {
            padding: 1vh 1vw;
            width: 20vw;
            font-size: 1vw;
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

<h1>History Data</h1>

@if(session('success'))
    <p class="msg-success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="msg-error">{{ session('error') }}</p>
@endif

<a href="/home" class="nav-btn">Home</a>
<a href="/history/create" class="nav-btn add-btn">Tambah History</a>

<form class="search" action="/histories/" method="GET">
    <input type="number" name="id" placeholder="Cari ID">
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Action</th>
    </tr>

    @foreach($histories as $history)
    <tr>
        <td>{{ $history->id }}</td>
        <td>{{ $history->title }}</td>
        <td>{{ $history->description }}</td>
        <td>{{ $history->amount }}</td>
        <td>
            <a href="/history/delete/{{ $history->id }}" class="btn-hapus">Hapus</a>
        </td>
    </tr>
    @endforeach
</table>

</div>

</body>
</html>