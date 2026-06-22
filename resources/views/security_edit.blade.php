<!DOCTYPE html>
<html>
<head>
    <title>Edit Security</title>
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
<h1>Edit Security</h1>

@extends('layouts.app')

@section('title', 'Ubah Keamanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-shield-lock"></i> Ubah Kartu</h4>
    <div class="d-flex gap-2">
        <a href="/" class="btn btn-secondary">Home</a>
        <a href="{{ route('security.index') }}" class="btn btn-outline-secondary">Kembali ke List</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('security.update', $security->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Pengaturan</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $security->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tipe Keamanan</label>
                <select name="type" class="form-select">
                    <option value="pin" {{ $security->type == 'pin' ? 'selected' : '' }}>PIN Transaksi</option>
                    <option value="2fa" {{ $security->type == '2fa' ? 'selected' : '' }}>Two-Factor Authentication</option>
                    <option value="password" {{ $security->type == 'password' ? 'selected' : '' }}>Password</option>
                    <option value="biometric" {{ $security->type == 'biometric' ? 'selected' : '' }}>Biometrik</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="aktif" {{ $security->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $security->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection