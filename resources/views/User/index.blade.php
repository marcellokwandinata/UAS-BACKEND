<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital-Banking - Dashboard</title>
</head>
<body>
    <table border="0" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td><h1>Digital-Banking Dashboard</h1></td>
            <td align="right">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Keluar Aplikasi (Logout)</button>
                </form>
            </td>
        </tr>
    </table>

    <hr>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h3>🪪 Informasi Rekening Nasabah Aktif</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Pemilik Rekening</th>
                <th>Nomor Rekening</th>
                <th>Jumlah Saldo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $user->full_name }}</strong></td>
                <td>{{ $user->account_number ?? 'Belum Diatur' }}</td>
                <td>Rp 0,00</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h3>📂 Detail Kredensial Sistem Internal</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td><strong>Email Terdaftar:</strong></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><strong>ID Database:</strong></td>
            <td>#{{ $user->id }}</td>
        </tr>
    </table>
</body>
</html>