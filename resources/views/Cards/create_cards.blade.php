<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kartu</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        .back-btn {
            align-self: flex-start;
            margin-left: calc(50% - 200px);
            margin-bottom: 30px;
            color: #a0aec0;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .back-btn:hover { color: #fff; }

        /* ── KARTU ATM ── */
        .atm-card {
            width: 400px;
            height: 250px;
            border-radius: 18px;
            padding: 24px 28px 20px;
            color: white;
            margin-bottom: 32px;
            position: relative;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            overflow: hidden;
            transition: background 0.4s;
        }

        /* warna per tipe */
        .atm-card.debit   { background: linear-gradient(135deg, #1565c0, #0d47a1); }
        .atm-card.credit  { background: linear-gradient(135deg, #b71c1c, #880e4f); }
        .atm-card.prepaid { background: linear-gradient(135deg, #006064, #004d40); }
        .atm-card.virtual { background: linear-gradient(135deg, #4a148c, #1a237e); }

        /* strip gelap atas */
        .card-top-strip {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 55px;
            background: rgba(0,0,0,0.25);
            border-radius: 18px 18px 0 0;
        }

        /* bank name di strip atas */
        .bank-name {
            position: absolute;
            top: 16px;
            right: 24px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.85);
            text-transform: uppercase;
        }

        /* chip EMV */
        .chip {
            position: absolute;
            top: 72px;
            left: 28px;
            width: 48px;
            height: 38px;
            background: linear-gradient(135deg, #fdd835, #f9a825);
            border-radius: 6px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr;
            gap: 2px;
            padding: 4px;
        }
        .chip-line {
            background: rgba(180,130,0,0.5);
            border-radius: 1px;
        }
        .chip-center {
            background: rgba(180,130,0,0.8);
            border-radius: 1px;
        }

        /* nomor kartu */
        .card-number {
            position: absolute;
            top: 128px;
            left: 28px;
            font-size: 19px;
            letter-spacing: 4px;
            font-family: 'Courier New', monospace;
            color: rgba(255,255,255,0.95);
        }

        /* baris bawah */
        .card-bottom {
            position: absolute;
            bottom: 22px;
            left: 28px;
            right: 28px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .card-holder-block {}
        .card-label {
            font-size: 9px;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .card-holder-name {
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: white;
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-exp-block { text-align: right; }
        .card-exp-val {
            font-size: 14px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            color: white;
        }

        /* logo tipe kartu kanan bawah */
        .card-logo {
            position: absolute;
            bottom: 20px;
            right: 28px;
            text-align: right;
        }
        .logo-icon {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -1px;
            color: rgba(255,255,255,0.9);
        }
        .logo-sub {
            font-size: 8px;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
        }

        /* shimmer effect */
        .atm-card::after {
            content: '';
            position: absolute;
            top: -50%; left: -60%;
            width: 50%; height: 200%;
            background: linear-gradient(105deg, transparent, rgba(255,255,255,0.07), transparent);
            transform: rotate(10deg);
        }

        /* ── FORM ── */
        .form-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 32px;
            width: 400px;
        }

        .form-title {
            color: white;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            color: #90aec0;
            font-size: 12px;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: white;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }
        input::placeholder { color: rgba(255,255,255,0.25); }
        input:focus, select:focus { border-color: #4a90e2; }
        select option { background: #1a1a2e; }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1565c0, #0d47a1);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: opacity 0.2s, transform 0.1s;
            letter-spacing: 0.5px;
        }
        .btn-submit:hover  { opacity: 0.88; transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }
    </style>
</head>
<body>

<a href="javascript:history.back()" class="back-btn">← Kembali</a>

<!-- Preview Kartu ATM -->
<div class="atm-card debit" id="cardPreview">
    <div class="card-top-strip"></div>
    <div class="bank-name">DIGITAL BANKING</div>

    <!-- Chip -->
    <div class="chip">
        <div class="chip-line"></div><div class="chip-line"></div><div class="chip-line"></div>
        <div class="chip-line"></div><div class="chip-center"></div><div class="chip-line"></div>
        <div class="chip-line"></div><div class="chip-line"></div><div class="chip-line"></div>
    </div>

    <div class="card-number">**** **** **** ****</div>

    <div class="card-bottom">
        <div class="card-holder-block">
            <div class="card-label">Nama Pemegang</div>
            <div class="card-holder-name" id="previewName">NAMA ANDA</div>
        </div>
        <div style="text-align:center; margin: 0 auto;">
            <div class="card-label">Expired</div>
            <div class="card-exp-val">{{ now()->addYears(2)->format('m/Y') }}</div>
        </div>
        <div class="card-logo">
            <div class="logo-icon" id="previewLogo">DEBIT</div>
            <div class="logo-sub" id="previewSub">Digital Card</div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="form-card">
    <div class="form-title">Tambah Kartu Baru</div>

    <form action="/cards" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Pemegang Kartu</label>
            <input type="text" name="cardholder_name" id="cardholderName"
                   placeholder="Contoh: John Doe" autocomplete="off">
        </div>

        <div class="form-group">
            <label>Tipe Kartu</label>
            <select name="card_type" id="cardType">
                <option value="debit">Kartu Debit</option>
                <option value="credit">Kartu Kredit</option>
                <option value="prepaid">Kartu Prepaid</option>
                <option value="virtual">Kartu Virtual</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Simpan Kartu</button>
    </form>
</div>

<script>
    const nameInput  = document.getElementById('cardholderName');
    const typeSelect = document.getElementById('cardType');
    const prevName   = document.getElementById('previewName');
    const prevLogo   = document.getElementById('previewLogo');
    const prevSub    = document.getElementById('previewSub');
    const cardEl     = document.getElementById('cardPreview');
    const btnSubmit  = document.querySelector('.btn-submit');

    const config = {
        debit:   { logo: 'DEBIT',   sub: 'Digital Card',   btn: 'linear-gradient(135deg,#1565c0,#0d47a1)' },
        credit:  { logo: 'CREDIT',  sub: 'Digital Card',   btn: 'linear-gradient(135deg,#b71c1c,#880e4f)' },
        prepaid: { logo: 'PREPAID', sub: 'Digital Card',   btn: 'linear-gradient(135deg,#006064,#004d40)' },
        virtual: { logo: 'VIRTUAL', sub: 'Digital Card',   btn: 'linear-gradient(135deg,#4a148c,#1a237e)' },
    };

    nameInput.addEventListener('input', () => {
        prevName.textContent = nameInput.value.toUpperCase() || 'NAMA ANDA';
    });

    typeSelect.addEventListener('change', () => {
        const val = typeSelect.value;
        cardEl.className = 'atm-card ' + val;
        prevLogo.textContent = config[val].logo;
        prevSub.textContent  = config[val].sub;
        btnSubmit.style.background = config[val].btn;
    });
</script>

</body>
</html>