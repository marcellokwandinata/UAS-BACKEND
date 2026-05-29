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

        a {
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 1vh 1.5vw;
            margin-right: 1vw;
            border: 1px solid #000;
            font-size: 1vw;
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
        
        input {
            padding: 1vh 1vw;
            margin-top: 2vh;
            font-size: 1vw;
        }
    </style>
</head>

<body>

<h1>Topup Data</h1>

<a href="/" class="btn">Home</a>
<a href="/topups/create" class="btn">Tambah Topup</a>

<br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/topups" method="GET">
    <input type="text" name="id" placeholder="Cari ID">
</form>

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
    </tr>
    @endforeach
</table>

</body>
</html>