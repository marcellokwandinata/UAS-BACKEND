<!DOCTYPE html>
<html>
<head>
    <title>Detail Tabungan</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .navbar {
            background: #dcdcdc;
            padding: 18px 35px;
            font-size: 28px;
            font-weight: bold;
        }

        .container {
            width: 900px;
            margin: 30px auto;
        }

        h1 {
            margin-bottom: 5px;
        }

        .subtitle {
            color: gray;
            margin-bottom: 20px;
        }

        .card {
            background: #dcdcdc;
            border-radius: 10px;
            padding: 25px;
        }

        .box {
            background: white;
            border-radius: 10px;
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
        }

        .value {
            color: #555;
        }

        .success-box {
            background: #ddffdd;
            color: green;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .error-box {
            background: #ffdddd;
            color: red;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .form-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            height: 42px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            height: 45px;
            padding: 0 25px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: black;
            color: white;
        }

        .btn-danger {
            background: #ff4d4d;
            color: white;
        }

        .btn-secondary {
            background: white;
            color: black;
        }

        .progress-box {
            background: #eee;
            height: 20px;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-bar {
            background: green;
            height: 100%;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>{{ $saving->saving_name }}</h1>
    <div class="subtitle">
        Detail tabungan dan progres pencapaian target.
    </div>

    @if(session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="box">

            <div class="row">
                <div class="label">Target Dana</div>
                <div class="value">
                    Rp {{ number_format($saving->target_amount,0,',','.') }}
                </div>
            </div>

            <div class="row">
                <div class="label">Dana Terkumpul</div>
                <div class="value">
                    Rp {{ number_format($saving->current_amount,0,',','.') }}
                </div>
            </div>

            <div class="row">
                <div class="label">Target Tanggal</div>
                <div class="value">
                    {{ $saving->target_date ?? '-' }}
                </div>
            </div>

            @php
                $progress = $saving->target_amount > 0
                    ? round(($saving->current_amount / $saving->target_amount) * 100, 1)
                    : 0;
            @endphp

            <div class="row" style="display:block;">
                <div class="label">
                    Progress: {{ $progress }}%
                </div>

                <div class="progress-box">
                    <div class="progress-bar"
                         style="width: {{ min($progress,100) }}%;">
                    </div>
                </div>
            </div>

        </div>

        <div class="form-box">

            <h3>Tambah Dana</h3>

            <form action="{{ route('saving.deposit', $saving->id) }}"
                  method="POST">
                @csrf

                <label>Nominal</label>
                <input type="number"
                       name="amount"
                       min="10000"
                       placeholder="Masukkan nominal"
                       required>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        Tambah Dana
                    </button>
                </div>
            </form>

        </div>

        <div class="button-group">

            <a href="{{ route('saving.index') }}"
               class="btn btn-secondary">
                ← Kembali
            </a>

            <a href="{{ route('saving.edit', $saving->id) }}"
               class="btn btn-primary">
                Edit
            </a>

            <form action="{{ route('saving.destroy', $saving->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus tabungan ini?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Hapus
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>