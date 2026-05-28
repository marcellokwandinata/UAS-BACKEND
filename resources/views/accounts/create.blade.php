<h1>Buat Akun Baru</h1>
<form method="POST" action="{{ route('accounts.store') }}">
    @csrf
    User ID:
    <br>
    <input type="number" name="user_id" required>
    <br>
    <br>
    Account Number:
    <br>
    <input name="account_number" required>
    <br>
    <br>
    Balance:
    <br>
    <input type="number" name="balance" required>
    <br>
    <br>
    Account Type:
    <br>
    <input name="account_type" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>