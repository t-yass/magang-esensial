<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $s['site_title'] ?? 'Esensial Training & Consulting' }}</title>
  <meta name="description" content="{{ $s['site_description'] ?? '' }}">

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

  {{-- Dynamic Google Fonts based on admin settings --}}
  @php
    $fontHeading = $s['font_heading'] ?? 'Playfair Display';
    $fontBody    = $s['font_body']    ?? 'DM Sans';
    $fontSize    = (int)($s['font_size'] ?? 16);
    $fontQuery   = urlencode($fontHeading) . ':wght@400;700;900&family=' . urlencode($fontBody) . ':wght@300;400;500;600;700';

    $colorPrimary = $s['color_primary']    ?? '#04599A';
    $colorAccent  = $s['color_accent']     ?? '#d4af37';
    $colorBg      = $s['color_background'] ?? '#072d52';
    $colorNavbar  = $s['navbar_color']     ?? $colorPrimary;
    $colorFooter  = $s['footer_color']     ?? $colorBg;
    $colorText    = $s['color_text']       ?? '#ffffff';

    $founderPhoto = !empty($s['founder_photo'])
      ? asset('storage/' . $s['founder_photo'])
      : asset('images/founder.png');
  @endphp

  <link href="https://fonts.googleapis.com/css2?family={{ $fontQuery }}&display=swap" rel="stylesheet">

  <style>
    html, body { height: 100%; margin: 0; }
    * { box-sizing: border-box; }

    :root {
      --color-primary:    {{ $colorPrimary }};
      --color-accent:     {{ $colorAccent }};
      --color-bg:         {{ $colorBg }};
      --color-navbar:     {{ $colorNavbar }};
      --color-footer:     {{ $colorFooter }};
      --color-text:       {{ $colorText }};
      --font-heading:     '{{ $fontHeading }}', Georgia, serif;
      --font-body:        '{{ $fontBody }}', sans-serif;
      --font-size-base:   {{ $fontSize }}px;
    }

    body {
      font-family: var(--font-body);
      font-size: var(--font-size-base);
      background: linear-gradient(to bottom, #ffffff 0%, #ffffff 60%, var(--color-primary) 100%) fixed;
    }
    .font-heading { font-family: var(--font-heading); }

    html { scroll-behavior: smooth; }

    .hero-overlay { background: transparent; position: relative; overflow: hidden; }
    .hero-overlay::before {
      content: '';
      position: absolute;
      top: -50%; right: -30%;
      width: 80%; height: 200%;
      background: radial-gradient(ellipse, rgba(4,89,154,0.15) 0%, transparent 70%);
      pointer-events: none;
    }

    .program-card { transition: transform 0.3s, box-shadow 0.3s; }
    .program-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }

    .btn-cta { transition: all 0.3s ease; }
    .btn-cta:hover { background-color: white !important; color: #051f3a !important; }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.7s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; } .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; } .delay-4 { animation-delay: 0.4s; }
    .delay-5 { animation-delay: 0.5s; }

    .nav-link { position: relative; }
    .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: var(--color-primary); transition: width 0.3s; }
    .nav-link:hover::after { width: 100%; }

    .section-divider { background: linear-gradient(90deg, transparent, rgba(4,89,154,0.3), transparent); height: 1px; }

    .gallery-item { transition: transform 0.4s, box-shadow 0.4s; }
    .gallery-item:hover { transform: scale(1.03); box-shadow: 0 15px 35px rgba(0,0,0,0.2); }

    .cert-badge { background: linear-gradient(135deg, #072d52, #0a3f6f); border-left: 3px solid var(--color-primary); }

    .partner-logo { background: #ffffff; border: 1px solid rgba(4,89,154,0.15); transition: all 0.3s; }
    .partner-logo:hover { border-color: rgba(4,89,154,0.4); }

    .mobile-menu { transition: transform 0.3s ease, opacity 0.3s ease; transform: translateX(100%); opacity: 0; }
    .mobile-menu.open { transform: translateX(0); opacity: 1; }

    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .hide-scrollbar::-webkit-scrollbar { display: none; }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            navy: { 900: '#051f3a', 800: '#072d52', 700: '#0a3f6f', 600: '#04599A' },
            blue: { 400: '#0a7acc', 500: '#04599A', 600: '#034580' },
          }
        }
      }
    }
  </script>
