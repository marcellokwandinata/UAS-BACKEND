<h1>Tambah Beneficiary</h1>

<form method="POST" action="{{ route('beneficiaries.store') }}">
    @csrf

    Nama Beneficiary:
    <br>
    <input name="beneficiary_name" required>
    <br>
    <br>
    Nomor Rekening:
    <br>
    <input name="account_number" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>