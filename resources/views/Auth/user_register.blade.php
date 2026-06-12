<h1>Daftar Akun Baru</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('user.store') }}">
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
    <input type="password" name="password" id="password" required>
    <button type="button" onclick="togglePassword('password')">Tampilkan</button>
    <br><br>
    Konfirmasi Password:
    <br>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
    <button type="button" onclick="togglePassword('password_confirmation')">Tampilkan</button>
    <br><br>
    <button type="submit">Daftar & Buka Rekening</button>
</form>

<br>
<a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>

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