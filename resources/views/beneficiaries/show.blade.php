<h1>Detail Beneficiary</h1>
<p>
    Nama:
    {{ $beneficiary->beneficiary_name }}
</p>
<p>
    Nomor Rekening:
    {{ $beneficiary->account_number }}
</p>
<a href="{{ route('beneficiaries.index') }}">
    Kembali
</a>