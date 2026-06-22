@if(session('error'))
    <div style="background-color:#ffdddd; color:red; padding:10px; margin-bottom:10px;">
        {{ session('error') }}
    </div>

    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if(session('success'))
    <div style="background-color:#ddffdd; color:green; padding:10px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<h1>{{ $saving->saving_name }}</h1>
<p>
    Target:
    Rp {{ number_format($saving->target_amount,0,',','.') }}
</p>
<p>
    Terkumpul:
    Rp {{ number_format($saving->current_amount,0,',','.') }}
</p>
<p>
    Target Tanggal:
    {{ $saving->target_date }}
</p>
<p>
    Progress:
    @if($saving->target_amount > 0)
        {{ round(($saving->current_amount / $saving->target_amount) * 100, 1) }}%
    @else
        0%
    @endif
</p>
<hr>
<h3>Tambah Dana</h3>
<form action="{{ route('saving.deposit', $saving->id) }}" method="POST">
    @csrf
    <label>Nominal:</label>
    <br>
    <input type="number" name="amount" min="10000" required>
    <br><br>
    <button type="submit"> Tambah Dana</button>
</form>
<hr>
<a href="{{ route('saving.edit', $saving->id) }}">Edit</a>
<br><br>
<form action="{{ route('saving.destroy', $saving->id) }}" method="POST">
    @csrf @method('DELETE')
    <button type="submit">Hapus</button>
</form>
<br>
<a href="{{ route('saving.index') }}">← Halaman Utama</a>