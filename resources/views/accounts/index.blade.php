<h1>Daftar Akun</h1>

<a href="{{ route('accounts.create') }}">Create new Account</a>
<br><br>

@if ($accounts->isEmpty())
    <p>Belum ada akun yang tersimpan.</p>
@else

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 200px">Account Number</th>
            <th style="width: 150px">Balance</th>
            <th style="width: 150px">Type</th>
            <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td>
                <a href="{{ route('accounts.show', $account) }}">
                    {{ $account->account_number }}
                </a>
            </td>
            <td>Rp {{ number_format($account->balance, 2) }}</td>
            <td>{{ $account->account_type }}</td>
            <td style="text-align: center">
                <a href="{{ route('accounts.edit', $account) }}">Ubah</a>
                <form action="{{ route('accounts.destroy', $account) }}" method="post" 
                style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif