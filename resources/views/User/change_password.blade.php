<h1>Ganti Password</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.changePassword', $user->id) }}">
    @csrf
    @method('PATCH')
    Password Lama:
    <br>
    <input type="password" name="current_password" required>
    <br><br>
    Password Baru:
    <br>
    <input type="password" name="new_password" required>
    <br><br>
    Konfirmasi Password Baru:
    <br>
    <input type="password" name="new_password_confirmation" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('user.index') }}">Kembali</a>