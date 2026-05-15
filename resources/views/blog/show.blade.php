<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->title }} | {{ $s['site_title'] ?? 'Blog' }}</title>
  <meta name="description" content="{{ strip_tags(Str::limit($post->content, 150)) }}">
  <link rel="icon" type="image/png" href="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}">

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

  @php
    $fontHeading  = $s['font_heading'] ?? 'Playfair Display';
    $fontBody     = $s['font_body']    ?? 'DM Sans';
    $fontSize     = (int)($s['font_size'] ?? 16);
    $fontQuery    = urlencode($fontHeading).':wght@400;700;900&family='.urlencode($fontBody).':wght@300;400;500;600;700';
  @endphp

  <link href="https://fonts.googleapis.com/css2?family={{ $fontQuery }}&display=swap" rel="stylesheet">

  <style>
    html,body{height:100%;margin:0}
    *{box-sizing:border-box}
    :root{
      --color-primary:#04599A;
      --color-accent:#d4af37;
      --color-bg:#04599A;
      --color-navbar:#04599A;
      --color-footer:#072d52;
      --color-text:#ffffff;
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
    .btn-primary:hover{background:#0d4d7c}
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
    #blog-nav .nav-link.opacity-0{opacity:1}
    #blog-nav.scrolled .nav-link.opacity-0{opacity:1}
    
    /* Back button styling */
    .btn-back-home{background:transparent;border-color:#154a7c;color:#154a7c;transition:all .3s ease}
    .btn-back-home:hover{background:#154a7c;border-color:#154a7c;color:#ffffff}
    #blog-nav.scrolled .btn-back-home{background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);color:#ffffff}
    #blog-nav.scrolled .btn-back-home:hover{background:rgba(255,255,255,0.3)}
  </style>
</head>
<body>
  <nav id="blog-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 sm:h-20">
        <a id="blog-nav-back" href="{{ route('home') }}#blog" class="btn-back-home inline-flex items-center gap-2 px-3 sm:px-6 py-2 sm:py-2.5 border rounded-lg font-medium text-xs sm:text-sm transition-all duration-300 backdrop-blur-sm">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          <span class="hidden sm:inline">Kembali ke Beranda</span>
          <span class="sm:hidden">Kembali</span>
        </a>
        <div class="flex items-center gap-2">
          <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="h-8 w-auto rounded-lg object-contain nav-link sm:opacity-100 transition-opacity duration-300">
        </div>
      </div>
    </div>
  </nav>

  <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
    <div class="space-y-8">
      <div class="text-center">
        <div class="text-slate-500 text-sm">{{ $post->category }} · {{ $post->display_date ?? $post->created_at->format('d M Y') }}</div>
        <h1 class="font-heading text-4xl sm:text-5xl font-bold text-slate-900 mt-4">{{ $post->title }}</h1>
      </div>

      @if($post->thumbnail_path)
        <div class="rounded-3xl overflow-hidden shadow-lg">
          <img src="{{ asset('storage/'.$post->thumbnail_path) }}" alt="{{ $post->title }}" class="w-full object-cover">
        </div>
      @endif

      <article class="prose prose-slate max-w-none text-justify leading-relaxed">
        {!! nl2br(e($post->content)) !!}
      </article>

      @if($relatedPosts->isNotEmpty())
        <section class="border-t border-slate-200 pt-12">
          <h2 class="font-heading text-2xl font-bold text-slate-900 mb-8">Berita Lainnya</h2>
          <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($relatedPosts as $related)
              <article class="blog-card overflow-hidden">
                @if($related->thumbnail_path)
                  <img src="{{ asset('storage/'.$related->thumbnail_path) }}" alt="{{ $related->title }}" class="h-40 w-full object-cover">
                @else
                  <div class="h-40 bg-slate-100 flex items-center justify-center text-slate-400">
                    <i data-lucide="image" class="w-8 h-8"></i>
                  </div>
                @endif
                <div class="p-4">
                  <div class="flex items-center gap-2 mb-2">
                    <span class="badge {{ $related->category === 'Workshop' ? 'badge-blue' : ($related->category === 'Training' ? 'badge-amber' : ($related->category === 'Event' ? 'badge-green' : 'badge-gray')) }}">
                      {{ $related->category }}
                    </span>
                    <span class="text-slate-400 text-xs">{{ $related->display_date ?? $related->created_at->format('d M Y') }}</span>
                  </div>
                  <h3 class="font-heading font-bold text-lg text-slate-900 mb-2">{{ $related->title }}</h3>
                  <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $related->excerpt }}</p>
                  <a href="{{ route('blog.show', $related->slug) }}" class="btn-primary inline-flex">Baca Selengkapnya</a>
                </div>
              </article>
            @endforeach
          </div>
        </section>
      @endif
    </div>
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
            <p><i data-lucide="mail" class="w-4 h-4 inline mr-1"></i> 
               <a href="mailto:{{ trim($s['contact_email'] ?? 'esensialtraining@gmail.com') }}" class="hover:text-white transition-colors">{{ $s['contact_email'] ?? 'esensialtraining@gmail.com' }}</a>
            </p>
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
    const backLink = document.getElementById('blog-nav-back');

    // Scroll behavior
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
