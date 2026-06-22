@if(session('success'))
    <div style="background:#ddffdd; color:green; padding:10px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <div style="background:#ffdddd; color:red; padding:10px; margin-bottom:10px;">
        {{ session('error') }}
    </div>
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

<h1>Daftar Beneficiary</h1>
<a href="{{ route('beneficiaries.create') }}">Tambah Beneficiary</a>
<br><br>

@if ($beneficiaries->isEmpty())
    <p>Belum ada beneficiary yang tersimpan.</p>
@else

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nomor Rekening</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($beneficiaries as $beneficiary)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <a href="{{ route('transfer.form', [
                'account_number' => $beneficiary->account_number]) }}">
                {{ $beneficiary->beneficiary_name }}
                </a>
            </td>
            <td>{{ $beneficiary->account_number }}</td>
            <td>
                <a href="{{ route('beneficiaries.edit', $beneficiary) }}">Ubah</a>
                <form action="{{ route('beneficiaries.destroy', $beneficiary) }}"
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