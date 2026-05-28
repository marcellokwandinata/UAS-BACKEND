<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital-Banking - Register</title>
</head>
<body>
    <h1>Digital-Banking - Buka Rekening Baru</h1>
    <p>Buat akun nasabah baru untuk mendapatkan Nomor Rekening</p>

    @if($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('User.store') }}">
        @csrf
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td><label>Nama Lengkap:</label></td>
                <td><input type="text" name="full_name" required></td>
            </tr>
            <tr>
                <td><label>Alamat Email:</label></td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td><label>Password:</label></td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td><label>Konfirmasi Password:</label></td>
                <td><input type="password" name="password_confirmation" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Daftar & Buka Rekening</button></td>
            </tr>
        </table>
    </form>

    <br>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>
</html>