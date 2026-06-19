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
    <input type="password" name="password" id="password" required>
    <button type="button" onclick="togglePassword('password')">Tampilkan</button>
    <br><br>
    <button type="submit">Masuk sebagai Admin</button>
    <br>
<a href="{{ route('admin.register') }}">Daftar sebagai admin</a>
</form>

<br>
<a href="{{ route('login') }}">Login sebagai Nasabah</a>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const btn = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = 'Sembunyikan';
        } else {
            input.type = 'password';
            btn.textContent = 'Tampilkan';
        }
    }
</script>