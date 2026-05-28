<!DOCTYPE html>
<html>
<head>
    <title>History List</title>
</head>
<body>

<h1>History Data</h1>

<table border="1" cellpadding="10">
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
            <a href="/histories/delete/{{ $history->id }}">Hapus</a>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>