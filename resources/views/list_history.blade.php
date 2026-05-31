<!DOCTYPE html>
<html>
<head>
    <title>History List</title>

    <style>
        body {
            font-family: Arial;
            padding: 3vh 3vw;
        }

        h1 {
            font-size: 2vw;
        }

        a {
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 0.8vh 1.5vw;
            border: 1px solid #000;
            background: #f0f0f0;
            color: black;
            text-decoration: none;
            font-size: 0.9vw;
            cursor: pointer;
            min-width: 80px;
            text-align: center;
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
            width: 100%;
            border-collapse: collapse;
            margin-top: 2vh;
            font-size: 1vw;
        }

        th, td {
            border: 1px solid #000;
            padding: 1.5vh 1vw;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .search-form {
            margin-top: 2vh;
            display: flex;
            gap: 0.5vw;
            align-items: center;
        }

        .search-form input {
            width: 220px;
            height: 38px;
            padding: 0 10px;
            font-size: 14px;
        }

        .search-form .btn-search {
            height: 38px;
            width: 90px;
            padding: 0;
        }
    </style>
</head>

<body>

<h1>History Data</h1>

<a href="/" class="btn">Home</a>

<form action="/histories" method="GET" class="search-form">
    <input type="text" name="id" placeholder="Cari ID">

    <button type="submit" class="btn btn-search">
        Cari
    </button>
</form>

<br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<p><b>Total History:</b> {{ count($histories) }}</p>

<table>
    <tr>
        <th>Transaction-ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Saldo After</th>
        <th>Waktu</th>
    </tr>

    @foreach($histories as $history)
    <tr>
        <td>{{ $history->id }}</td>
        <td>{{ $history->title }}</td>
        <td>{{ $history->description }}</td>
        <td>{{ $history->amount }}</td>
        <td>{{ $history->balance_after ?? '-' }}</td>
        <td>{{ $history->transaction_time ?? '-' }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>