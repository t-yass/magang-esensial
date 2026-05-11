<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $s['site_title'] ?? 'Blog & Berita' }}</title>
  <meta name="description" content="Berita terkini dan artikel terbaru dari {{ $s['site_title'] ?? 'Esensial Training & Consulting' }}.">
  <link rel="icon" type="image/png" href="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}">

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

  @php
    $fontHeading  = $s['font_heading'] ?? 'Playfair Display';
    $fontBody     = $s['font_body'] ?? 'DM Sans';
    $fontSize     = (int)($s['font_size'] ?? 16);
    $fontQuery    = urlencode($fontHeading).':wght@400;700;900&family='.urlencode($fontBody).':wght@300;400;500;600;700';
    $colorPrimary = $s['color_primary'] ?? '#04599A';
    $colorAccent  = $s['color_accent'] ?? '#d4af37';
    $colorBg      = $s['color_background'] ?? '#072d52';
    $colorNavbar  = $s['navbar_color'] ?? $colorPrimary;
    $colorFooter  = $s['footer_color'] ?? $colorBg;
    $colorText    = $s['color_text'] ?? '#ffffff';
  @endphp

  <link href="https://fonts.googleapis.com/css2?family={{ $fontQuery }}&display=swap" rel="stylesheet">

  <style>
    html,body{height:100%;margin:0}
    *{box-sizing:border-box}
    :root{
      --color-primary:{{ $colorPrimary }};
      --color-accent:{{ $colorAccent }};
      --color-bg:{{ $colorBg }};
      --color-navbar:{{ $colorNavbar }};
      --color-footer:{{ $colorFooter }};
      --color-text:{{ $colorText }};
      --font-heading:'{{ $fontHeading }}',Georgia,serif;
      --font-body:'{{ $fontBody }}',sans-serif;
      --font-size-base:{{ $fontSize }}px;
    }
    body{font-family:var(--font-body);font-size:var(--font-size-base);
      background:linear-gradient(to bottom,#ffffff 0%,#ffffff 60%,var(--color-primary) 100%) fixed}
    .font-heading{font-family:var(--font-heading)}
    html{scroll-behavior:smooth}
    .hero-overlay{background:transparent;position:relative;overflow:hidden}
    .hero-overlay::before{content:'';position:absolute;top:-50%;right:-30%;width:80%;height:200%;
      background:radial-gradient(ellipse,rgba(4,89,154,.15) 0%,transparent 70%);pointer-events:none}
    .program-card{transition:transform .3s,box-shadow .3s}
    .program-card:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,.15)}
    .btn-cta{transition:all .3s ease}
    .btn-cta:hover{background-color:white!important;color:#051f3a!important}
    @keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
    .animate-fade-up{animation:fadeUp .7s ease forwards;opacity:0}
    .delay-1{animation-delay:.1s}.delay-2{animation-delay:.2s}.delay-3{animation-delay:.3s}
    .delay-4{animation-delay:.4s}.delay-5{animation-delay:.5s}
    .nav-link{position:relative;transition:color .3s ease}
    .nav-link::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;
      background:var(--color-primary);transition:width .3s,background .3s}
    .nav-link:hover::after{width:100%}
    .nav-link.active::after{width:100%}
    .mobile-nav-link{position:relative;transition:color .3s ease}
    .mobile-nav-link::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;
      background:#ffffff;transition:width .3s,background .3s}
    .mobile-nav-link:hover::after{width:100%}
    #main-nav:not(.scrolled) .nav-link:hover{color:#052548!important}
    #main-nav.scrolled .nav-link:hover{color:#ffffff!important}
    #main-nav.scrolled .nav-link::after,#main-nav.scrolled .nav-link.active::after{background:#ffffff}
    .section-divider{background:linear-gradient(90deg,transparent,rgba(4,89,154,.3),transparent);height:1px}
    .gallery-item{transition:transform .4s,box-shadow .4s}
    .gallery-item:hover{transform:scale(1.03);box-shadow:0 15px 35px rgba(0,0,0,.2)}
    .cert-badge{background:linear-gradient(135deg,#072d52,#0a3f6f);border-left:3px solid var(--color-primary)}
    .partner-logo{background:#fff;border:1px solid rgba(4,89,154,.15);transition:all .3s}
    .partner-logo:hover{border-color:rgba(4,89,154,.4)}
    .mobile-menu{transition:transform .3s ease,opacity .3s ease;transform:translateX(100%);opacity:0}
    .mobile-menu.open{transform:translateX(0);opacity:1}
    .hide-scrollbar{-ms-overflow-style:none;scrollbar-width:none}
    .hide-scrollbar::-webkit-scrollbar{display:none}

    /* Blog card styles */
    .blog-card{background:#ffffff;border-radius:1.25rem;overflow:hidden;
      box-shadow:0 18px 54px rgba(15,23,42,.06);transition:transform .3s,box-shadow .3s}
    .blog-card:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,.15)}
    .blog-card img{width:100%;height:auto;display:block}
    .btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
      padding:.85rem 1.4rem;border-radius:999px;background:var(--color-primary);color:#ffffff;
      font-weight:700;transition:background .25s}
    .btn-primary:hover{background:#033d6c}
    .badge{display:inline-flex;align-items:center;justify-content:center;padding:.35rem .75rem;
      border-radius:999px;font-size:.75rem;font-weight:700}
    .badge-blue{background:#e0f2fe;color:#0369a1}
    .badge-green{background:#dcfce7;color:#166534}
    .badge-amber{background:#ffedd5;color:#b45309}
    .badge-gray{background:#f3f4f6;color:#374151}

    /* Navbar transparency */
    #blog-nav{background:transparent;transition:background .3s ease}
    #blog-nav.scrolled{background:var(--color-navbar)}
    #blog-nav .nav-link{color:#ffffff;transition:color .3s ease}
    #blog-nav:not(.scrolled) .nav-link{color:#051f3a}
    #blog-nav .nav-link.opacity-0{opacity:0}
    #blog-nav.scrolled .nav-link.opacity-0{opacity:1}
  </style>
</head>
<body>
  <nav id="blog-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 sm:h-20">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium nav-link tracking-wide hover:opacity-80 transition-opacity">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          <span class="hidden sm:inline">Kembali ke Beranda</span>
          <span class="sm:hidden">Kembali</span>
        </a>
        <div class="flex items-center gap-2">
          <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="h-8 w-auto rounded-lg object-contain nav-link opacity-0 sm:opacity-100 transition-opacity duration-300">
        </div>
      </div>
    </div>
  </nav>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
    <section class="text-center max-w-3xl mx-auto mb-12">
      <span class="inline-flex items-center gap-2 text-sm uppercase tracking-[0.35em] text-slate-500 font-semibold justify-center">
        <i data-lucide="book-open" class="w-4 h-4"></i> Blog & Berita
      </span>
      <h1 class="font-heading text-4xl sm:text-5xl font-bold text-slate-900 mt-5">Berita dan artikel terbaru dari tim kami</h1>
      <p class="mt-4 text-slate-600">Jelajahi informasi terbaru, inspirasi, dan update kegiatan yang siap membantu perjalanan belajar Anda.</p>
    </section>

    @if($posts->isEmpty())
      <div class="blog-card p-10 text-center">
        <p class="text-slate-600">Belum ada artikel yang dipublikasikan.</p>
        <a href="{{ route('home') }}" class="btn-primary mt-6 inline-block">Kembali ke Beranda</a>
      </div>
    @else
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach($posts as $post)
          <article class="blog-card overflow-hidden">
            @if($post->thumbnail_path)
              <img src="{{ asset('storage/'.$post->thumbnail_path) }}" alt="{{ $post->title }}" class="h-40 w-full object-cover">
            @else
              <div class="h-40 bg-slate-100 flex items-center justify-center text-slate-400">
                <i data-lucide="image" class="w-12 h-12"></i>
              </div>
            @endif
            <div class="p-6">
              <div class="flex items-center gap-2 mb-3">
                <span class="badge {{ $post->category === 'Workshop' ? 'badge-blue' : ($post->category === 'Training' ? 'badge-amber' : ($post->category === 'Event' ? 'badge-green' : 'badge-gray')) }}">
                  {{ $post->category }}
                </span>
                @if($post->display_date)
                  <span class="text-xs text-slate-500">{{ $post->display_date }}</span>
                @endif
              </div>
              <h2 class="font-heading text-xl font-bold text-slate-900 mb-3">{{ $post->title }}</h2>
              <p class="text-slate-600 leading-relaxed mb-5 line-clamp-3">{{ $post->excerpt }}</p>
              <a href="{{ route('blog.show', $post->slug) }}" class="btn-primary inline-flex">Baca Selengkapnya</a>
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </main>

  <footer class="border-t border-white/10" style="background:var(--color-footer);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="h-10 w-auto rounded-lg object-contain">
            <div>
              <div class="font-heading font-bold text-sm text-white">ESENSIAL TRAINING & CONSULTING</div>
              <div class="text-xs tracking-wider text-sky-400">Professional Skills Excellent</div>
            </div>
          </div>
          <p class="text-white/40 text-sm leading-relaxed">Mewujudkan sumber daya manusia yang berkualitas dan berdaya saing tinggi.</p>
        </div>
        <div>
          <h4 class="font-heading font-bold text-sm text-white mb-4">Alamat</h4>
          <p class="text-white/50 text-sm leading-relaxed">
            <i data-lucide="map-pin" class="w-4 h-4 inline mr-1"></i>{{ $s['contact_address']??'' }}
          </p>
        </div>
        <div>
          <h4 class="font-heading font-bold text-sm text-white mb-4">Hubungi Kami</h4>
          <div class="space-y-2 text-sm text-white/50">
            <p><i data-lucide="instagram" class="w-4 h-4 inline mr-1"></i> {{ '@'.($s['contact_instagram']??'') }}</p>
            <p><i data-lucide="phone" class="w-4 h-4 inline mr-1"></i> {{ $s['contact_whatsapp']??'' }}</p>
            <p><i data-lucide="mail" class="w-4 h-4 inline mr-1"></i> {{ $s['contact_email']??'' }}</p>
          </div>
        </div>
      </div>
      <div class="section-divider mt-10 mb-6"></div>
      <p class="text-center text-white/30 text-xs">© {{ date('Y') }} Esensial Training & Consulting. All rights reserved.</p>
    </div>
  </footer>

  <script>lucide.createIcons();</script>
  <script>
    const blogNav = document.getElementById('blog-nav');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        blogNav.classList.add('scrolled');
      } else {
        blogNav.classList.remove('scrolled');
      }
    });
  </script>
</body>
</html>