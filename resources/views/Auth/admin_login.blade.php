<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .navbar {
            background: #dcdcdc;
            padding: 18px 35px;
            font-size: 28px;
            font-weight: bold;
        }

        .container {
            width: 450px;
            margin: 60px auto;
        }

        .card {
            background: #dcdcdc;
            padding: 25px;
            border-radius: 10px;
        }

        .form-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            height: 42px;
            border: none;
            border-radius: 8px;
            padding: 0 10px;
            font-size: 15px;
            box-sizing: border-box;
            background: #f8f8f8;
        }

        .btn {
            width: 100%;
            height: 45px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            background: black;
            color: white;
        }

        .link {
            display: block;
            margin-top: 12px;
            text-align: center;
            color: blue;
            text-decoration: none;
        }

        .toggle {
            margin-top: 10px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING - ADMIN
</div>

<div class="container">

    <div class="card">

        <div class="form-box">

            <h2>Login Admin</h2>

            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.perform') }}">
                @csrf

                <label>Email Admin</label>
                <input type="email" name="email" required>

                <label>Password</label>
                <input type="password" id="password" name="password" required>

                <button type="button" class="toggle" onclick="togglePassword('password')">
                    Tampilkan Password
                </button>

                <button type="submit" class="btn">
                    Masuk sebagai Admin
                </button>
            </form>

            <a href="{{ route('admin.register') }}" class="link">
                Daftar sebagai admin
            </a>

            <a href="{{ route('login') }}" class="link">
                Login sebagai nasabah
            </a>

        </div>

    </div>

</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>