<h1>Login Admin Digital Banking</h1>

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

<form method="POST" action="{{ route('admin.login.perform') }}">
    @csrf
    Email Admin:
    <br>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br><br>
    Password:
    <br>
    <input type="password" name="password" required>
    <br><br>
    <button type="submit">Masuk sebagai Admin</button>
</form>

<br>
<a href="{{ route('login') }}">Login sebagai Nasabah</a>
