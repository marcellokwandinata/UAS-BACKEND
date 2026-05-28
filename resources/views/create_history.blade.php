<!DOCTYPE html>
<html>
<head>
    <title>Create History</title>
</head>
<body>

<h1>Tambah History</h1>

<form action="/histories" method="POST">
    @csrf

    <div>
        <label>Title</label>
        <input type="text" name="title">
    </div>

    <br>

    <div>
        <label>Description</label>
        <input type="text" name="description">
    </div>

    <br>

    <div>
        <label>Amount</label>
        <input type="number" name="amount">
    </div>

    <br>

    <button type="submit">
        Simpan
    </button>
</form>

<br>

<a href="/histories">Kembali ke List</a>

</body>
</html>