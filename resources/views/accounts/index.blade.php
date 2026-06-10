<h1>Daftar Akun</h1>

<a href="{{ route('accounts.create') }}">Create New Account</a>

<br><br>

@if ($accounts->isEmpty())
    <p>Belum ada akun yang tersimpan.</p>
@else

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 200px">Account Number</th>
            <th style="width: 150px">Type</th>
            <th style="width: 200px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
        <tr>
            <td style="text-align: center">
                {{ $loop->iteration }}
            </td>
            <td>{{ $account->account_number }}</td>
            <td>{{ $account->account_type }}</td>
            <td style="text-align: center">
                <a href="{{ route('accounts.show', $account) }}">Masuk</a>
                <a href="{{ route('accounts.edit', $account) }}">Edit Account</a>
                <form
                    action="{{ route('accounts.destroy', $account) }}"
                    method="POST"
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