<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard') – Admin Esensial</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: #f0f4f8; }
    .font-heading { font-family: 'Playfair Display', Georgia, serif; }
    .sidebar { width: 260px; min-height: 100vh; background: #072d52; transition: width 0.3s; }
    .sidebar.collapsed { width: 70px; }
    .sidebar.collapsed .nav-label, .sidebar.collapsed .brand-text, .sidebar.collapsed .user-info { display: none; }
    .sidebar.collapsed .nav-item { justify-content: center; padding: 12px; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-radius: 10px; cursor: pointer; color: rgba(255,255,255,0.6); font-size: 14px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; text-decoration: none; }
    .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
    .nav-item.active { background: #04599A; color: white; }
    .form-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); margin-bottom: 20px; }
    label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
    input[type="text"], input[type="email"], input[type="tel"], input[type="password"], input[type="number"], textarea, select {
      width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px;
      font-size: 14px; font-family: 'DM Sans', sans-serif; color: #111827;
      background: #fafafa; transition: border-color 0.2s; outline: none;
    }
    input:focus, textarea:focus, select:focus { border-color: #04599A; box-shadow: 0 0 0 3px rgba(4,89,154,0.12); background: white; }
    textarea { resize: vertical; min-height: 90px; }
    .btn-primary { background: #04599A; color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s; text-decoration: none; }
    .btn-primary:hover { background: #034580; }
    .btn-secondary { background: white; color: #374151; border: 1.5px solid #e5e7eb; padding: 9px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; text-decoration: none; }
    .btn-secondary:hover { border-color: #04599A; color: #04599A; }
    .btn-danger { background: #fee2e2; color: #dc2626; border: none; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: background 0.2s; }
    .btn-danger:hover { background: #fecaca; }
    .btn-success { background: #d1fae5; color: #059669; border: none; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; }
    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th { background: #f8fafc; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; padding: 12px 16px; text-align: left; border-bottom: 1.5px solid #e5e7eb; }
    td { padding: 12px 16px; border-bottom: 1px solid #f3f4f6; color: #374151; vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #f9fafb; }
    .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .badge-blue { background: #dbeafe; color: #1d4ed8; }
    .badge-green { background: #d1fae5; color: #065f46; }
    .badge-amber { background: #fef3c7; color: #92400e; }
    .badge-red { background: #fee2e2; color: #991b1b; }
    .badge-gray { background: #f3f4f6; color: #6b7280; }
    .upload-zone { border: 2px dashed #d1d5db; border-radius: 10px; padding: 28px; text-align: center; background: #f9fafb; cursor: pointer; transition: all 0.2s; }
    .upload-zone:hover { border-color: #04599A; background: #eff6ff; }
    .toggle { position: relative; display: inline-block; width: 42px; height: 24px; }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #d1d5db; border-radius: 24px; transition: 0.3s; }
    .toggle-slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: 0.3s; }
    input:checked + .toggle-slider { background: #04599A; }
    input:checked + .toggle-slider:before { transform: translateX(18px); }
    #toast { position: fixed; bottom: 24px; right: 24px; background: #072d52; color: white; padding: 12px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); opacity: 0; transform: translateY(10px); transition: all 0.3s; pointer-events: none; z-index: 999; }
    #toast.show { opacity: 1; transform: translateY(0); }
    @media (max-width: 768px) {
      .sidebar { position: fixed; z-index: 40; transform: translateX(-100%); }
      .sidebar.mobile-open { transform: translateX(0); }
    }
  </style>
</head>
<body class="flex min-h-screen">

  <!-- SIDEBAR -->
  <aside class="sidebar flex-shrink-0 flex flex-col" id="sidebar">
    <div class="p-5 border-b border-white/10 flex items-center gap-3">
      <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" class="h-9 w-auto rounded-lg object-contain flex-shrink-0">
      <div class="brand-text overflow-hidden">
        <div class="font-heading font-bold text-white text-sm leading-tight">ESENSIAL</div>
        <div class="text-[10px] text-blue-300 tracking-widest">ADMIN PANEL</div>
      </div>
    </div>

    <nav class="flex-1 p-3 overflow-y-auto">
      <div class="nav-label text-[10px] font-semibold text-white/30 tracking-widest px-3 mb-2 mt-2">MENU</div>

      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Dashboard</span>
      </a>
      <a href="{{ route('admin.hero') }}" class="nav-item {{ request()->routeIs('admin.hero') ? 'active' : '' }}">
        <i data-lucide="home" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Hero Section</span>
      </a>
      <a href="{{ route('admin.about') }}" class="nav-item {{ request()->routeIs('admin.about') ? 'active' : '' }}">
        <i data-lucide="user" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">About / Founder</span>
      </a>
      <a href="{{ route('admin.programs') }}" class="nav-item {{ request()->routeIs('admin.programs') ? 'active' : '' }}">
        <i data-lucide="book-open" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Program Pelatihan</span>
      </a>
      <a href="{{ route('admin.partners') }}" class="nav-item {{ request()->routeIs('admin.partners') ? 'active' : '' }}">
        <i data-lucide="building-2" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Mitra / Partner</span>
      </a>
      <a href="{{ route('admin.blog') }}" class="nav-item {{ request()->routeIs('admin.blog') ? 'active' : '' }}">
        <i data-lucide="newspaper" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Blog & Berita</span>
      </a>
      <a href="{{ route('admin.gallery') }}" class="nav-item {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
        <i data-lucide="image" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Galeri</span>
      </a>
      <a href="{{ route('admin.workshop-intensif') }}" class="nav-item {{ request()->routeIs('admin.workshop-intensif') ? 'active' : '' }}">
        <i data-lucide="presentation" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Workshop Intensif</span>
      </a>
      <a href="{{ route('admin.video-content') }}" class="nav-item {{ request()->routeIs('admin.video-content') ? 'active' : '' }}">
        <i data-lucide="video" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Video Training</span>
      </a>
      <a href="{{ route('admin.contact') }}" class="nav-item {{ request()->routeIs('admin.contact') ? 'active' : '' }}">
        <i data-lucide="phone" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Kontak</span>
      </a>

      <div class="nav-label text-[10px] font-semibold text-white/30 tracking-widest px-3 mb-2 mt-4">PENGATURAN</div>
      <a href="{{ route('admin.appearance') }}" class="nav-item {{ request()->routeIs('admin.appearance') ? 'active' : '' }}">
        <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Tampilan & Font</span>
      </a>
    </nav>

    <div class="p-4 border-t border-white/10">
      <div class="flex items-center gap-3 mb-3">
        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
          {{ substr(Auth::user()->name, 0, 1) }}
        </div>
        <div class="user-info overflow-hidden">
          <div class="text-white text-sm font-semibold leading-tight truncate">{{ Auth::user()->name }}</div>
          <div class="text-white/40 text-xs">{{ Auth::user()->email }}</div>
        </div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="w-full text-left nav-item text-red-300 hover:text-red-200 hover:bg-red-900/20">
          <i data-lucide="log-out" class="w-4 h-4 flex-shrink-0"></i>
          <span class="nav-label text-sm">Logout</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="flex-1 flex flex-col min-w-0">
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center gap-4 sticky top-0 z-30">
      <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-800">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </button>
      <h1 class="font-heading font-bold text-lg flex-1" style="color:#072d52;">@yield('title', 'Dashboard')</h1>
      <a href="{{ route('home') }}" target="_blank" class="btn-secondary" style="padding:7px 14px;font-size:13px;">
        <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Website
      </a>
    </header>

    <main class="flex-1 p-6 overflow-y-auto">

      @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm rounded-xl px-5 py-3 flex items-center gap-2">
          <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-5 py-3 flex items-center gap-2">
          <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm rounded-xl px-5 py-3">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  <!-- Toast -->
  <div id="toast">
    <i data-lucide="check-circle" class="w-4 h-4 text-green-400"></i>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    function toggleSidebar() {
      const sb = document.getElementById('sidebar');
      if (window.innerWidth < 768) {
        sb.classList.toggle('mobile-open');
      } else {
        sb.classList.toggle('collapsed');
      }
    }
    function showToast(msg) {
      const t = document.getElementById('toast');
      document.getElementById('toast-msg').textContent = msg;
      t.classList.add('show');
      setTimeout(() => t.classList.remove('show'), 3000);
    }
    lucide.createIcons();
  </script>
  @yield('scripts')
</body>
</html>