<!DOCTYPE html>
<html>
<head>
    <title>Register Digital Banking</title>

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
            margin: 40px auto;
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
            margin-top: 8px;
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
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <div class="card">
        <div class="form-box">

            <h2>Register Nasabah</h2>

            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.store') }}">
                @csrf

                <label>Nama Lengkap</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required>

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                <label>Password</label>
                <input type="password" id="password" name="password" required>

                <button type="button" class="toggle" onclick="togglePassword('password')">
                    Tampilkan Password
                </button>

                <label>Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                <button type="button" class="toggle" onclick="togglePassword('password_confirmation')">
                    Tampilkan Password
                </button>

                <button type="submit" class="btn">
                    Daftar
                </button>
            </form>

            <a href="{{ route('login') }}" class="link">
                Sudah punya akun? Login
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