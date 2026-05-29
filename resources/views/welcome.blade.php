<!DOCTYPE html>
<html>
<head>
    <title>Digital Banking</title>

    <style>
        body {
            font-family: system-ui, sans-serif;
            margin: 5vh 5vw;
            background: #f9f9f9;
        }

        h1 {
            margin-bottom: 3vh;
        }

        .section {
            background: white;
            padding: 2vh 2vw;
            margin-bottom: 3vh;
            border: 1px solid #ddd;
        }

        h2 {
            margin-bottom: 1.5vh;
            font-size: 1.3vw;
        }

        .menu {
            display: flex;
            gap: 1vw;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 1vh 1.5vw;
            border: 1px solid #000;
            background: #f0f0f0;
            color: black;
            text-decoration: none;
            font-size: 1vw;
        }

        .btn:hover {
            background: #ddd;
        }
    </style>
</head>

<body>

    <h1>Digital Banking</h1>

    <div class="section">
        <h2>Histories</h2>
        <div class="menu">
            <a href="/histories" class="btn">View Histories</a>
            <a href="/histories/create" class="btn">Create History</a>
        </div>
    </div>

    <div class="section">
        <h2>Topups</h2>
        <div class="menu">
            <a href="/topups" class="btn">View Topups</a>
            <a href="/topups/create" class="btn">Create Topup</a>
        </div>
    </div>

</body>
</html>