<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin – Esensial Training & Consulting</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: #f0f4f8; }
    .font-heading { font-family: 'Playfair Display', Georgia, serif; }

    /* Sidebar */
    .sidebar { width: 260px; min-height: 100vh; background: #072d52; transition: width 0.3s; }
    .sidebar.collapsed { width: 70px; }
    .sidebar.collapsed .nav-label, .sidebar.collapsed .brand-text, .sidebar.collapsed .user-info { display: none; }
    .sidebar.collapsed .nav-item { justify-content: center; padding: 12px; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-radius: 10px; cursor: pointer; color: rgba(255,255,255,0.6); font-size: 14px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; }
    .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
    .nav-item.active { background: #04599A; color: white; }

    /* Content panels */
    .panel { display: none; }
    .panel.active { display: block; }

    /* Cards */
    .stat-card { background: white; border-radius: 14px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); }
    .form-card { background: white; border-radius: 14px; padding: 24px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); margin-bottom: 20px; }

    /* Form elements */
    label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
    input[type="text"], input[type="email"], input[type="tel"], textarea, select {
      width: 100%; padding: 9px 12px; border: 1.5px solid #e5e7eb; border-radius: 8px;
      font-size: 14px; font-family: 'DM Sans', sans-serif; color: #111827;
      background: #fafafa; transition: border-color 0.2s, box-shadow 0.2s; outline: none;
    }
    input:focus, textarea:focus, select:focus { border-color: #04599A; box-shadow: 0 0 0 3px rgba(4,89,154,0.12); background: white; }
    textarea { resize: vertical; min-height: 90px; }

    /* Buttons */
    .btn-primary { background: #04599A; color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s; }
    .btn-primary:hover { background: #034580; }
    .btn-secondary { background: white; color: #374151; border: 1.5px solid #e5e7eb; padding: 9px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; }
    .btn-secondary:hover { border-color: #04599A; color: #04599A; }
    .btn-danger { background: #fee2e2; color: #dc2626; border: none; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: background 0.2s; }
    .btn-danger:hover { background: #fecaca; }
    .btn-success { background: #d1fae5; color: #059669; border: none; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: background 0.2s; }

    /* Table */
    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th { background: #f8fafc; color: #6b7280; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; padding: 12px 16px; text-align: left; border-bottom: 1.5px solid #e5e7eb; }
    td { padding: 12px 16px; border-bottom: 1px solid #f3f4f6; color: #374151; vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #f9fafb; }

    /* Badge */
    .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .badge-blue { background: #dbeafe; color: #1d4ed8; }
    .badge-green { background: #d1fae5; color: #065f46; }
    .badge-amber { background: #fef3c7; color: #92400e; }
    .badge-red { background: #fee2e2; color: #991b1b; }
    .badge-gray { background: #f3f4f6; color: #6b7280; }

    /* Toggle */
    .toggle { position: relative; display: inline-block; width: 42px; height: 24px; }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background: #d1d5db; border-radius: 24px; transition: 0.3s; }
    .toggle-slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background: white; border-radius: 50%; transition: 0.3s; }
    input:checked + .toggle-slider { background: #04599A; }
    input:checked + .toggle-slider:before { transform: translateX(18px); }

    /* Toast notification */
    #toast { position: fixed; bottom: 24px; right: 24px; background: #072d52; color: white; padding: 12px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.2); opacity: 0; transform: translateY(10px); transition: all 0.3s; pointer-events: none; z-index: 999; }
    #toast.show { opacity: 1; transform: translateY(0); }

    /* Section heading */
    .section-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #072d52; margin: 0 0 4px 0; }
    .section-sub { font-size: 14px; color: #6b7280; margin: 0 0 24px 0; }

    /* Upload area */
    .upload-zone { border: 2px dashed #d1d5db; border-radius: 10px; padding: 28px; text-align: center; background: #f9fafb; cursor: pointer; transition: all 0.2s; }
    .upload-zone:hover { border-color: #04599A; background: #eff6ff; }

    /* Image preview */
    .img-preview { width: 80px; height: 60px; object-fit: cover; border-radius: 6px; border: 1.5px solid #e5e7eb; }

    /* Tabs inside panel */
    .inner-tab { padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; color: #6b7280; background: transparent; border: 1.5px solid transparent; transition: all 0.2s; }
    .inner-tab.active { background: #04599A; color: white; }

    @media (max-width: 768px) {
      .sidebar { position: fixed; z-index: 40; transform: translateX(-100%); }
      .sidebar.mobile-open { transform: translateX(0); }
    }
  </style>
</head>
<body class="flex">

  <!-- SIDEBAR -->
  <aside class="sidebar flex-shrink-0 flex flex-col" id="sidebar">
    <!-- Brand -->
    <div class="p-5 border-b border-white/10 flex items-center gap-3">
      <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" width="2225" height="1095" class="h-9 w-auto rounded-lg object-contain flex-shrink-0">
      <div class="brand-text overflow-hidden">
        <div class="font-heading font-bold text-white text-sm leading-tight">ESENSIAL</div>
        <div class="text-[10px] text-blue-300 tracking-widest">ADMIN PANEL</div>
      </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 p-3 overflow-y-auto">
      <div class="nav-label text-[10px] font-semibold text-white/30 tracking-widest px-3 mb-2 mt-2">MENU</div>
      <div class="nav-item active" onclick="switchPanel('dashboard')">
        <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Dashboard</span>
      </div>
      <div class="nav-item" onclick="switchPanel('hero')">
        <i data-lucide="home" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Hero Section</span>
      </div>
      <div class="nav-item" onclick="switchPanel('about')">
        <i data-lucide="user" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">About / Founder</span>
      </div>
      <div class="nav-item" onclick="switchPanel('programs')">
        <i data-lucide="book-open" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Program Pelatihan</span>
      </div>
      <div class="nav-item" onclick="switchPanel('partners')">
        <i data-lucide="building-2" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Mitra / Partner</span>
      </div>
      <div class="nav-item" onclick="switchPanel('blog')">
        <i data-lucide="newspaper" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Blog & Berita</span>
      </div>
      <div class="nav-item" onclick="switchPanel('gallery')">
        <i data-lucide="image" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Galeri</span>
      </div>
      <div class="nav-item" onclick="switchPanel('contact')">
        <i data-lucide="phone" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Kontak</span>
      </div>
      <div class="nav-label text-[10px] font-semibold text-white/30 tracking-widest px-3 mb-2 mt-4">PENGATURAN</div>
      <div class="nav-item" onclick="switchPanel('settings')">
        <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Pengaturan Tampilan</span>
      </div>
      <div class="nav-item" onclick="switchPanel('users')">
        <i data-lucide="users" class="w-5 h-5 flex-shrink-0"></i>
        <span class="nav-label">Manajemen User</span>
      </div>
    </nav>

    <!-- User -->
    <div class="p-4 border-t border-white/10 flex items-center gap-3">
      <img src="{{ asset('images/founder.png') }}" alt="Faris Isnawan" class="w-8 h-8 rounded-full object-cover flex-shrink-0 border border-white/20">
      <div class="user-info overflow-hidden">
        <div class="text-white text-sm font-semibold leading-tight truncate">Faris Isnawan</div>
        <div class="text-white/40 text-xs">Super Admin</div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Top bar -->
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center gap-4 sticky top-0 z-30">
      <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-800">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </button>
      <h1 id="page-title" class="font-heading font-bold text-navy-900 text-lg flex-1" style="color:#072d52;">Dashboard</h1>
      <a href="#" class="btn-secondary text-sm" style="padding:7px 14px;">
        <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Website
      </a>
    </header>

    <!-- Content -->
    <main class="flex-1 p-6 overflow-y-auto">

      <!-- ===================== DASHBOARD ===================== -->
      <div id="panel-dashboard" class="panel active">
        <p class="section-title">Selamat datang, Faris 👋</p>
        <p class="section-sub">Ringkasan konten website Esensial Training & Consulting</p>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          <div class="stat-card">
            <div class="flex items-center justify-between mb-3">
              <span class="text-gray-500 text-sm">Program Aktif</span>
              <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center"><i data-lucide="book-open" class="w-4 h-4 text-blue-600"></i></div>
            </div>
            <div class="text-2xl font-bold" style="color:#072d52;">8</div>
            <div class="text-xs text-green-600 font-medium mt-1">Semua aktif</div>
          </div>
          <div class="stat-card">
            <div class="flex items-center justify-between mb-3">
              <span class="text-gray-500 text-sm">Artikel Blog</span>
              <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center"><i data-lucide="newspaper" class="w-4 h-4 text-amber-600"></i></div>
            </div>
            <div class="text-2xl font-bold" style="color:#072d52;">3</div>
            <div class="text-xs text-gray-400 font-medium mt-1">Draft: 1</div>
          </div>
          <div class="stat-card">
            <div class="flex items-center justify-between mb-3">
              <span class="text-gray-500 text-sm">Mitra</span>
              <div class="w-9 h-9 rounded-lg bg-teal-50 flex items-center justify-center"><i data-lucide="building-2" class="w-4 h-4 text-teal-600"></i></div>
            </div>
            <div class="text-2xl font-bold" style="color:#072d52;">6</div>
            <div class="text-xs text-gray-400 font-medium mt-1">Ditampilkan: 6</div>
          </div>
          <div class="stat-card">
            <div class="flex items-center justify-between mb-3">
              <span class="text-gray-500 text-sm">Galeri Foto</span>
              <div class="w-9 h-9 rounded-lg bg-pink-50 flex items-center justify-center"><i data-lucide="image" class="w-4 h-4 text-pink-600"></i></div>
            </div>
            <div class="text-2xl font-bold" style="color:#072d52;">10</div>
            <div class="text-xs text-gray-400 font-medium mt-1">Foto & Video</div>
          </div>
        </div>

        <!-- Quick actions -->
        <div class="form-card">
          <h3 class="font-heading font-bold text-base mb-4" style="color:#072d52;">Aksi Cepat</h3>
          <div class="grid sm:grid-cols-3 gap-3">
            <button class="btn-primary" onclick="switchPanel('blog')"><i data-lucide="plus" class="w-4 h-4"></i> Tambah Artikel</button>
            <button class="btn-secondary" onclick="switchPanel('gallery')"><i data-lucide="upload" class="w-4 h-4"></i> Upload Galeri</button>
            <button class="btn-secondary" onclick="switchPanel('hero')"><i data-lucide="edit-3" class="w-4 h-4"></i> Edit Hero</button>
          </div>
        </div>

        <!-- Activity log -->
        <div class="form-card">
          <h3 class="font-heading font-bold text-base mb-4" style="color:#072d52;">Log Aktivitas Terakhir</h3>
          <div class="space-y-3">
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0"><i data-lucide="edit-3" class="w-3.5 h-3.5 text-blue-600"></i></div>
              <div class="flex-1"><span class="font-medium text-gray-800">Hero section diperbarui</span><span class="text-gray-400"> · 2 jam lalu</span></div>
            </div>
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0"><i data-lucide="plus" class="w-3.5 h-3.5 text-green-600"></i></div>
              <div class="flex-1"><span class="font-medium text-gray-800">Artikel baru ditambahkan</span><span class="text-gray-400"> · 1 hari lalu</span></div>
            </div>
            <div class="flex items-center gap-3 text-sm">
              <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0"><i data-lucide="upload" class="w-3.5 h-3.5 text-amber-600"></i></div>
              <div class="flex-1"><span class="font-medium text-gray-800">5 foto galeri diupload</span><span class="text-gray-400"> · 3 hari lalu</span></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ===================== HERO ===================== -->
      <div id="panel-hero" class="panel">
        <p class="section-title">Hero Section</p>
        <p class="section-sub">Edit tampilan utama halaman beranda</p>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Konten Teks</h3>
          <div class="grid gap-5">
            <div>
              <label>Judul Utama (Hero Title)</label>
              <input type="text" value="ESENSIAL TRAINING & CONSULTING" placeholder="Judul hero">
            </div>
            <div>
              <label>Tagline</label>
              <input type="text" value="Professional Skills Excellent" placeholder="Tagline hero">
            </div>
            <div>
              <label>Deskripsi Singkat</label>
              <textarea>Lembaga jasa pelatihan profesional yang melayani berbagai instansi mulai dari swasta hingga perusahaan. Didirikan pada 06 September 2017 oleh Faris Isnawan.</textarea>
            </div>
            <div>
              <label>Teks Tombol CTA</label>
              <input type="text" value="Lihat Program" placeholder="Teks tombol">
            </div>
            <div>
              <label>Link Tombol CTA</label>
              <input type="text" value="#program" placeholder="URL tujuan tombol">
            </div>
          </div>
        </div>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Foto Founder (Hero)</h3>
          <div class="upload-zone">
            <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
            <p class="text-sm text-gray-500 font-medium">Klik atau drag foto founder</p>
            <p class="text-xs text-gray-400 mt-1">PNG, JPG — maks 5MB · Rekomendasi 400×500px</p>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="btn-primary" onclick="showToast('Hero section berhasil disimpan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
          <button class="btn-secondary">Reset</button>
        </div>
      </div>

      <!-- ===================== ABOUT ===================== -->
      <div id="panel-about" class="panel">
        <p class="section-title">About / Founder</p>
        <p class="section-sub">Kelola informasi founder dan tim Esensial Training</p>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Profil Founder</h3>
          <div class="grid sm:grid-cols-2 gap-5">
            <div>
              <label>Nama Lengkap</label>
              <input type="text" value="Faris Isnawan, S.Pd., M.Pd.">
            </div>
            <div>
              <label>Jabatan</label>
              <input type="text" value="Founder & CEO">
            </div>
            <div class="sm:col-span-2">
              <label>Foto Profil</label>
              <div class="upload-zone">
                <i data-lucide="user" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                <p class="text-sm text-gray-500">Upload foto profil founder</p>
                <p class="text-xs text-gray-400 mt-1">Rekomendasi 400×400px (persegi)</p>
              </div>
            </div>
            <div>
              <label>Instagram</label>
              <input type="text" value="faris_isnawan">
            </div>
            <div>
              <label>WhatsApp</label>
              <input type="tel" value="6285713014064">
            </div>
          </div>
        </div>
        <div class="form-card">
          <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Sertifikasi</h3>
            <button class="btn-success" onclick="addCertRow()"><i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah</button>
          </div>
          <div id="cert-list" class="space-y-2">
            <div class="flex gap-2 items-center"><input type="text" value="Certified Professional Trainer – BNSP RI" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
            <div class="flex gap-2 items-center"><input type="text" value="Certified Trainer & Master Neo NLP" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
            <div class="flex gap-2 items-center"><input type="text" value="Certified Hypnotist & Hypnotherapist" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
            <div class="flex gap-2 items-center"><input type="text" value="Certified Praktisi Talents Mapping" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
            <div class="flex gap-2 items-center"><input type="text" value="Certified Master Service Excellence" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
            <div class="flex gap-2 items-center"><input type="text" value="Certified Public Speaking" class="flex-1"><button class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div>
          </div>
        </div>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Statistik Pengalaman</h3>
          <div class="grid sm:grid-cols-3 gap-4">
            <div>
              <label>Instansi Korporasi</label>
              <input type="text" value="35+" placeholder="mis. 35+">
            </div>
            <div>
              <label>Instansi Pemerintah</label>
              <input type="text" value="60+" placeholder="mis. 60+">
            </div>
            <div>
              <label>Instansi Pendidikan</label>
              <input type="text" value="200+" placeholder="mis. 200+">
            </div>
          </div>
        </div>
        <button class="btn-primary" onclick="showToast('Data founder berhasil disimpan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
      </div>

      <!-- ===================== PROGRAMS ===================== -->
      <div id="panel-programs" class="panel">
        <p class="section-title">Program Pelatihan</p>
        <p class="section-sub">Kelola kartu program pelatihan yang ditampilkan</p>
        <div class="form-card p-0 overflow-hidden">
          <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Daftar Program</h3>
            <button class="btn-success" onclick="showAddProgram()"><i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Program</button>
          </div>
          <table>
            <thead>
              <tr>
                <th>No</th><th>Nama Program</th><th>Icon</th><th>Deskripsi</th><th>Status</th><th>Aksi</th>
              </tr>
            </thead>
            <tbody id="programs-tbody">
              <tr>
                <td>1</td>
                <td class="font-medium text-gray-800">Pelatihan TIK Swasta</td>
                <td><span class="badge badge-blue">monitor</span></td>
                <td class="text-gray-500 max-w-xs truncate">Pelatihan Kerja Teknologi Informasi dan Komunikasi untuk instansi swasta</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td>
                  <div class="flex gap-2">
                    <button class="btn-success" onclick="showToast('Mode edit program')"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button>
                    <button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td class="font-medium text-gray-800">Pelatihan TIK Perusahaan</td>
                <td><span class="badge badge-blue">cpu</span></td>
                <td class="text-gray-500 max-w-xs truncate">Pelatihan Kerja Teknologi Informasi dan Komunikasi untuk perusahaan</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td>
                  <div class="flex gap-2">
                    <button class="btn-success" onclick="showToast('Mode edit program')"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button>
                    <button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td class="font-medium text-gray-800">Bisnis & Manajemen Swasta</td>
                <td><span class="badge badge-amber">bar-chart-2</span></td>
                <td class="text-gray-500 max-w-xs truncate">Pelatihan Kerja Bisnis dan Manajemen untuk instansi swasta</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td>
                  <div class="flex gap-2">
                    <button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button>
                    <button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td class="font-medium text-gray-800">Bisnis & Manajemen Perusahaan</td>
                <td><span class="badge badge-blue">building-2</span></td>
                <td class="text-gray-500 max-w-xs truncate">Pelatihan Kerja Bisnis dan Manajemen untuk perusahaan</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td>
                  <div class="flex gap-2">
                    <button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button>
                    <button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td class="font-medium text-gray-800">Event Khusus</td>
                <td><span class="badge badge-gray">calendar</span></td>
                <td class="text-gray-500 max-w-xs truncate">Jasa Penyelenggara Event Khusus yang profesional dan berkualitas</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td>
                  <div class="flex gap-2">
                    <button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button>
                    <button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Add Program Form -->
        <div id="add-program-form" class="form-card hidden">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tambah Program Baru</h3>
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label>Nama Program</label>
              <input type="text" placeholder="Nama program pelatihan">
            </div>
            <div>
              <label>Icon (Lucide)</label>
              <input type="text" placeholder="mis. book-open, star, users">
            </div>
            <div class="sm:col-span-2">
              <label>Deskripsi</label>
              <textarea placeholder="Deskripsi singkat program..."></textarea>
            </div>
            <div>
              <label>Status</label>
              <select>
                <option>Aktif</option>
                <option>Nonaktif</option>
                <option>Draft</option>
              </select>
            </div>
            <div>
              <label>Urutan Tampil</label>
              <input type="text" placeholder="mis. 1, 2, 3">
            </div>
          </div>
          <div class="flex gap-3 mt-4">
            <button class="btn-primary" onclick="showToast('Program berhasil ditambahkan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan Program</button>
            <button class="btn-secondary" onclick="document.getElementById('add-program-form').classList.add('hidden')">Batal</button>
          </div>
        </div>
      </div>

      <!-- ===================== PARTNERS ===================== -->
      <div id="panel-partners" class="panel">
        <p class="section-title">Mitra / Partner</p>
        <p class="section-sub">Kelola logo dan nama instansi mitra yang tampil di website</p>
        <div class="form-card p-0 overflow-hidden">
          <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Daftar Mitra</h3>
            <button class="btn-success"><i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Mitra</button>
          </div>
          <table>
            <thead>
              <tr><th>No</th><th>Logo</th><th>Nama Instansi</th><th>Website</th><th>Tampilkan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><div class="w-14 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div></td>
                <td class="font-medium">PT. Mitaka</td>
                <td class="text-gray-400">–</td>
                <td><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>2</td>
                <td><div class="w-14 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div></td>
                <td class="font-medium">PT. Chickin Indonesia</td>
                <td class="text-gray-400">–</td>
                <td><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>3</td>
                <td><div class="w-14 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div></td>
                <td class="font-medium">Kementerian PUPR</td>
                <td class="text-gray-400">–</td>
                <td><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>4</td>
                <td><div class="w-14 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div></td>
                <td class="font-medium">UIN Riau</td>
                <td class="text-gray-400">–</td>
                <td><label class="toggle"><input type="checkbox" checked><span class="toggle-slider"></span></label></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>5</td>
                <td><div class="w-14 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div></td>
                <td class="font-medium">MAN 1 Surakarta</td>
                <td class="text-gray-400">–</td>
                <td><label class="toggle"><input type="checkbox"><span class="toggle-slider"></span></label></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ===================== BLOG ===================== -->
      <div id="panel-blog" class="panel">
        <p class="section-title">Blog & Berita</p>
        <p class="section-sub">Kelola artikel, berita, dan postingan blog</p>
        <div class="flex gap-3 mb-6">
          <button class="inner-tab active" onclick="switchInnerTab(this,'blog')">Semua Artikel</button>
          <button class="inner-tab" onclick="switchInnerTab(this,'blog')">Tulis Baru</button>
        </div>

        <!-- Article list -->
        <div class="form-card p-0 overflow-hidden">
          <table>
            <thead>
              <tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="font-medium text-gray-800">Workshop Service Excellence di Kementerian PUPR</div>
                  <div class="text-xs text-gray-400 mt-0.5">Pelatihan service excellence bersama Kementerian PUPR...</div>
                </td>
                <td><span class="badge badge-blue">Workshop</span></td>
                <td class="text-gray-400 text-sm">12 Jan 2025</td>
                <td><span class="badge badge-green">Publish</span></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>
                  <div class="font-medium text-gray-800">Pelatihan SDM di PT. Chickin Indonesia</div>
                  <div class="text-xs text-gray-400 mt-0.5">Program pengembangan sumber daya manusia...</div>
                </td>
                <td><span class="badge badge-amber">Training</span></td>
                <td class="text-gray-400 text-sm">8 Jan 2025</td>
                <td><span class="badge badge-green">Publish</span></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
              <tr>
                <td>
                  <div class="font-medium text-gray-800">Seminar Motivasi di SMK Negeri 6 Surakarta</div>
                  <div class="text-xs text-gray-400 mt-0.5">Membangun semangat dan motivasi siswa...</div>
                </td>
                <td><span class="badge badge-gray">Pendidikan</span></td>
                <td class="text-gray-400 text-sm">3 Jan 2025</td>
                <td><span class="badge badge-red">Draft</span></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Write form -->
        <div class="form-card mt-4">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tulis Artikel Baru</h3>
          <div class="grid gap-4">
            <div>
              <label>Judul Artikel</label>
              <input type="text" placeholder="Judul artikel yang menarik...">
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label>Kategori</label>
                <select><option>Workshop</option><option>Training</option><option>Pendidikan</option><option>Event</option></select>
              </div>
              <div>
                <label>Status</label>
                <select><option>Draft</option><option>Publish</option></select>
              </div>
            </div>
            <div>
              <label>Thumbnail / Cover</label>
              <div class="upload-zone">
                <i data-lucide="image" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                <p class="text-sm text-gray-500">Upload gambar cover artikel</p>
                <p class="text-xs text-gray-400 mt-1">JPG, PNG · maks 3MB · 1200×630px</p>
              </div>
            </div>
            <div>
              <label>Konten Artikel</label>
              <textarea style="min-height:160px;" placeholder="Tulis konten artikel di sini..."></textarea>
            </div>
          </div>
          <div class="flex gap-3 mt-4">
            <button class="btn-primary" onclick="showToast('Artikel berhasil disimpan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan Artikel</button>
            <button class="btn-secondary">Batal</button>
          </div>
        </div>
      </div>

      <!-- ===================== GALLERY ===================== -->
      <div id="panel-gallery" class="panel">
        <p class="section-title">Galeri</p>
        <p class="section-sub">Kelola foto dan video dokumentasi kegiatan</p>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Upload Media Baru</h3>
          <div class="upload-zone mb-4">
            <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
            <p class="text-sm text-gray-500 font-medium">Drag & drop atau klik untuk memilih file</p>
            <p class="text-xs text-gray-400 mt-1">JPG, PNG, MP4 · maks 20MB per file</p>
          </div>
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label>Judul / Keterangan</label>
              <input type="text" placeholder="Keterangan foto/video...">
            </div>
            <div>
              <label>Kategori</label>
              <select>
                <option>Workshop</option>
                <option>Training Korporasi</option>
                <option>Training Pemerintah</option>
                <option>Pendidikan</option>
                <option>Event</option>
              </select>
            </div>
          </div>
          <button class="btn-primary mt-4" onclick="showToast('Media berhasil diupload!')"><i data-lucide="upload" class="w-4 h-4"></i> Upload</button>
        </div>

        <!-- Gallery grid -->
        <div class="form-card">
          <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Media Tersimpan</h3>
            <select style="width:auto;padding:6px 10px;font-size:13px;">
              <option>Semua Kategori</option>
              <option>Workshop</option>
              <option>Training Korporasi</option>
            </select>
          </div>
          <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
            <div class="relative group">
              <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                <i data-lucide="image" class="w-8 h-8 text-gray-300"></i>
              </div>
              <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button class="w-8 h-8 bg-white rounded-lg flex items-center justify-center"><i data-lucide="eye" class="w-3.5 h-3.5 text-gray-700"></i></button>
                <button class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center"><i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i></button>
              </div>
              <p class="text-xs text-gray-400 mt-1 truncate">Foto 1</p>
            </div>
            <div class="relative group">
              <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                <i data-lucide="video" class="w-8 h-8 text-gray-300"></i>
              </div>
              <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button class="w-8 h-8 bg-white rounded-lg flex items-center justify-center"><i data-lucide="eye" class="w-3.5 h-3.5 text-gray-700"></i></button>
                <button class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center"><i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i></button>
              </div>
              <p class="text-xs text-gray-400 mt-1 truncate">Video 1</p>
            </div>
            <div class="relative group">
              <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                <i data-lucide="image" class="w-8 h-8 text-gray-300"></i>
              </div>
              <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button class="w-8 h-8 bg-white rounded-lg flex items-center justify-center"><i data-lucide="eye" class="w-3.5 h-3.5 text-gray-700"></i></button>
                <button class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center"><i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i></button>
              </div>
              <p class="text-xs text-gray-400 mt-1 truncate">Foto 2</p>
            </div>
            <div class="relative group">
              <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                <i data-lucide="image" class="w-8 h-8 text-gray-300"></i>
              </div>
              <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                <button class="w-8 h-8 bg-white rounded-lg flex items-center justify-center"><i data-lucide="eye" class="w-3.5 h-3.5 text-gray-700"></i></button>
                <button class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center"><i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i></button>
              </div>
              <p class="text-xs text-gray-400 mt-1 truncate">Foto 3</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ===================== CONTACT ===================== -->
      <div id="panel-contact" class="panel">
        <p class="section-title">Kontak</p>
        <p class="section-sub">Kelola informasi kontak yang tampil di website</p>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Informasi Kontak</h3>
          <div class="grid gap-4">
            <div>
              <label>Nomor WhatsApp</label>
              <input type="tel" value="6285713014064" placeholder="Format: 62xxxx (tanpa +)">
            </div>
            <div>
              <label>Instagram</label>
              <input type="text" value="esensial.trainingconsulting" placeholder="Username tanpa @">
            </div>
            <div>
              <label>Email</label>
              <input type="email" value="esensialtraining@gmail.com">
            </div>
            <div>
              <label>Alamat Lengkap</label>
              <textarea>Jl. Srikoyo, Kemasan, Ngadirejo, Kec. Kartasura, Kab. Sukoharjo, Jawa Tengah 57163</textarea>
            </div>
          </div>
          <button class="btn-primary mt-4" onclick="showToast('Kontak berhasil disimpan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan</button>
        </div>
      </div>

      <!-- ===================== SETTINGS ===================== -->
      <div id="panel-settings" class="panel">
        <p class="section-title">Pengaturan Tampilan</p>
        <p class="section-sub">Kustomisasi warna, font, dan tampilan website</p>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Warna Brand</h3>
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label>Warna Utama (Primary)</label>
              <div class="flex gap-2">
                <input type="color" value="#04599A" style="width:42px;height:38px;padding:2px;border-radius:8px;border:1.5px solid #e5e7eb;cursor:pointer;">
                <input type="text" value="#04599A" style="flex:1;">
              </div>
            </div>
            <div>
              <label>Warna Aksen</label>
              <div class="flex gap-2">
                <input type="color" value="#d4af37" style="width:42px;height:38px;padding:2px;border-radius:8px;border:1.5px solid #e5e7eb;cursor:pointer;">
                <input type="text" value="#d4af37" style="flex:1;">
              </div>
            </div>
            <div>
              <label>Warna Background</label>
              <div class="flex gap-2">
                <input type="color" value="#072d52" style="width:42px;height:38px;padding:2px;border-radius:8px;border:1.5px solid #e5e7eb;cursor:pointer;">
                <input type="text" value="#072d52" style="flex:1;">
              </div>
            </div>
            <div>
              <label>Warna Teks</label>
              <div class="flex gap-2">
                <input type="color" value="#ffffff" style="width:42px;height:38px;padding:2px;border-radius:8px;border:1.5px solid #e5e7eb;cursor:pointer;">
                <input type="text" value="#ffffff" style="flex:1;">
              </div>
            </div>
          </div>
        </div>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tipografi</h3>
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label>Font Heading</label>
              <select>
                <option selected>Playfair Display</option>
                <option>Merriweather</option>
                <option>Lora</option>
                <option>DM Serif Display</option>
              </select>
            </div>
            <div>
              <label>Font Body</label>
              <select>
                <option selected>DM Sans</option>
                <option>Poppins</option>
                <option>Nunito</option>
              </select>
            </div>
            <div>
              <label>Ukuran Font Dasar</label>
              <select>
                <option>14px</option>
                <option selected>16px</option>
                <option>18px</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-card">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">SEO & Meta</h3>
          <div class="grid gap-4">
            <div>
              <label>Title Website</label>
              <input type="text" value="Esensial Training & Consulting">
            </div>
            <div>
              <label>Meta Description</label>
              <textarea style="min-height:70px;">Lembaga jasa pelatihan profesional yang melayani berbagai instansi mulai dari swasta hingga perusahaan.</textarea>
            </div>
            <div>
              <label>Favicon URL</label>
              <input type="text" placeholder="https://...">
            </div>
          </div>
        </div>
        <button class="btn-primary" onclick="showToast('Pengaturan berhasil disimpan!')"><i data-lucide="save" class="w-4 h-4"></i> Simpan Semua Pengaturan</button>
      </div>

      <!-- ===================== USERS ===================== -->
      <div id="panel-users" class="panel">
        <p class="section-title">Manajemen User</p>
        <p class="section-sub">Kelola akun admin yang dapat mengakses dashboard ini</p>

        <div class="form-card p-0 overflow-hidden">
          <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Daftar Admin</h3>
            <button class="btn-success"><i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Admin</button>
          </div>
          <table>
            <thead>
              <tr><th>Nama</th><th>Email</th><th>Role</th><th>Terakhir Login</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="flex items-center gap-2">
                    <img src="{{ asset('images/founder.png') }}" alt="Faris Isnawan" class="w-8 h-8 rounded-full object-cover border border-gray-200">
                    <span class="font-medium">Faris Isnawan</span>
                  </div>
                </td>
                <td class="text-gray-500">esensialtraining@gmail.com</td>
                <td><span class="badge badge-blue">Super Admin</span></td>
                <td class="text-gray-400 text-sm">Hari ini</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button></td>
              </tr>
              <tr>
                <td>
                  <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-teal-500 flex items-center justify-center text-white text-xs font-bold">A</div>
                    <span class="font-medium">Admin Konten</span>
                  </div>
                </td>
                <td class="text-gray-500">admin@esensialtraining.com</td>
                <td><span class="badge badge-gray">Editor</span></td>
                <td class="text-gray-400 text-sm">3 hari lalu</td>
                <td><span class="badge badge-green">Aktif</span></td>
                <td><div class="flex gap-2"><button class="btn-success"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i></button><button class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button></div></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="form-card mt-4">
          <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Ganti Password</h3>
          <div class="grid gap-4 max-w-md">
            <div>
              <label>Password Lama</label>
              <input type="password" placeholder="••••••••">
            </div>
            <div>
              <label>Password Baru</label>
              <input type="password" placeholder="••••••••">
            </div>
            <div>
              <label>Konfirmasi Password Baru</label>
              <input type="password" placeholder="••••••••">
            </div>
          </div>
          <button class="btn-primary mt-4" onclick="showToast('Password berhasil diubah!')"><i data-lucide="lock" class="w-4 h-4"></i> Ganti Password</button>
        </div>
      </div>

    </main>
  </div>

  <!-- Toast -->
  <div id="toast">
    <i data-lucide="check-circle" class="w-4 h-4 text-green-400"></i>
    <span id="toast-msg">Berhasil disimpan!</span>
  </div>

  <script>
    const panelTitles = {
      dashboard: 'Dashboard',
      hero: 'Hero Section',
      about: 'About / Founder',
      programs: 'Program Pelatihan',
      partners: 'Mitra / Partner',
      blog: 'Blog & Berita',
      gallery: 'Galeri',
      contact: 'Kontak',
      settings: 'Pengaturan Tampilan',
      users: 'Manajemen User'
    };

    function switchPanel(name) {
      document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
      document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
      document.getElementById('panel-' + name).classList.add('active');
      document.getElementById('page-title').textContent = panelTitles[name] || name;
      event?.currentTarget?.classList.add('active');
      // Close mobile menu
      document.getElementById('sidebar').classList.remove('mobile-open');
    }

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

    function addCertRow() {
      const list = document.getElementById('cert-list');
      const div = document.createElement('div');
      div.className = 'flex gap-2 items-center';
      div.innerHTML = '<input type="text" placeholder="Nama sertifikasi..." class="flex-1"><button class="btn-danger" onclick="this.closest(\'div\').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>';
      list.appendChild(div);
      lucide.createIcons();
    }

    function showAddProgram() {
      const form = document.getElementById('add-program-form');
      form.classList.toggle('hidden');
    }

    function switchInnerTab(btn, group) {
      document.querySelectorAll('.inner-tab').forEach(t => t.classList.remove('active'));
      btn.classList.add('active');
    }

    lucide.createIcons();
  </script>
</body>
</html>