<!DOCTYPE html>
<html>
<head>
    <title>History List</title>

    <style>
        table {
            border-collapse: collapse;
            width: 70%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px 12px;
            text-align: center;
        }

        th {
            background-color: #e5e5e5;
            font-weight: bold;
        }

        a {
            color: blue;
        }
    </style>
</head>
<body>

<h1>History Data</h1>

<a href="/">Kembali ke Home</a>

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
            <a href="/histories/delete/{{ $history->id }}">
                Hapus
            </a>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>