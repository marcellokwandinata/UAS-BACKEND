<h1>Buat Tabungan</h1>
<form method="POST" action="{{ route('saving.store') }}">
    @csrf
    Nama Tabungan:
    <br>
    <input type="text" name="saving_name" required>
    <br><br>
    Target Dana:
    <br>
    <input type="number" name="target_amount" required>
    <br><br>
    Target Tanggal:
    <br>
    <input type="date" name="target_date">
    <br><br>
    <button type="submit">Simpan</button>
</form>
<br>
<a href="{{ route('saving.index') }}">Kembali</a>