</head>
<body class="h-full text-white overflow-auto" id="app-body">

  <!-- NAVBAR -->
  <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" style="background:var(--color-navbar);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 sm:h-20">
        <div class="flex items-center gap-3">
          <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" class="h-10 w-auto sm:h-12 rounded-lg object-contain">
          <div class="hidden sm:block">
            <div class="font-heading font-bold text-sm text-white transition-colors duration-300" id="nav-brand">ESENSIAL</div>
            <div id="nav-tagline" class="text-[10px] text-sky-200 tracking-widest">TRAINING & CONSULTING</div>
          </div>
        </div>
        <div class="hidden md:flex items-center gap-8">
          <a href="#home"    class="nav-link text-sm font-medium text-white/80 hover:text-white tracking-wide">Home</a>
          <a href="#about"   class="nav-link text-sm font-medium text-white/80 hover:text-white tracking-wide">About</a>
          <a href="#program" class="nav-link text-sm font-medium text-white/80 hover:text-white tracking-wide">Program</a>
          <a href="#blog"    class="nav-link text-sm font-medium text-white/80 hover:text-white tracking-wide">Blog</a>
          <a href="#contact" id="nav-contact-btn" class="px-5 py-2 border border-white text-white font-semibold text-sm rounded-lg hover:bg-white hover:text-navy-900 transition-colors">
            Hubungi Kami
          </a>
        </div>
        <button id="mobile-menu-btn" class="md:hidden text-white p-2"><i data-lucide="menu" class="w-6 h-6"></i></button>
      </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 w-72 h-full shadow-2xl md:hidden z-50" style="background:var(--color-navbar);">
      <div class="p-6">
        <button id="mobile-close-btn" class="mb-8 text-white/60 hover:text-white"><i data-lucide="x" class="w-6 h-6"></i></button>
        <div class="flex flex-col gap-6">
          <a href="#home"    class="mobile-nav-link text-lg font-medium text-white/80">Home</a>
          <a href="#about"   class="mobile-nav-link text-lg font-medium text-white/80">About Us</a>
          <a href="#program" class="mobile-nav-link text-lg font-medium text-white/80">Program</a>
          <a href="#blog"    class="mobile-nav-link text-lg font-medium text-white/80">Blog</a>
          <a href="#contact" class="px-5 py-2 border border-white text-white font-semibold text-sm rounded-lg hover:bg-white hover:text-navy-900 transition-colors">Hubungi Kami</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section id="home" class="hero-overlay relative min-h-[600px] flex items-center pt-20">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 w-full">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="animate-fade-up delay-1">
            <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-black leading-tight mb-4 text-navy-900">
              {{ $s['hero_title'] ?? 'ESENSIAL TRAINING & CONSULTING' }}
            </h1>
          </div>
          <div class="animate-fade-up delay-2">
            <p class="font-semibold text-lg sm:text-xl tracking-wider mb-6" style="color:var(--color-primary);">
              {{ $s['hero_tagline'] ?? 'Professional Skills Excellent' }}
            </p>
          </div>
          <div class="animate-fade-up delay-3">
            <p class="text-navy-900/70 text-base sm:text-lg leading-relaxed mb-8 max-w-lg">
              {{ $s['hero_description'] ?? '' }}
            </p>
          </div>
          <div class="animate-fade-up delay-4">
            <a href="{{ $s['hero_cta_link'] ?? '#program' }}"
               class="btn-cta px-8 py-3.5 font-bold rounded-lg border border-transparent transition-all text-white"
               style="background:var(--color-primary);">
              {{ $s['hero_cta_text'] ?? 'Lihat Program' }}
            </a>
          </div>
        </div>
        <div class="hidden lg:flex justify-center pt-10">
          <div class="relative">
            <div class="w-80 h-96 rounded-2xl bg-gradient-to-br from-navy-700 to-navy-800 border border-white/10 flex items-end justify-center overflow-hidden">
              <img src="{{ $founderPhoto }}" alt="{{ $s['founder_name'] ?? 'Founder' }}" class="h-full w-auto object-contain">
            </div>
            <div class="absolute -top-10 -right-10 w-24 bg-white p-3 rounded-xl shadow-2xl z-20 animate-fade-up delay-5 border border-navy-900/5">
              <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" class="w-full h-auto object-contain">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- WORKSHOP INTENSIF -->
  @if($workshop && $workshop->is_visible)
  <section class="bg-transparent py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">Workshop Intensif</h2>
        <p class="font-semibold text-lg tracking-wide text-sky-500">SERVICE EXCELLENCE</p>
      </div>
      <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <p class="text-navy-900/70 text-base leading-relaxed mb-6">{{ $workshop->description ?? 'Pelatihan yang diikuti oleh berbagai instansi untuk dapat mewujudkan sebuah pelayanan yang memuaskan dan tak terlupakan bagi para client, serta meningkatkan citra positif instansi di antara para kompetitor yang ada.' }}</p>
          <div class="flex flex-wrap gap-3 mb-8">
            @if($workshop->taglines)
              @foreach($workshop->taglines as $tagline)
                <span class="px-4 py-1.5 bg-sky-50 border border-sky-100 rounded-full text-sky-600 text-sm font-medium">{{ $tagline }}</span>
              @endforeach
            @else
              <span class="px-4 py-1.5 bg-sky-50 border border-sky-100 rounded-full text-sky-600 text-sm font-medium">Pelayanan Prima</span>
              <span class="px-4 py-1.5 bg-sky-50 border border-sky-100 rounded-full text-sky-600 text-sm font-medium">Citra Positif</span>
              <span class="px-4 py-1.5 bg-sky-50 border border-sky-100 rounded-full text-sky-600 text-sm font-medium">Kompetitif</span>
              <span class="px-4 py-1.5 bg-sky-50 border border-sky-100 rounded-full text-sky-600 text-sm font-medium">Profesional</span>
            @endif
          </div>
        </div>
        <!-- Activity photos grid -->
        <div class="grid grid-cols-2 gap-3">
          @php
            $photos = $workshop->visiblePhotos()->limit(4)->get();
            $icons = ['presentation', 'users', 'mic', 'award'];
          @endphp
          @if($photos->isNotEmpty())
            @foreach($photos as $index => $photo)
              <div class="rounded-xl h-40 flex items-center justify-center border border-navy-900/5 shadow-sm overflow-hidden bg-white">
                <img src="{{ asset('storage/'.$photo->file_path) }}" alt="{{ $photo->alt_text }}" class="w-full h-full object-cover">
              </div>
            @endforeach
            @for($i = count($photos); $i < 4; $i++)
              <div class="rounded-xl bg-white h-40 flex items-center justify-center border border-navy-900/5 shadow-sm">
                <div class="text-center">
                  <i data-lucide="{{ $icons[$i] }}" class="w-10 h-10 text-blue-500/20 mx-auto mb-2"></i>
                  <span class="text-navy-900/40 text-xs font-medium">Foto Kegiatan {{ $i + 1 }}</span>
                </div>
              </div>
            @endfor
          @else
            @for($i = 0; $i < 4; $i++)
              <div class="rounded-xl bg-white h-40 flex items-center justify-center border border-navy-900/5 shadow-sm">
                <div class="text-center">
                  <i data-lucide="{{ $icons[$i] }}" class="w-10 h-10 text-blue-500/20 mx-auto mb-2"></i>
                  <span class="text-navy-900/40 text-xs font-medium">Foto Kegiatan {{ $i + 1 }}</span>
                </div>
              </div>
            @endfor
          @endif
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- PARTNERS -->
  @if($partners->isNotEmpty())
  <section style="background:var(--color-primary);" class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <p class="text-center text-white/40 text-sm tracking-widest uppercase mb-8">Dipercaya Oleh Berbagai Instansi</p>
      <div class="flex justify-center gap-4 overflow-x-auto hide-scrollbar pb-4 scroll-smooth">
        <div class="flex gap-4 flex-shrink-0 snap-x snap-mandatory">
          @foreach($partners as $partner)
            <div class="partner-logo rounded-xl h-20 w-32 flex items-center justify-center shadow-sm overflow-hidden flex-shrink-0 snap-center">
              @if($partner->logo_path)
                <img src="{{ asset('storage/'.$partner->logo_path) }}" alt="{{ $partner->name }}" class="h-12 w-auto object-contain px-2">
              @else
                <span class="text-navy-900/60 font-semibold text-xs text-center px-2">{{ $partner->name }}</span>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- VIDEO TRAINING & TESTIMONIAL -->
  <section class="bg-transparent py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-8 text-navy-900">Video Training</h2>
      @if($trainings->isNotEmpty())
        <div class="relative max-w-[350px] mx-auto">
          <div id="training-carousel" class="flex overflow-x-scroll snap-x snap-mandatory scroll-smooth rounded-2xl border border-white/5 shadow-2xl hide-scrollbar">
            @foreach($trainings as $video)
              <div class="flex-none w-full h-[480px] bg-navy-700 overflow-hidden relative snap-center">
                @if($video->source_type === 'upload' && $video->file_path)
                  <video src="{{ asset('storage/'.$video->file_path) }}" class="w-full h-full object-cover" controls data-video-type="training"></video>
                @elseif($video->url)
                  @php
                    $url = $video->url;
                    if (str_contains($url, 'instagram.com')) {
                      $url = strtok($url, '?'); // Hapus parameter query seperti ?igsh=...
                      $url = rtrim($url, '/') . '/embed'; // Tambahkan suffix /embed
                    }
                  @endphp
                  <iframe src="{{ $url }}" width="100%" height="560" frameborder="0" scrolling="no" allowtransparency="true" allowfullscreen="true" title="Video Training {{ $video->title ?? $loop->iteration }}" class="absolute top-0 left-0"></iframe>
                @else
                  <div class="w-full h-full flex items-center justify-center text-white/70">Video tidak tersedia</div>
                @endif
              </div>
            @endforeach
          </div>
          <button id="prev-training" class="absolute top-1/2 -translate-y-1/2 left-2 bg-white/30 backdrop-blur-sm p-2 rounded-full text-white hover:bg-white/50 transition-colors z-10"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
          <button id="next-training" class="absolute top-1/2 -translate-y-1/2 right-2 bg-white/30 backdrop-blur-sm p-2 rounded-full text-white hover:bg-white/50 transition-colors z-10"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
        </div>
      @else
        <a href="#contact" class="aspect-video bg-navy-800/40 rounded-2xl border border-white/10 overflow-hidden shadow-2xl flex items-center justify-center group cursor-pointer relative">
          <div class="absolute inset-0 bg-navy-900/20 group-hover:bg-navy-900/40 transition-colors duration-300"></div>
          <div class="relative z-10 flex flex-col items-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-blue-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
              <i data-lucide="play" class="w-8 h-8 text-white fill-current"></i>
            </div>
            <p class="mt-4 text-white/70 font-semibold tracking-wide uppercase text-xs sm:text-sm">Lihat Cuplikan Pelatihan</p>
          </div>
        </a>
      @endif
    </div>
  </section>

  <section class="bg-transparent py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-8 text-navy-900">Video Testimoni</h2>
      <div class="relative max-w-[350px] mx-auto">
        <div id="video-carousel" class="flex overflow-x-scroll snap-x snap-mandatory scroll-smooth rounded-2xl border border-white/5 shadow-2xl hide-scrollbar">
          @forelse($testimonials as $video)
            <div class="flex-none w-full h-[480px] bg-navy-700 overflow-hidden relative snap-center">
              @if($video->source_type === 'upload' && $video->file_path)
                <video src="{{ asset('storage/'.$video->file_path) }}" class="w-full h-full object-cover" controls data-video-type="testimonial"></video>
              @elseif($video->url)
                @php
                  $url = $video->url;
                  if (str_contains($url, 'instagram.com')) {
                    $url = strtok($url, '?'); // Hapus parameter query seperti ?igsh=...
                    $url = rtrim($url, '/') . '/embed'; // Tambahkan suffix /embed
                  }
                @endphp
                <iframe src="{{ $url }}" width="100%" height="560" frameborder="0" scrolling="no" allowtransparency="true" allowfullscreen="true" title="Video Testimoni {{ $video->title ?? $loop->iteration }}" class="absolute top-0 left-0"></iframe>
              @else
                <div class="w-full h-full flex items-center justify-center text-white/70">Video tidak tersedia</div>
              @endif
            </div>
          @empty
            <div class="flex-none w-full h-[480px] bg-navy-700 overflow-hidden relative snap-center flex items-center justify-center text-white/70">
              Belum ada video testimoni tersedia.
            </div>
          @endforelse
        </div>
        <button id="prev-video" class="absolute top-1/2 -translate-y-1/2 left-2 bg-white/30 backdrop-blur-sm p-2 rounded-full text-white hover:bg-white/50 transition-colors z-10"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
        <button id="next-video" class="absolute top-1/2 -translate-y-1/2 right-2 bg-white/30 backdrop-blur-sm p-2 rounded-full text-white hover:bg-white/50 transition-colors z-10"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
      </div>
    </div>
  </section>

  {{--
  ============================================================
  SECTION: ABOUT US — gantikan section #about di welcome.blade.php
  Sinkron penuh dengan:
    - SiteSetting (founder_name, founder_position, founder_photo, founder_instagram, founder_whatsapp)
    - Certification (certs)
    - BusinessOwnership (businesses)
    - TrainingExperience (experiences)

  Di WelcomeController / route, pastikan pass variabel:
    $businesses = \App\Models\BusinessOwnership::orderBy('role')->orderBy('sort_order')->get();
    $experiences = \App\Models\TrainingExperience::orderBy('sort_order')->get();
  ============================================================
--}}

