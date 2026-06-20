<h1>Transfer Saldo</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('transfer.submit') }}">
    @csrf
    
    Nomor Rekening Tujuan:
    <br>
    <input type="text" name="recipient_account" value="{{ old('recipient_account', $accountNumber ?? '') }}" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
    <br><br>
    
    Nominal Transfer (Rp):
    <br>
    <input type="number" name="amount" value="{{ old('amount') }}" min="1000" step="1000" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
    <br><br>
    
    Keterangan (Opsional):
    <br>
    <input type="text" name="description" value="{{ old('description') }}" maxlength="255" style="width: 100%; padding: 8px; margin-bottom: 10px;">
    <br><br>
    
    <button type="submit">Lanjutkan Transfer</button>
</form>

<br>
<a href="{{ route('transaction.index') }}" style="color: blue; text-decoration: underline;">Kembali ke Riwayat Transaksi</a>
