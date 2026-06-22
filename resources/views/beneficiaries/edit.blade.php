<h1>Edit Beneficiary</h1>
<form method="POST"
      action="{{ route('beneficiaries.update', $beneficiary) }}">
    @csrf @method('PUT')
    Nama Beneficiary:
    <br>
    <input
        name="beneficiary_name"
        value="{{ $beneficiary->beneficiary_name }}"
        required>
    <br>
    <br>
    Nomor Rekening:
    <br>
    <input
        name="account_number"
        value="{{ $beneficiary->account_number }}"
        required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>