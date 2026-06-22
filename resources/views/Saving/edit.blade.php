<h1>Edit Tabungan</h1>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('saving.update', $saving->id) }}" method="POST">
    @csrf @method('PATCH')
    <label>Nama Tabungan</label>
    <br>
    <input
        type="text"
        name="saving_name"
        value="{{ old('saving_name', $saving->saving_name) }}"
        required>
    <br><br>
    <label>Target Dana</label>
    <br>
    <input
        type="number"
        name="target_amount"
        value="{{ old('target_amount', $saving->target_amount) }}"
        required>
    <br><br>
    <label>Target Tanggal</label>
    <br>
    <input
        type="date"
        name="target_date"
        value="{{ old('target_date', $saving->target_date) }}">
    <br><br>
    <button type="submit">Simpan Perubahan</button>
</form>
<br>
<a href="{{ route('saving.show', $saving->id) }}">← Kembali</a>