<!DOCTYPE html>
<html>
<head>
    <title>Create Topup</title>
</head>
<body>

    <h1>Create Topup</h1>

    <form method="POST" action="/topups">
        @csrf

        <label>Payment Method:</label>
        <br>
        <input type="text" name="payment_method">
        <br><br>

        <label>Nominal:</label>
        <br>
       <input type="text" name="amount">
        <br><br>

        <label>Status:</label>
        <br>
        <input type="text" name="status">
        <br><br>

        <button type="submit">
            Submit
        </button>
    </form>

</body>
</html>