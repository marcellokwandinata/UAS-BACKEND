<h1>Detail Profil Nasabah</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="width: 150px">Nama Lengkap</th>
        <td>{{ $user->full_name }}</td>
    </tr>
    <tr>
        <th>Nomor Rekening</th>
        <td>{{ $user->account_number }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
</table>

<br>
<a href="{{ route('user.index') }}">Kembali</a>
