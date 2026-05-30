<h1>Edit Profil</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.update', $user->id) }}">
    @csrf
    @method('PATCH')
    Nama Lengkap:
    <br>
    <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
    <br><br>
    Email:
    <br>
    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('user.index') }}">Kembali</a>

<br><br>
<form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Yakin ingin hapus akun ini?')">Hapus Akun</button>
</form>
