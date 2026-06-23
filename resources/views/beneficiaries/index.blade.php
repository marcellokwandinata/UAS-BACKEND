<!DOCTYPE html>
<html>
<head>
    <title>Daftar Beneficiary</title>

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

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background: white;
            color: black;
        }

        .btn-primary {
            background: black;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .success-box {
            background: #e6ffe6;
            color: green;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .error-box {
            background: #ffe5e5;
            color: red;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #bbb;
            text-align: left;
        }

        td a {
            color: black;
            font-weight: bold;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .action a {
            margin-right: 10px;
        }

        .delete-btn {
            background: red;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .delete-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

<div class="navbar">
    DIGITAL BANKING
</div>

<div class="container">

    <h1>Daftar Beneficiary</h1>
    <div class="subtitle">
        Kelola daftar rekening tujuan kamu.
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="success-box">
            {{ session('success') }}
        </div>
        <script>alert("{{ session('success') }}");</script>
    @endif

    {{-- ERROR --}}
    @if(session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
        <script>alert("{{ session('error') }}");</script>
    @endif

    <div class="card">

        <div class="top-bar">
            <a href="{{ route('user.index') }}" class="btn">
                ← Halaman Utama
            </a>


            <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary">
                + Tambah Beneficiary
            </a>
        </div>

        @if ($beneficiaries->isEmpty())

            <p style="text-align:center;">Belum ada beneficiary yang tersimpan.</p>

        @else

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Rekening</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($beneficiaries as $beneficiary)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <a href="{{ route('transfer.form', [
                                'account_number' => $beneficiary->account_number
                            ]) }}">
                                {{ $beneficiary->beneficiary_name }}
                            </a>
                        </td>

                        <td>
                            {{ $beneficiary->account_number }}
                        </td>

                        <td class="action">
                            <a href="{{ route('beneficiaries.edit', $beneficiary) }}">
                                Ubah
                            </a>

                            <form action="{{ route('beneficiaries.destroy', $beneficiary) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

    </div>
</div>

</body>
</html>