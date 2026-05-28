<h1>Detail Rekening Nasabah</h1>
<p><b>Nomor Rekening (ID):</b> {{ $user->id }}</p>
<p><b>Nama Lengkap:</b> {{ $user->full_name }}</p>
<p><b>Email:</b> {{ $user->email }}</p>
<br>
<a href="{{ route('User.index') }}">Kembali</a>