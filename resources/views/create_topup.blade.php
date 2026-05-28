<!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>
</head>
<body>

<h1>Tambah Topup</h1>

<form action="/topups" method="POST">
    @csrf

    <div>
        <label>Payment Method</label>
        <input type="text" name="payment_method">
    </div>

    <br>

    <div>
        <label>Nominal</label>
        <input type="text" name="nominal">
    </div>

    <br>

    <div>
        <label>Status</label>
        <input type="text" name="status">
    </div>

    <br>

    <button type="submit">
        Simpan
    </button>
</form>
</body>
</html>