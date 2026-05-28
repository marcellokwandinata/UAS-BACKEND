<h1>Detail Akun</h1>
<p>
    <strong>Account Number:</strong>
    {{ $account->account_number }}
</p>
<p>
    <strong>Balance:</strong>
    Rp {{ number_format($account->balance, 2) }}
</p>
<p>
    <strong>Account Type:</strong>
    {{ $account->account_type }}
</p>
<p>
    <strong>User ID:</strong>
    {{ $account->user_id }}
</p>
<a href="{{ route('accounts.index') }}">Kembali</a>