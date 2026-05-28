<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital-Banking - Login</title>
</head>
<body>
    <h1>Digital-Banking - Login</h1>
    <p>Silakan masuk ke akun perbankan digital Anda</p>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td><label>Alamat Email:</label></td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td><label>Password:</label></td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Masuk ke Akun</button></td>
            </tr>
        </table>
    </form>

    <br>
    <p>Belum jadi nasabah? <a href="{{ route('User.create') }}">Buka Rekening Baru</a></p>
</body>
</html>