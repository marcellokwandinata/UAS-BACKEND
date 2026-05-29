<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Utama - Digital Banking</title>
</head>
<body>

    <h2>Halaman Utama Akun Pengguna</h2>
    <p>Status: Login Berhasil!</p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama Nasabah</th>
            <td>{{ $user->full_name }}</td>
        </tr>
        <tr>
            <th>Nomor Rekening</th>
            <td>{{ $user->account_number }}</td>
        </tr>
    </table>

    <br>

    <form action="{{ route('logout', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Keluar Aplikasi</button>
    </form>

</body>
</html>