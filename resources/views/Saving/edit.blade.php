<!DOCTYPE html>
<html>
<head>
    <title>Edit Tabungan</title>

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
            width: 700px;
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
            padding: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        .button-group {
            margin-top: 20px;
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

        .btn-secondary {
            background: white;
            color: black;
        }

        .error-box {
            background: #ffe5e5;
            color: red;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Edit Tabungan</h1>
    <div class="subtitle">
        Ubah target dan informasi tabungan.
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="box">

            <form action="{{ route('saving.update', $saving->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <label>Nama Tabungan</label>
                <input
                    type="text"
                    name="saving_name"
                    value="{{ old('saving_name', $saving->saving_name) }}"
                    required>

                <label>Target Dana</label>
                <input
                    type="number"
                    name="target_amount"
                    value="{{ old('target_amount', $saving->target_amount) }}"
                    required>

                <label>Target Tanggal</label>
                <input
                    type="date"
                    name="target_date"
                    value="{{ old('target_date', $saving->target_date) }}">

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('saving.show', $saving->id) }}"
                       class="btn btn-secondary">
                        ← Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>