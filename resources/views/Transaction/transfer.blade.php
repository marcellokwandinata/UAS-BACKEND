<!DOCTYPE html>
<html>
<head>
    <title>Transfer Saldo</title>

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

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            height: 42px;
            border: none;
            border-radius: 8px;
            padding: 0 10px;
            font-size: 15px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: black;
        }

        .btn-primary {
            background: black;
            color: white;
        }

        .error-box {
            background: #ffe5e5;
            color: red;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .success-box {
            background: #e6ffe6;
            color: green;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Transfer Saldo</h1>
    <div class="subtitle">
        Kirim saldo ke rekening tujuan.
    </div>

    <div class="card">

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="error-box">
                <ul style="margin:0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('transfer.submit') }}">
            @csrf

            <label>Nomor Rekening Tujuan</label>
            <input type="text"
                   name="recipient_account"
                   value="{{ old('recipient_account', $accountNumber ?? '') }}"
                   required>

            <label>Nominal Transfer (Rp)</label>
            <input type="number"
                   name="amount"
                   inputmode="numeric"
                   placeholder="Contoh: 1000000"
                   value="{{ old('amount') }}"
                   required>

            <label>Keterangan (Opsional)</label>
            <input type="text"
                   name="description"
                   value="{{ old('description') }}"
                   maxlength="255">

            <div class="button-group">

                <a href="{{ route('transaction.index') }}" class="btn">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Lanjutkan Transfer
                </button>

            </div>
        </form>

    </div>
</div>

</body>
</html>