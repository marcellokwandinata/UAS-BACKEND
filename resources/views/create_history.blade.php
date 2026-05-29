<!DOCTYPE html>
<html>
<head>
    <title>Create History</title>

    <style>
        body {
            padding: 3vh 3vw;
            font-family: system-ui, sans-serif;
        }

        h1 {
            margin-bottom: 2vh;
        }

        .btn {
            display: inline-block;
            padding: 1vh 2vw;
            border: 1px solid #000;
            background: #f0f0f0;
            color: black;
            text-decoration: none;
            font-size: 1vw;
            cursor: pointer;
            margin-right: 1vw;
        }

        .btn:hover {
            background: #ddd;
        }

        form {
            margin-top: 2vh;
            width: 40vw;
        }

        label {
            display: block;
            margin-top: 2vh;
        }

        input {
            width: 100%;
            padding: 1vh 1vw;
            margin-top: 1vh;
        }

        .btn-submit {
            margin-top: 3vh;
        }
    </style>
</head>

<body>

<h1>Tambah History</h1>

<a href="/" class="btn">Home</a>
<a href="/histories" class="btn">Kembali ke List</a>

<br>

<form action="/histories" method="POST">
    @csrf

    <div>
        <label>Title</label>
        <input type="text" name="title">
    </div>

    <div>
        <label>Description</label>
        <input type="text" name="description">
    </div>

    <div>
        <label>Amount</label>
        <input type="text" name="amount">
    </div>

    <button type="submit" class="btn btn-submit">
        Send
    </button>
</form>
</body>
</html>

