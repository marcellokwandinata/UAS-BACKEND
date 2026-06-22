<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>

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

        .form-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
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
            background: #f8f8f8;
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

        .btn-danger {
            background: #c62828;
            color: white;
        }

        .error-box {
            background: #ffe5e5;
            color: red;
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

    <h1>Edit Profil</h1>
    <div class="subtitle">
        Perbarui informasi akun Anda.
    </div>

    <div class="card">

        <div class="form-box">

            @if ($errors->any())
                <div class="error-box">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')

                <label>Nama Lengkap</label>
                <input type="text"
                       name="full_name"
                       value="{{ old('full_name', $user->full_name) }}"
                       required>

                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required>

                <div class="button-group">

                    <a href="{{ route('user.index') }}" class="btn">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                </div>
            </form>

            <form action="{{ route('user.destroy', $user->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin hapus akun ini?')"
                  style="margin-top:15px;">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Hapus Akun
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>