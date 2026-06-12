<h1>Dashboard Nasabah</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="width: 150px">Nama Nasabah</th>
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
<a href="{{ route('user.show', $user->id) }}"><button>Lihat Detail</button></a>
<a href="{{ route('user.edit', $user->id) }}"><button>Edit Profil</button></a>
<a href="{{ route('user.changePasswordForm', $user->id) }}"><button>Ganti Password</button></a>

<br><br>
<form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>
