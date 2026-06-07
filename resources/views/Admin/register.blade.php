<h1>Register Admin Digital Banking</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.register.store') }}">
    @csrf
    Nama Lengkap:
    <br>
    <input type="text" name="full_name" value="{{ old('full_name') }}" required>
    <br><br>
    Email:
    <br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br><br>
    Password:
    <br>
    <input type="password" name="password" required>
    <br><br>
    Konfirmasi Password:
    <br>
    <input type="password" name="password_confirmation" required>
    <br><br>
    <button type="submit">Daftar sebagai Admin</button>
</form>

<br>
<a href="{{ route('admin.login') }}">Sudah punya akun admin? Login di sini</a>