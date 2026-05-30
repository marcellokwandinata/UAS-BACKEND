<h1>Login Digital Banking</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('login.perform') }}">
    @csrf
    Email:
    <br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br><br>
    Password:
    <br>
    <input type="password" name="password" required>
    <br><br>
    <button type="submit">Masuk</button>
</form>

<br>
<a href="{{ route('user.create') }}">Belum punya akun? Daftar di sini</a>
