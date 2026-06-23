<!DOCTYPE html>
<html>
<head>
    <title>Edit Card</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            padding: 30px;
        }
        .saldo {
            margin-top: 12px;
            padding: 8px 12px;
            border: 2px solid #000;
            width: fit-content;
            font-size: 14px;
            font-weight: bold;
        }
        form {
            margin-top: 20px;
            width: 280px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 6px 8px;
            margin-top: 5px;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 1vh 2vw;
            border: 1px solid #000;
            background: #f0f0f0;
            color: black;
            text-decoration: none;
            font-size: 1vw;
            cursor: pointer;
            margin-right: 1vw;
        }
        .btn:hover {
            background: #ddd;
        }
        .btn-primary {
            background: #000;
            color: #fff;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<h1>Edit Card</h1>

<!-- BUTTON -->
<a href="/" class="btn">← Halaman Utama</a>
<a href="/cards" class="btn">Kembali ke List</a>

<!-- SALDO -->
<div class="saldo">
    💰 Saldo: Rp {{ number_format(session('balance', 5000000), 0, ',', '.') }}
</div>

<!-- FORM -->
<form action="{{ route('cards.update', $card->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <label>Nama Pemegang Kartu</label>
    <input type="text" name="cardholder_name" value="{{ $card->cardholder_name }}">

    <label>Tipe Kartu</label>
    <select name="card_type">
        <option value="debit"    {{ $card->card_type === 'debit'    ? 'selected' : '' }}>Kartu Debit</option>
        <option value="credit"   {{ $card->card_type === 'credit'   ? 'selected' : '' }}>Kartu Kredit</option>
        <option value="prepaid"  {{ $card->card_type === 'prepaid'  ? 'selected' : '' }}>Kartu Prepaid</option>
        <option value="virtual"  {{ $card->card_type === 'virtual'  ? 'selected' : '' }}>Kartu Virtual</option>
    </select>

    <label>Nomor Kartu</label>
    <input type="text" name="card_number" value="{{ $card->card_number }}" maxlength="19">

    <label>Tanggal Kedaluwarsa</label>
    <input type="text" name="expired_date" value="{{ $card->expired_date }}" maxlength="5">

    <label>Limit Kartu (Rp)</label>
    <input type="number" name="card_limit" value="{{ $card->card_limit }}">

    <label>Status</label>
    <select name="status">
        <option value="aktif"     {{ $card->status === 'aktif'     ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif"  {{ $card->status === 'nonaktif'  ? 'selected' : '' }}>Nonaktif</option>
        <option value="diblokir"  {{ $card->status === 'diblokir'  ? 'selected' : '' }}>Diblokir</option>
    </select>

    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Simpan</button>
</form>
</body>
</html>