<!DOCTYPE html>
<html lang="id">
<head>
    <title>Cards</title>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #1a1a2e;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 16px;
        }
        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: #e2b96f;
            margin-bottom: 32px;
            display: block;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ccc;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #e2b96f22;
            color: #e2b96f;
        }
        .main-content {
            margin-left: 240px;
            padding: 32px;
        }
        .topbar {
            background: white;
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar .page-title {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }
        .topbar .user-info {
            font-size: 0.85rem;
            color: #666;
        }

        /* Tambahan styling untuk estetika konten */
        .card {
            border-radius: 14px;
        }
        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: box-shadow 0.2s ease;
        }
        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #555;
        }
        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
            border-radius: 8px;
        }
        .btn {
            border-radius: 8px;
        }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="sidebar">
    <span class="brand"><i class="bi bi-bank2"></i> Digital Banking</span>

    <a href="{{ url('/cards') }}" class="{{ request()->is('cards*') ? 'active' : '' }}">
        <i class="bi bi-credit-card-2-front"></i> Manajemen Kartu
    </a>
    <a href="{{ url('/securities') }}" class="{{ request()->is('securities*') ? 'active' : '' }}">
        <i class="bi bi-shield-lock"></i> Keamanan
    </a>
    <a href="{{ url('/user') }}" class="{{ request()->is('user*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Pengguna
    </a>

    <div style="position: absolute; bottom: 24px; left: 16px; right: 16px;">
        @if(Route::has('logout'))
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="width:100%; background:#e2b96f22; border:none; color:#e2b96f; padding:10px 12px; border-radius:8px; text-align:left; cursor:pointer; font-size:0.9rem;">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </button>
        </form>
        @else
        <button style="width:100%; background:#e2b96f22; border:none; color:#e2b96f; padding:10px 12px; border-radius:8px; text-align:left; cursor:not-allowed; font-size:0.9rem;">
            <i class="bi bi-box-arrow-left me-2"></i> Logout (Belum diset)
        </button>
        @endif
    </div>
</div>

{{-- MAIN --}}
<div class="main-content">
    <div class="topbar">
        <span class="page-title">@yield('title', 'Dashboard')</span>
        <span class="user-info">
            <i class="bi bi-person-circle me-1"></i>
            {{ auth()->user()?->name ?? 'Guest' }}
        </span>
    </div>

    {{-- KONTEN HALAMAN --}}
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>