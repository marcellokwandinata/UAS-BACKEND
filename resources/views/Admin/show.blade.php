<h1>Detail Nasabah</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="width: 150px">Nama Lengkap</th>
        <td>{{ $user->full_name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $user->email }}</td>
    </tr>
    <tr>
        <th>Nomor Rekening</th>
        <td>{{ $user->account_number }}</td>
    </tr>
    <tr>
        <th>Tanggal Daftar</th>
        <td>{{ $user->created_at }}</td>
    </tr>
</table>

<br>
<a href="{{ route('admin.dashboard') }}">Kembali</a>

<br><br>
<form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Yakin ingin hapus nasabah ini?')">Hapus Nasabah</button>
</form>
