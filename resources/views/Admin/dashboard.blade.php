<h1>Dashboard Admin</h1>

<p>Selamat datang, {{ Auth::guard('admin')->user()->full_name }}</p>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<h3>Daftar Semua Nasabah</h3>

@if ($users->isEmpty())
    <p>Belum ada nasabah yang terdaftar.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 200px">Nama Lengkap</th>
            <th style="width: 200px">Email</th>
            <th style="width: 150px">Nomor Rekening</th>
            <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>{{ $user->full_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->account_number }}</td>
            <td style="text-align: center">
                <a href="{{ route('admin.user.show', $user->id) }}">Detail</a>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin hapus nasabah ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br><br>
<form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>
