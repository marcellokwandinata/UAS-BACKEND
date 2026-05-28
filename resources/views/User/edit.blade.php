<h1>Ubah Data Nasabah</h1>
<form method="POST" action="{{ route('User.update', $user->id) }}">
    @csrf
    @method('PUT')
    
    <label>Nama Lengkap:</label><br>
    <input type="text" name="full_name" value="{{ $user->full_name }}" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ $user->email }}" required><br><br>

    <label>Password Baru (Kosongkan jika tidak diubah):</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Simpan Perubahan</button>
</form>
<br>
<a href="{{ route('User.index') }}">Kembali</a>