{{-- ── ABOUT ──────────────────────────────────────────────────────────────── --}}
<section id="about" class="bg-transparent py-16 sm:py-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Heading --}}
    <div class="text-center mb-16">
      <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">About Us</h2>
      <p class="text-navy-900/70 font-bold">Kenali founder dan tim di balik Esensial Training</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-10">

      {{-- ── FOUNDER CARD ─────────────────────────────────────────────────── --}}
      <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl p-6 border border-navy-900/5 text-center sticky top-24 shadow-xl">
          <div class="w-36 h-36 rounded-full bg-navy-800 mx-auto mb-4 flex items-center justify-center border-2 border-navy-600/30 overflow-hidden">
            <img src="{{ $founderPhoto }}"
                 alt="{{ $s['founder_name'] ?? 'Founder' }}"
                 class="w-full h-full object-cover object-top">
          </div>
          <h3 class="font-heading text-xl font-bold mb-1 text-navy-900">
            {{ $s['founder_name'] ?? 'Faris Isnawan, S.Pd., M.Pd.' }}
          </h3>
          <p class="text-blue-600 text-sm font-semibold mb-4">
            {{ $s['founder_position'] ?? 'Founder & CEO' }}
          </p>
          <div class="flex flex-col gap-2 text-sm text-gray-600 mb-6">
            <span>Professional Trainer</span>
            <span>Konsultan SDM</span>
            <span>Praktisi Pendidikan</span>
          </div>
          <div class="flex justify-center gap-3">
            <a href="https://instagram.com/{{ $s['founder_instagram'] ?? 'faris_isnawan' }}"
               target="_blank" rel="noopener noreferrer"
               class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-blue-50 transition-colors"
               aria-label="Instagram">
              <i data-lucide="instagram" class="w-4 h-4 text-gray-600"></i>
            </a>
            <a href="https://wa.me/{{ $s['founder_whatsapp'] ?? '6285713014064' }}"
               target="_blank" rel="noopener noreferrer"
               class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-blue-50 transition-colors"
               aria-label="WhatsApp">
              <i data-lucide="phone" class="w-4 h-4 text-gray-600"></i>
            </a>
          </div>
          @if(!empty($s['founder_whatsapp']))
          <p class="text-gray-400 text-xs mt-4">
            📞 0{{ substr($s['founder_whatsapp'], 2) }}
          </p>
          @endif
          @if(!empty($s['founder_instagram']))
          <p class="text-gray-400 text-xs mt-1">
            📸 {{ '@' . $s['founder_instagram'] }}
          </p>
          @endif
        </div>
      </div>

      {{-- ── RIGHT COLUMN ─────────────────────────────────────────────────── --}}
      <div class="lg:col-span-2 space-y-8">

        {{-- Sertifikasi & Keahlian --}}
        @if($certs->isNotEmpty())
        <div>
          <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color: var(--color-primary);">
            <i data-lucide="shield-check" class="w-5 h-5"></i> Sertifikasi &amp; Keahlian
          </h3>
          <div class="grid sm:grid-cols-2 gap-3">
            @foreach($certs->where('is_visible', true) as $cert)
              <div class="cert-badge rounded-lg p-4">
                <span class="text-sm text-white/90 font-medium">{{ $cert->title }}</span>
                @if(!empty($cert->subtitle))
                  <span class="block text-xs text-white/50 mt-0.5">{{ $cert->subtitle }}</span>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        @endif

        {{-- Kepemilikan Bisnis --}}
        @if(isset($businesses) && $businesses->isNotEmpty())
        <div>
          <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2 text-white">
            <i data-lucide="briefcase" class="w-5 h-5"></i> Kepemilikan Bisnis
          </h3>
          <div class="bg-white rounded-xl p-5 border border-navy-900/5 space-y-4 shadow-md">
            @php
              $owners   = $businesses->where('role','owner')->where('is_visible',true);
              $founders = $businesses->where('role','founder')->where('is_visible',true);
            @endphp

            @if($owners->isNotEmpty())
            <div>
              <p class="text-gray-400 text-xs uppercase tracking-wider mb-2">Owner</p>
              <p class="text-navy-900 font-medium text-sm">
                {{ $owners->pluck('entity_name')->implode(' • ') }}
              </p>
            </div>
            @endif

            @if($founders->isNotEmpty())
            <div>
              <p class="text-gray-400 text-xs uppercase tracking-wider mb-2">Founder</p>
              <p class="text-navy-900 font-medium text-sm">
                {{ $founders->pluck('entity_name')->implode(' • ') }}
              </p>
            </div>
            @endif
          </div>
        </div>
        @endif

        {{-- Pengalaman Pelatihan --}}
        @if(isset($experiences) && $experiences->isNotEmpty())
        <div>
          <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color: var(--color-primary);">
            <i data-lucide="trending-up" class="w-5 h-5"></i> Pengalaman Pelatihan
          </h3>
          <div class="space-y-4">
            @foreach($experiences->where('is_visible', true) as $exp)
              <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                <div class="flex items-center gap-3 mb-3">
                  <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">
                    {{ $exp->stat_label }}
                  </span>
                  <span class="text-navy-900 font-bold">{{ $exp->category }}</span>
                </div>
                @if(!empty($exp->description))
                  <p class="text-gray-600 text-sm">{{ $exp->description }}</p>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        @else
          {{-- Fallback ke SiteSetting lama jika belum migrasi --}}
          <div>
            <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color: var(--color-primary);">
              <i data-lucide="trending-up" class="w-5 h-5"></i> Pengalaman Pelatihan
            </h3>
            <div class="space-y-4">
              <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                <div class="flex items-center gap-3">
                  <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">{{ $s['stat_corporate'] ?? '35+' }}</span>
                  <span class="text-navy-900 font-bold">Instansi Korporasi</span>
                </div>
              </div>
              <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                <div class="flex items-center gap-3">
                  <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">{{ $s['stat_government'] ?? '60+' }}</span>
                  <span class="text-navy-900 font-bold">Instansi Pemerintah</span>
                </div>
              </div>
              <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                <div class="flex items-center gap-3">
                  <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">{{ $s['stat_education'] ?? '200+' }}</span>
                  <span class="text-navy-900 font-bold">Instansi Pendidikan</span>
                </div>
              </div>
            </div>
          </div>
        @endif

      </div>{{-- /right col --}}
    </div>
  </div>
