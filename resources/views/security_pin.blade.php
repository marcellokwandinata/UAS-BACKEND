<!DOCTYPE html>
<html>
<head>
    <title>Ubah PIN Keamanan</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            padding: 30px;
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
        input {
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
<h1>Ubah PIN Keamanan</h1>

@extends('layouts.app')

@section('title', 'Ubah PIN Keamanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-shield-lock"></i> Ubah PIN Keamanan</h4>
    <div class="d-flex gap-2">
        <a href="/" class="btn btn-secondary">Home</a>
        <a href="{{ route('cards_index') }}" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success"></i>
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('security.pin.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label fw-bold">PIN Saat Ini</label>
                <input type="password" name="current_pin" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">PIN Baru (6 Digit Angka)</label>
                <input type="password" name="new_pin" class="form-control"
                    maxlength="6" pattern="\d{6}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Konfirmasi PIN Baru</label>
                <input type="password" name="confirm_pin" class="form-control"
                    maxlength="6" pattern="\d{6}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan PIN Baru</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('cards_index') }}" class="text-decoration-none text-muted small">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
@endsection