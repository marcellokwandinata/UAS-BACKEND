<h1>Edit Account</h1>
<form method="POST" action="{{ route('accounts.update', $account) }}">
    @csrf @method('PUT')
    Account Number:
    <br>
    <input name="account_number" value="{{ $account->account_number }}" required>
    <br>
    <br>
    Balance:
    <br>
    <input type="number" name="balance" value="{{ $account->balance }}" required>
    <br>
    <br>
    Account Type:
    <br>
    <input name="account_type" value="{{ $account->account_type }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>