<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA FARM CHICK</title>
    <link rel="stylesheet" href="{{ asset('assets/sidebar.css') }}">
    <style>
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #f5f7fb; color: #1f2937; }
        .app-shell { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; height: 100vh; }
        .main-panel { flex: 1; min-width: 0; }
        .main-content { margin-left: 260px; padding: 105px 35px 35px; }
        .card { background: #fff; border-radius: 14px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); margin-bottom: 20px; }
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; }
        .alert.success { background: #dcfce7; color: #166534; }
        .alert.error { background: #fee2e2; color: #991b1b; }
        .btn { display: inline-block; padding: 8px 12px; border-radius: 8px; background: linear-gradient(135deg, #c96b00, #8f4c00); color: #fff; text-decoration: none; margin-right: 6px; }
        .btn.secondary { background: #6b7280; }
        .btn.danger { background: #dc2626; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border-bottom: 1px solid #e5e7eb; padding: 10px 8px; text-align: left; }
        .table th { background: #f9fafb; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 600; color: #374151; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; }
        .search-row { display: flex; gap: 10px; margin-bottom: 12px; }
        .search-row input { flex: 1; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
        .stat { background: linear-gradient(135deg, #c96b00, #8f4c00); color: #fff; padding: 18px; border-radius: 14px; }
        .stat small { display: block; opacity: 0.9; margin-bottom: 6px; }
        .stat strong { font-size: 24px; }
        .page-title { margin: 0 0 8px; color: #1f2937; }
        .page-subtitle { color: #6b7280; margin-bottom: 18px; }
        @media (max-width: 850px) { .main-content { margin-left: 90px; padding: 95px 20px 20px; } }
        @media (max-width: 600px) { .main-content { padding: 95px 16px 16px; } }
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo IKM">
            <h1>BA FARM CHICK</h1>
        </div>
        <div class="menu">
            <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('pegawai.index') }}" class="{{ request()->routeIs('pegawai.*') ? 'active' : '' }}">Pegawai</a>
            <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">Pelanggan</a>
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">Produk</a>
            <a href="{{ route('kendaraan.index') }}" class="{{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">Kendaraan</a>
            <a href="{{ route('surat_jalan.index') }}" class="{{ request()->routeIs('surat_jalan.*') ? 'active' : '' }}">Surat Jalan</a>
            <a href="{{ route('invoice.index') }}" class="{{ request()->routeIs('invoice.*') ? 'active' : '' }}">Invoice</a>
            
            
            <a href="{{ route('logout') }}" style="color: #ffffff;">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
        </div>
    </aside>

    <div class="main-panel">
        <div class="top-navbar">
            <h2>BA FARM CHICK</h2>
            <div class="profile">
                <span>@if(session()->has('nama_pegawai')) Halo, {{ session('nama_pegawai') }} @else Admin @endif</span>
                <img src="{{ asset('img/pppp.png') }}" alt="User">
            </div>
        </div>

        <div class="main-content">
            @if(session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>