<!DOCTYPE html>
<html>
<head>
    <title>Create History</title>
</head>
<body>

    <h1>Create History</h1>

    <form method="POST" action="/histories">
        @csrf

        <label>Title:</label>
        <br>
        <input type="text" name="title">
        <br><br>

        <label>Description:</label>
        <br>
        <input type="text" name="description">
        <br><br>

        <label>Amount:</label>
        <br>
        <input type="text" name="amount">
        <br><br>

        <button type="submit">
            Submit
        </button>
    </form>

</body>
</html>