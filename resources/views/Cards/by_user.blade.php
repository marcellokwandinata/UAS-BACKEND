<!DOCTYPE html>
<html>
<head>
    <title>Kartu Saya</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #dcdcdc;
            padding: 18px 35px;
            font-size: 28px;
            font-weight: bold;
        }

        .container {
            width: 1000px;
            margin: 30px auto;
        }

        .page-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .alert-success { color: green; margin-bottom: 15px; }
        .alert-error { color: red; margin-bottom: 15px; }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-dark { background: #222; color: white; }
        .btn-dark:hover { background: #444; }
        .btn-light { background: #dcdcdc; color: #222; }
        .btn-light:hover { background: #ccc; }
        .btn-danger { background: #e53935; color: white; font-size: 13px; padding: 7px 14px; }
        .btn-danger:hover { background: #c62828; }
        .btn-outline { background: white; color: #222; border: 1px solid #ccc; font-size: 13px; padding: 7px 14px; }
        .btn-outline:hover { background: #f0f0f0; }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        /* Kartu Visual */
        .credit-card {
            width: 100%;
            aspect-ratio: 1.586;
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        }

        .credit-card.debit {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }

        .credit-card.credit {
            background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
        }

        .credit-card.prepaid {
            background: linear-gradient(135deg, #373b44 0%, #4286f4 100%);
        }

        /* Circle decorations */
        .credit-card::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -60px;
            right: -60px;
        }

        .credit-card::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -40px;
            left: -40px;
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            z-index: 1;
        }

        .bank-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .card-type-badge {
            font-size: 12px;
            background: rgba(255,255,255,0.2);
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-chip {
            z-index: 1;
        }

        .chip {
            width: 45px;
            height: 35px;
            background: linear-gradient(135deg, #d4a843, #f0c060, #d4a843);
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .chip::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background: rgba(0,0,0,0.2);
            top: 33%;
        }

        .chip::after {
            content: '';
            position: absolute;
            width: 1px;
            height: 100%;
            background: rgba(0,0,0,0.2);
            left: 40%;
        }

        .card-number {
            font-size: 20px;
            letter-spacing: 4px;
            font-family: 'Courier New', monospace;
            z-index: 1;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .card-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            z-index: 1;
        }

        .card-holder {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .card-label {
            font-size: 10px;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-value {
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .card-expiry {
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: right;
        }

        .card-network {
            display: flex;
            align-items: center;
        }

        .circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            opacity: 0.9;
        }

        .circle-red { background: #eb1c26; margin-right: -12px; }
        .circle-orange { background: #f99f1b; }

        /* Status badge */
        .status-active {
            display: inline-block;
            background: rgba(76, 175, 80, 0.3);
            border: 1px solid rgba(76, 175, 80, 0.6);
            color: #a5d6a7;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
        }

        .status-inactive {
            display: inline-block;
            background: rgba(244, 67, 54, 0.3);
            border: 1px solid rgba(244, 67, 54, 0.6);
            color: #ef9a9a;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
        }

        /* Card wrapper with actions */
        .card-wrapper {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .card-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .card-info-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #555;
            padding: 0 4px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px;
            background: #dcdcdc;
            border-radius: 16px;
            grid-column: span 2;
        }

        .empty-state p {
            font-size: 18px;
            color: #888;
            margin-bottom: 20px;
        }

        .back-btn {
            margin-top: 30px;
        }
    </style>
</head>

<body>

<div class="navbar">DIGITAL BANKING</div>

<div class="container">

    <div class="top-bar">
        <div class="page-title">Kartu Milik {{ $user->full_name ?? $user->name }}</div>
        <a href="{{ route('create_cards') }}" class="btn btn-dark">+ Tambah Kartu Baru</a>
    </div>

    @if (session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p class="alert-error">{{ session('error') }}</p>
    @endif

    <div class="cards-grid">
        @forelse($cards as $card)
        <div class="card-wrapper">

            <!-- Visual Kartu -->
            <div class="credit-card {{ strtolower($card->card_type ?? 'debit') }}">
                <div class="card-top">
                    <div class="bank-name">Digital Banking</div>
                    <div>
                        <div class="card-type-badge">{{ $card->card_type ?? 'Debit' }}</div>
                        <div style="margin-top: 6px; text-align:right;">
                            @if(strtolower($card->status) === 'active')
                                <span class="status-active">Active</span>
                            @else
                                <span class="status-inactive">{{ ucfirst($card->status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-chip">
                    <div class="chip"></div>
                </div>

                <div class="card-number">
                    **** &nbsp; **** &nbsp; **** &nbsp; {{ substr($card->card_number ?? '0000', -4) }}
                </div>

                <div class="card-bottom">
                    <div class="card-holder">
                        <span class="card-label">Card Holder</span>
                        <span class="card-value">{{ $card->cardholder_name ?? '-' }}</span>
                    </div>

                    <div class="card-expiry">
                        <span class="card-label">Expires</span>
                        <span class="card-value">{{ $card->expired_at ?? '-' }}</span>
                    </div>

                    <div class="card-network">
                        <div class="circle circle-red"></div>
                        <div class="circle circle-orange"></div>
                    </div>
                </div>
            </div>

            <!-- Info tambahan -->
            <div class="card-info-row">
                <span>Limit: <b>
                    @if($card->card_limit)
                        Rp {{ number_format($card->card_limit, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </b></span>
            </div>

            <!-- Tombol aksi -->
            <div class="card-actions">
                <a href="{{ route('cards.setLimitForm', $card->id) }}" class="btn btn-outline">Set Limit</a>
                <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline;"
                    onsubmit="return confirm('Yakin hapus kartu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <p>Belum ada kartu terdaftar</p>
            <a href="{{ route('create_cards') }}" class="btn btn-dark">+ Tambah Kartu Pertama</a>
        </div>
        @endforelse
    </div>

    <div class="back-btn">
        <a href="{{ route('user.index') }}" class="btn btn-light">← Kembali ke Dashboard</a>
    </div>

</div>

</body>
</html>