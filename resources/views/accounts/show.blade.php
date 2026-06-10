<h1>Dashboard Akun</h1>
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
    <strong>Account Name:</strong>
    {{ $account->account_name }}
</p>
<hr>
<h3>Menu Banking</h3>
<p>
    <a href="{{ route('beneficiaries.index') }}">
        Manage Beneficiaries
    </a>
</p>
<p>
    <a href="#">
        Transfer Money
    </a>
</p>
<p>
    <a href="#">
        Transaction History
    </a>
</p>
<br>
<a href="{{ route('accounts.index') }}">Kembali</a>