</section>

  <!-- PROGRAMS -->
  <section id="program" class="bg-transparent py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">Program Pelatihan</h2>
        <p class="text-navy-900/70 font-bold max-w-2xl mx-auto">Beragam program pelatihan profesional yang dirancang untuk meningkatkan kompetensi SDM instansi Anda</p>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($programs as $program)
          <div class="program-card bg-white rounded-xl p-6 border border-navy-900/5 shadow-lg">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mb-4" style="background:color-mix(in srgb,var(--color-primary) 10%,white);">
              <i data-lucide="{{ $program->icon }}" class="w-6 h-6" style="color:var(--color-primary);"></i>
            </div>
            <h3 class="font-heading font-bold text-base mb-2 text-navy-900">{{ $program->name }}</h3>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $program->description }}</p>
          </div>
        @empty
          <p class="col-span-4 text-center text-white/50 py-8">Belum ada program tersedia.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- BLOG -->
  @if($posts->isNotEmpty())
  <section id="blog" class="bg-transparent py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">Blog</h2>
        <p class="text-navy-900/70 font-bold">Berita terkini dan galeri kegiatan</p>
      </div>

      {{-- Tabs --}}
      <div class="flex justify-center gap-3 mb-10">
        <button class="tab-btn px-6 py-2.5 rounded-lg font-semibold text-sm border transition-all bg-[var(--color-primary)] text-white border-[var(--color-primary)]" data-tab="news" onclick="switchTab('news', this)">News</button>
        <button class="tab-btn px-6 py-2.5 rounded-lg font-semibold text-sm border transition-all bg-white text-navy-900 border-[var(--color-primary)]" data-tab="gallery" onclick="switchTab('gallery', this)">Gallery</button>
      </div>

      <div id="tab-news">
        <div class="flex justify-center gap-6 overflow-x-auto hide-scrollbar pb-4 snap-x snap-mandatory scroll-smooth">
          @foreach($posts as $post)
            <article class="flex-none w-[min(100%,320px)] max-w-[320px] bg-white rounded-xl overflow-hidden border border-navy-900/5 hover:border-blue-500/20 transition-colors shadow-md snap-start">
              @if($post->thumbnail_path)
                <img src="{{ asset('storage/'.$post->thumbnail_path) }}" alt="{{ $post->title }}" class="h-44 w-full object-cover">
              @else
                <div class="h-44 bg-gray-50 flex items-center justify-center border-b border-gray-100">
                  <i data-lucide="newspaper" class="w-10 h-10 text-blue-500/20"></i>
                </div>
              @endif
              <div class="p-5">
                <span class="text-blue-600 text-xs font-bold uppercase tracking-wider">{{ $post->category }}</span>
                <h4 class="font-heading font-bold mt-2 mb-2 text-navy-900">{{ $post->title }}</h4>
                <p class="text-gray-600 text-sm line-clamp-2">{{ $post->excerpt }}</p>
              </div>
            </article>
          @endforeach
        </div>
      </div>

      <div id="tab-gallery" class="hidden">
        @if($gallery->isNotEmpty())
          <div class="flex justify-center items-center">
            <div class="flex gap-4 pb-4 hide-scrollbar snap-x flex-wrap justify-center max-w-5xl">
              @foreach($gallery as $item)
                <div class="flex-none w-64 sm:w-72 aspect-square rounded-xl overflow-hidden shadow-md snap-start gallery-item">
                  @if($item->type === 'image')
                    <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                  @else
                    <video src="{{ asset('storage/'.$item->file_path) }}" class="w-full h-full object-cover" muted loop></video>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
        @else
          <p class="text-center text-white/50 py-8">Belum ada foto/video galeri.</p>
        @endif
      </div>
    </div>
  </section>
  @endif

  <!-- CONTACT -->
  <section id="contact" class="bg-transparent py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">Contact Us</h2>
        <p class="text-navy-900/70 font-bold max-w-2xl mx-auto leading-relaxed">
          Mari berkolaborasi dengan Esensial Training & Consulting guna mewujudkan sumber daya manusia instansi yang berkualitas dan berdaya saing tinggi.
        </p>
      </div>
      <div class="grid sm:grid-cols-3 gap-5">
        <a href="https://instagram.com/{{ $s['contact_instagram'] ?? 'esensial.trainingconsulting' }}" target="_blank"
           class="bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="instagram" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">Instagram</p>
          <p class="text-gray-600 text-xs">{{ '@' . ($s['contact_instagram'] ?? 'esensial.trainingconsulting') }}</p>
        </a>

        <a href="https://wa.me/{{ $s['contact_whatsapp'] ?? '6285713014064' }}" target="_blank"
           class="bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="phone" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">WhatsApp</p>
          <p class="text-gray-600 text-xs">
            @php
              $wa = $s['contact_whatsapp'] ?? '6285713014064';
              echo '0' . substr($wa, 2);
            @endphp
          </p>
        </a>

        <a href="mailto:{{ $s['contact_email'] ?? 'esensialtraining@gmail.com' }}"
           class="bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="mail" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">Email</p>
          <p class="text-gray-600 text-xs">{{ $s['contact_email'] ?? 'esensialtraining@gmail.com' }}</p>
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="border-t border-white/10" style="background: var(--color-footer);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" class="h-10 w-auto rounded-lg object-contain">
            <div>
              <div class="font-heading font-bold text-sm">ESENSIAL TRAINING & CONSULTING</div>
              <div class="text-xs tracking-wider text-sky-400">Professional Skills Excellent</div>
            </div>
          </div>
          <p class="text-white/40 text-sm leading-relaxed">Mewujudkan sumber daya manusia yang berkualitas dan berdaya saing tinggi.</p>
        </div>
        <div>
          <h4 class="font-heading font-bold text-sm mb-4">Alamat</h4>
          <p class="text-white/50 text-sm leading-relaxed">
            <i data-lucide="map-pin" class="w-4 h-4 inline mr-1"></i>
            {{ $s['contact_address'] ?? '' }}
          </p>
        </div>
        <div>
          <h4 class="font-heading font-bold text-sm mb-4">Hubungi Kami</h4>
          <div class="space-y-2 text-sm text-white/50">
            <p><i data-lucide="instagram" class="w-4 h-4 inline mr-1"></i> {{ '@' . ($s['contact_instagram'] ?? '') }}</p>
            <p><i data-lucide="phone" class="w-4 h-4 inline mr-1"></i> {{ $s['contact_whatsapp'] ?? '' }}</p>
            <p><i data-lucide="mail" class="w-4 h-4 inline mr-1"></i> {{ $s['contact_email'] ?? '' }}</p>
          </div>
        </div>
      </div>
      <div class="section-divider mt-10 mb-6"></div>
      <p class="text-center text-white/30 text-xs">© {{ date('Y') }} Esensial Training & Consulting. All rights reserved.</p>
    </div>
  </footer>

  <script>
    // Tab switching
    function switchTab(tab, button) {
      // Hide all tabs
      document.getElementById('tab-news').classList.add('hidden');
      document.getElementById('tab-gallery').classList.add('hidden');

      // Show selected tab
      document.getElementById('tab-' + tab).classList.remove('hidden');

      // Reset all tab buttons to inactive style
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-[var(--color-primary)]', 'text-white');
        btn.classList.add('bg-white', 'text-navy-900');
      });

      // Set active button style
      button.classList.remove('bg-white', 'text-navy-900');
      button.classList.add('bg-[var(--color-primary)]', 'text-white');
    }

    // Mobile menu
    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.add('open');
    });
    document.getElementById('mobile-close-btn').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.remove('open');
    });
    document.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => document.getElementById('mobile-menu').classList.remove('open'));
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
      const nav     = document.getElementById('main-nav');
      const brand   = document.getElementById('nav-brand');
      const tagline = document.getElementById('nav-tagline');
      const contactBtn = document.getElementById('nav-contact-btn');
      const links   = document.querySelectorAll('.nav-link');
      const menuBtn = document.getElementById('mobile-menu-btn');

      if (window.scrollY > 50) {
        nav.style.background = 'rgba(4,89,154,0.95)';
        nav.style.backdropFilter = 'blur(12px)';
        nav.style.boxShadow = '0 2px 20px rgba(0,0,0,0.3)';
        brand?.classList.replace('text-navy-900','text-white');
        tagline?.classList.replace('text-blue-600','text-white/80');
        contactBtn?.classList.replace('border-blue-600','border-white');
        contactBtn?.classList.replace('text-blue-600','text-white');
        menuBtn?.classList.replace('text-navy-900','text-white');
        links.forEach(l => l.classList.replace('text-navy-900/80','text-white/80'));
      } else {
        nav.style.background = 'transparent';
        nav.style.backdropFilter = 'none';
        nav.style.boxShadow = 'none';
        brand?.classList.replace('text-white','text-navy-900');
        tagline?.classList.replace('text-white/80','text-blue-600');
        contactBtn?.classList.replace('border-white','border-blue-600');
        contactBtn?.classList.replace('text-white','text-blue-600');
        menuBtn?.classList.replace('text-white','text-navy-900');
        links.forEach(l => l.classList.replace('text-white/80','text-navy-900/80'));
      }
    });

    const videoCarousel = document.getElementById('video-carousel');
    if (videoCarousel) {
      const prevButton = document.getElementById('prev-video');
      const nextButton = document.getElementById('next-video');

      prevButton?.addEventListener('click', () => {
        videoCarousel.scrollBy({ left: -videoCarousel.clientWidth, behavior: 'smooth' });
      });

      nextButton?.addEventListener('click', () => {
        videoCarousel.scrollBy({ left: videoCarousel.clientWidth, behavior: 'smooth' });
      });
    }

    const trainingCarousel = document.getElementById('training-carousel');
    if (trainingCarousel) {
      const prevButton = document.getElementById('prev-training');
      const nextButton = document.getElementById('next-training');

      prevButton?.addEventListener('click', () => {
        trainingCarousel.scrollBy({ left: -trainingCarousel.clientWidth, behavior: 'smooth' });
      });

      nextButton?.addEventListener('click', () => {
        trainingCarousel.scrollBy({ left: trainingCarousel.clientWidth, behavior: 'smooth' });
      });
    }

    // Prevent double play - only one video can play at a time
    const allVideos = document.querySelectorAll('video[data-video-type]');
    allVideos.forEach(video => {
      video.addEventListener('play', () => {
        // Pause all other videos
        allVideos.forEach(otherVideo => {
          if (otherVideo !== video && !otherVideo.paused) {
            otherVideo.pause();
          }
        });
      });
    });

    lucide.createIcons();
  </script>
</body>
</html>