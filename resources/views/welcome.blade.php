<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $s['site_title'] ?? 'Esensial Training & Consulting' }}</title>
  <meta name="description" content="{{ $s['site_description'] ?? '' }}">
  <link rel="icon" type="image/png" href="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}">

  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

  @php
    $fontHeading  = $s['font_heading'] ?? 'Playfair Display';
    $fontBody     = $s['font_body']    ?? 'DM Sans';
    $fontSize     = (int)($s['font_size'] ?? 16);
    $fontQuery    = urlencode($fontHeading).':wght@400;700;900&family='.urlencode($fontBody).':wght@300;400;500;600;700';
    $colorPrimary = $s['color_primary']    ?? '#04599A';
    $colorAccent  = $s['color_accent']     ?? '#d4af37';
    $colorBg      = $s['color_background'] ?? '#072d52';
    $colorNavbar  = $s['navbar_color']     ?? $colorPrimary;
    $colorFooter  = $s['footer_color']     ?? $colorBg;
    $colorText    = $s['color_text']       ?? '#ffffff';
    $founderPhoto = !empty($s['founder_photo'])
      ? asset('storage/'.$s['founder_photo'])
      : asset('images/founder.png');

    /* ── Helper: mailto link profesional ── */
    $contactEmail   = $s['contact_email'] ?? 'esensialtraining@gmail.com';
    $mailtoSubject  = rawurlencode('Konsultasi & Informasi – Esensial Training');
    $mailtoBody     = rawurlencode(
      "Halo, saya ingin bertanya mengenai layanan pelatihan Esensial Training & Consulting.\n\n" .
      "Nama saya: \nInstansi: \nKebutuhan: \n\nTerima kasih."
    );
    $mailtoLink = "mailto:{$contactEmail}?subject={$mailtoSubject}&body={$mailtoBody}";

    /* ── Helper: ekstrak shortcode dari URL Instagram ── */
    function igShortcode(string $url): string {
      preg_match('#instagram\.com/(?:p|reel|tv)/([A-Za-z0-9_-]+)#', $url, $m);
      return $m[1] ?? '';
    }
    /* ── Helper: URL thumbnail CDN Instagram (public, tidak selalu berhasil) ── */
    function igThumb(string $shortcode): string {
      return $shortcode
        ? "https://www.instagram.com/p/{$shortcode}/media/?size=l"
        : '';
    }
  @endphp

  <link href="https://fonts.googleapis.com/css2?family={{ $fontQuery }}&display=swap" rel="stylesheet">

  <style>

  .thumb-img-wrap{
    position:absolute;
    inset:0;
  }

  .thumb-img-wrap img{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
  }

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

    /* ══════════════════════════════════════════════════
       VIDEO CARD
    ══════════════════════════════════════════════════ */
    .video-card{
      transform:translateZ(0);
      transition:transform .35s ease,box-shadow .35s ease;
    }
    .video-card:hover{transform:translateY(-4px)}
    .video-card-thumb{
      position:relative;width:100%;aspect-ratio:3/4;
      overflow:hidden;background:#0a1628;display:block;
      cursor:pointer;border:none;padding:0;
    }
    .video-card-thumb .thumb-media{
      position:absolute;inset:0;width:100%;height:100%;
      object-fit:cover;object-position:center top;
      filter:brightness(.96);
      transition:transform .5s ease,filter .4s ease;
    }
    .video-card:hover .thumb-media{transform:scale(1.08);filter:brightness(1)}

    /* ── Instagram placeholder ── */
    .ig-placeholder{
      position:absolute;inset:0;
      display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;
      background:linear-gradient(160deg,#1a0533 0%,#2d1060 40%,#1c0a3a 100%);
    }
    .ig-logo-ring{
      width:64px;height:64px;border-radius:18px;
      background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7);
      display:flex;align-items:center;justify-content:center;
      box-shadow:0 8px 32px rgba(238,42,123,.5);
    }
    .ig-placeholder-text{text-align:center;}
    .ig-placeholder-text .ig-title{color:#fff;font-size:13px;font-weight:700;letter-spacing:.01em;}
    .ig-placeholder-text .ig-sub{color:rgba(255,255,255,.45);font-size:11px;margin-top:3px;}
    @keyframes igPulse{0%,100%{opacity:.5}50%{opacity:1}}
    .ig-loading .ig-logo-ring{animation:igPulse 1.5s ease-in-out infinite}

    .thumb-img-wrap{position:absolute;inset:0}
    .thumb-img-wrap img{width:100%;height:100%;object-fit:cover;object-position:center top}

    /* ══════════════════════════════════════════════════
       CAROUSEL
    ══════════════════════════════════════════════════ */
    .carousel-outer{overflow:hidden}
    .carousel-track{
      display:flex;gap:16px;
      transition:transform 500ms cubic-bezier(.25,.46,.45,.94);
      will-change:transform;cursor:grab;user-select:none;
    }
    .carousel-track:active{cursor:grabbing}
    .carousel-track.centered{justify-content:center;transform:none!important;cursor:default;}

    /* ══════════════════════════════════════════════════
       VIDEO MODAL
    ══════════════════════════════════════════════════ */
    #video-modal{
      position:fixed;inset:0;z-index:9999;
      display:flex;align-items:center;justify-content:center;padding:12px;
      background:rgba(3,15,42,.92);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);
      opacity:0;pointer-events:none;transition:opacity .25s ease;
    }
    #video-modal.modal-open{opacity:1;pointer-events:auto}
    #modal-box{
      position:relative;width:min(100%,920px);max-width:920px;
      max-height:calc(100dvh - 24px);background:#0a1628;
      border-radius:18px;overflow:hidden;
      display:flex;flex-direction:column;
      box-shadow:0 32px 80px rgba(0,0,0,.8);
      transform:scale(.92) translateY(8px);opacity:0;
      transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s ease;
    }
    #video-modal.modal-open #modal-box{transform:scale(1) translateY(0);opacity:1}
    #modal-box.modal-landscape{max-width:800px}
    #modal-header{flex-shrink:0;padding:12px 48px 10px 16px;border-bottom:1px solid rgba(255,255,255,.08)}
    #modal-video-wrapper{
      flex:1 1 auto;overflow:hidden;
      display:flex;align-items:center;justify-content:center;
      background:#000;max-height:calc(100dvh - 90px);min-height:160px;
    }
    #modal-video-container{position:relative;background:#000}
    #modal-video-container.vc-instagram-fallback{
      width:100%;max-width:400px;aspect-ratio:9/16;
      background:#0a1628;display:flex;flex-direction:column;
    }
    #modal-video-container.vc-portrait{
      height:min(calc(100dvh - 90px),75vh);
      aspect-ratio:9/16;width:auto;max-width:100%;
    }
    #modal-video-container.vc-landscape{width:100%;aspect-ratio:16/9;height:auto}
    #modal-video-container iframe,#modal-video-container video{
      position:absolute;inset:0;width:100%;height:100%;border:none;
    }
    #modal-video-container video{object-fit:contain;background:#000}
    #modal-close-btn{
      position:absolute;top:10px;right:10px;z-index:20;
      width:34px;height:34px;border-radius:50%;border:none;
      background:rgba(0,0,0,.55);color:#fff;cursor:pointer;
      display:flex;align-items:center;justify-content:center;transition:background .2s;
    }
    #modal-close-btn:hover{background:rgba(255,255,255,.18)}
    @media(max-width:480px){
      #video-modal{padding:8px}
      #modal-box{border-radius:12px}
      #modal-video-container.vc-portrait{height:min(calc(100dvh - 72px),82vh)}
    }

    /* ══════════════════════════════════════════════════
       MAILTO CONTACT CARD — efek khusus untuk email
    ══════════════════════════════════════════════════ */
    .contact-card-email{
      position:relative;
      overflow:hidden;
    }
    .contact-card-email::after{
      content:'';
      position:absolute;
      inset:0;
      background:linear-gradient(135deg,rgba(4,89,154,.06),rgba(4,89,154,.02));
      opacity:0;
      transition:opacity .3s ease;
      pointer-events:none;
    }
    .contact-card-email:hover::after{opacity:1;}

    /* Footer mailto link */
    .footer-email-link{
      color:inherit;
      text-decoration:none;
      transition:color .25s ease;
      display:inline-flex;
      align-items:center;
      gap:4px;
    }
    .footer-email-link:hover{
      color:rgba(255,255,255,.85) !important;
      text-decoration:underline;
      text-underline-offset:3px;
    }
  </style>

  <script>
    tailwind.config={theme:{extend:{colors:{
      navy:{900:'#051f3a',800:'#072d52',700:'#0a3f6f',600:'#04599A'},
      blue:{400:'#0a7acc',500:'#04599A',600:'#034580'},
    }}}}
  </script>

  <script>
  (function(){
    'use strict';

    /* ── VIDEO DATA ──────────────────────────────────────── */
    const VIDEO_DATA={
      training:[
        @foreach($trainings as $video)
        @php
          $isUpload=$video->source_type==='upload'&&$video->file_path;
          $rawUrl=$video->url??'';
          $embedUrl='';$videoType='external';$igShortcode='';
          if($isUpload){$videoType='local';$embedUrl=asset('storage/'.$video->file_path);}
          elseif(str_contains($rawUrl,'youtu')){
            $videoType='youtube';
            preg_match('/(?:v=|\/embed\/|youtu\.be\/)([A-Za-z0-9_-]{11})/',$rawUrl,$m);
            $ytId=$m[1]??'';
            $embedUrl="https://www.youtube.com/embed/{$ytId}?autoplay=1&rel=0&modestbranding=1";
          }elseif(str_contains($rawUrl,'instagram.com')){
            $videoType='instagram';
            $embedUrl=rtrim(strtok($rawUrl,'?'),'/').'\/embed';
            $igShortcode=igShortcode($rawUrl);
          }else{$embedUrl=$rawUrl;}
        @endphp
        {type:"{{$videoType}}",url:"{{addslashes($embedUrl)}}",originalUrl:"{{ $rawUrl }}",
         igShortcode:"{{$igShortcode}}",
         igThumb:"{{$igShortcode ? igThumb($igShortcode) : ''}}",
         title:"{{addslashes($video->title??'Video Training '.$loop->iteration)}}",
         badge:"Training · Esensial"},
        @endforeach
      ],
      testimonial:[
        @foreach($testimonials as $video)
        @php
          $isUpload=$video->source_type==='upload'&&$video->file_path;
          $rawUrl=$video->url??'';
          $embedUrl='';$videoType='external';$igShortcode='';
          if($isUpload){$videoType='local';$embedUrl=asset('storage/'.$video->file_path);}
          elseif(str_contains($rawUrl,'youtu')){
            $videoType='youtube';
            preg_match('/(?:v=|\/embed\/|youtu\.be\/)([A-Za-z0-9_-]{11})/',$rawUrl,$m);
            $ytId=$m[1]??'';
            $embedUrl="https://www.youtube.com/embed/{$ytId}?autoplay=1&rel=0&modestbranding=1";
          }elseif(str_contains($rawUrl,'instagram.com')){
            $videoType='instagram';
            $embedUrl=rtrim(strtok($rawUrl,'?'),'/').'\/embed';
            $igShortcode=igShortcode($rawUrl);
          }else{$embedUrl=$rawUrl;}
        @endphp
        {type:"{{$videoType}}",url:"{{addslashes($embedUrl)}}",originalUrl:"{{ $rawUrl }}",
         igShortcode:"{{$igShortcode}}",
         igThumb:"{{$igShortcode ? igThumb($igShortcode) : ''}}",
         title:"{{addslashes($video->title??'Testimoni '.$loop->iteration)}}",
         badge:"Testimoni Peserta"},
        @endforeach
      ]
    };

    /* ── CAROUSEL ────────────────────────────────────────── */
    const carousels={};

    function initCarousel(name){
      const track=document.getElementById(name+'-track');
      if(!track)return;
      const outer=document.getElementById(name+'-track-outer');
      const cards=track.querySelectorAll('.video-card');
      const dotsEl=document.getElementById(name+'-dots');
      const prevBtn=document.getElementById(name+'-prev');
      const nextBtn=document.getElementById(name+'-next');
      const count=cards.length;
      if(!count)return;
      const GAP=16;let idx=0;

      if(dotsEl){
        dotsEl.innerHTML='';
        for(let i=0;i<count;i++){
          const d=document.createElement('button');
          d.className=`h-2 rounded-full transition-all duration-300 ${i===0?'bg-[var(--color-primary)] w-5':'bg-navy-900/20 w-2'}`;
          d.setAttribute('aria-label',`Slide ${i+1}`);
          d.addEventListener('click',()=>goTo(i));
          dotsEl.appendChild(d);
        }
      }

      function cardW(){return(cards[0]?.offsetWidth||260)+GAP}
      function isCentered(){if(!outer)return false;return(count*cardW()-GAP)<=outer.offsetWidth;}

      function paint(){
        if(isCentered()){
          track.classList.add('centered');
          if(prevBtn){prevBtn.style.display='none'}
          if(nextBtn){nextBtn.style.display='none'}
          if(dotsEl){dotsEl.style.display='none'}
        }else{
          track.classList.remove('centered');
          track.style.transform=`translateX(-${idx*cardW()}px)`;
          if(prevBtn){prevBtn.style.display='';prevBtn.disabled=idx===0}
          if(nextBtn){nextBtn.style.display='';nextBtn.disabled=idx>=count-1}
          if(dotsEl){
            dotsEl.style.display='';
            dotsEl.querySelectorAll('button').forEach((d,i)=>{
              d.className=`h-2 rounded-full transition-all duration-300 ${i===idx?'bg-[var(--color-primary)] w-5':'bg-navy-900/20 w-2'}`;
            });
          }
        }
      }

      function goTo(i){
        idx=Math.max(0,Math.min(i,count-1));
        if(currentOpen===name)closeModal();
        paint();
      }

      window.addEventListener('resize',paint);

      let sx=0,dragging=false,moved=false;
      track.addEventListener('mousedown',e=>{if(isCentered())return;sx=e.clientX;dragging=true;moved=false;track.style.transition='none'});
      track.addEventListener('touchstart',e=>{if(isCentered())return;sx=e.touches[0].clientX;dragging=true;moved=false;track.style.transition='none'},{passive:true});
      function onMove(x){if(!dragging||isCentered())return;if(Math.abs(x-sx)>5)moved=true;track.style.transform=`translateX(-${idx*cardW()-(x-sx)}px)`}
      track.addEventListener('mousemove',e=>onMove(e.clientX));
      track.addEventListener('touchmove',e=>onMove(e.touches[0].clientX),{passive:true});
      function onUp(x){
        if(!dragging)return;dragging=false;
        track.style.transition='transform 500ms cubic-bezier(.25,.46,.45,.94)';
        const dx=sx-x;
        if(moved){if(dx>50)goTo(idx+1);else if(dx<-50)goTo(idx-1);else paint();}
        else paint();
      }
      track.addEventListener('mouseup',e=>onUp(e.clientX));
      track.addEventListener('mouseleave',e=>onUp(e.clientX));
      track.addEventListener('touchend',e=>onUp(e.changedTouches[0].clientX));
      track.querySelectorAll('button').forEach(b=>b.addEventListener('click',e=>{if(moved)e.stopImmediatePropagation();},true));

      carousels[name]={goTo,getIdx:()=>idx};
      paint();
    }

    window.carouselScroll=function(name,dir){
      const c=carousels[name];if(!c)return;
      c.goTo(c.getIdx()+dir);
    };

    /* ── INSTAGRAM THUMBNAIL LOADER ─────────────────────────── */
    function loadIgThumbs(){
      document.querySelectorAll('.ig-thumb-target').forEach(container=>{
        const thumbUrl=container.dataset.igThumb;
        const shortcode=container.dataset.igShortcode;
        const placeholder=container.querySelector('.ig-placeholder');
        const shortEl=container.querySelector('.ig-shortcode');

        if(!shortcode){
          if(placeholder) placeholder.classList.remove('ig-loading');
          return;
        }

        const imgUrl=`https://images.weserv.nl/?url=instagram.com/p/${shortcode}/media/?size=l`;
        const img=new Image();

        img.onload=function(){
          const wrap=document.createElement('div');
          wrap.className='thumb-img-wrap';
          const imgEl=document.createElement('img');
          imgEl.src=imgUrl;
          imgEl.alt='Instagram preview';
          wrap.appendChild(imgEl);
          container.insertBefore(wrap,container.firstChild);
          if(placeholder){
            placeholder.style.transition='opacity .3s';
            placeholder.style.opacity='0';
            setTimeout(()=>{placeholder.remove();},300);
          }
        };

        img.onerror=function(){
          if(shortEl&&shortcode)shortEl.textContent='/reel/'+shortcode;
          if(placeholder)placeholder.classList.remove('ig-loading');
        };

        img.src=imgUrl;
      });
    }

    /* ── MODAL ───────────────────────────────────────────── */
    let currentOpen=null;

    window.openVideoModal=function(carouselName,index){
      const data=VIDEO_DATA[carouselName]?.[index];
      if(!data)return;
      stopMedia();currentOpen=carouselName;
      const modal=document.getElementById('video-modal');
      const box=document.getElementById('modal-box');
      const container=document.getElementById('modal-video-container');
      const titleEl=document.getElementById('modal-video-title');
      const badgeEl=document.getElementById('modal-video-badge');
      titleEl.textContent=data.title;
      badgeEl.textContent=data.badge;
      container.innerHTML='';
      const isLandscape=data.type==='youtube'||data.type==='external';
      container.className=isLandscape?'vc-landscape':'vc-portrait';
      box.removeAttribute('class');
      if(isLandscape)box.classList.add('modal-landscape');
      if(data.type==='instagram'){
        container.className='vc-instagram-fallback';
        container.innerHTML=`
          <div class="flex flex-col items-center justify-center p-8 text-center h-full bg-gradient-to-b from-navy-800 to-black">
            <div class="w-20 h-20 bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] rounded-3xl flex items-center justify-center shadow-2xl mb-6">
              <i data-lucide="instagram" class="w-10 h-10 text-white"></i>
            </div>
            <h3 class="text-white font-bold text-xl mb-2">Tonton di Instagram</h3>
            <p class="text-white/50 text-sm mb-8 max-w-[240px]">Instagram membatasi pemutaran video langsung di dalam website lain.</p>
            <a href="${data.originalUrl}" target="_blank" class="w-full py-4 bg-[#04599A] text-white font-bold rounded-xl hover:bg-blue-600 transition-all flex items-center justify-center gap-2 shadow-lg">
              Buka di Instagram <i data-lucide="external-link" class="w-4 h-4"></i>
            </a>
          </div>
        `;
        lucide.createIcons();
      }else if(data.type==='local'){
        const vid=document.createElement('video');
        vid.src=data.url;vid.controls=true;vid.autoplay=true;
        vid.id='modal-active-video';
        container.appendChild(vid);vid.play().catch(()=>{});
      }else{
        const iframe=document.createElement('iframe');
        iframe.src=data.url;
        iframe.id='modal-active-iframe';
        iframe.frameBorder='0';
        iframe.allow='autoplay; fullscreen; picture-in-picture';
        iframe.allowFullscreen=true;
        container.appendChild(iframe);
      }
      modal.classList.add('modal-open');
      document.body.style.overflow='hidden';
      document.addEventListener('keydown',onEsc);
    };

    window.closeVideoModal=function(){
      const modal=document.getElementById('video-modal');
      modal.classList.remove('modal-open');
      setTimeout(()=>{
        stopMedia();
        document.getElementById('modal-video-container').innerHTML='';
        currentOpen=null;document.body.style.overflow='';
      },300);
      document.removeEventListener('keydown',onEsc);
    };

    function closeModal(){window.closeVideoModal()}
    function stopMedia(){
      const vid=document.getElementById('modal-active-video');
      const iframe=document.getElementById('modal-active-iframe');
      if(vid){vid.pause();vid.src=''}
      if(iframe){iframe.src=''}
    }
    function onEsc(e){if(e.key==='Escape')closeModal()}

    const cardObs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        const v=e.target.querySelector('video');
        if(v&&!e.isIntersecting&&!v.paused)v.pause();
      });
    },{threshold:.3});

    document.addEventListener('DOMContentLoaded',()=>{
      initCarousel('training');
      initCarousel('testimonial');
      loadIgThumbs();
      document.querySelectorAll('.video-card').forEach(c=>cardObs.observe(c));
      lucide.createIcons();
    });
  })();
  </script>
</head>
<body class="h-full text-white overflow-auto" id="app-body">

  <!-- NAVBAR -->
  <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" style="background:var(--color-navbar);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 sm:h-20">
        <div class="flex items-center gap-3">
          <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="h-10 w-auto sm:h-12 rounded-lg object-contain">
          <div class="hidden sm:block">
            <div class="font-heading font-bold text-sm text-white transition-colors duration-300" id="nav-brand">ESENSIAL</div>
            <div id="nav-tagline" class="text-[10px] text-navy-900 tracking-widest transition-colors duration-300">TRAINING & CONSULTING</div>
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
              <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="w-full h-auto object-contain">
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
        <div class="grid grid-cols-2 gap-3">
          @php $photos=$workshop->visiblePhotos()->limit(4)->get(); $icons=['presentation','users','mic','award']; @endphp
          @if($photos->isNotEmpty())
            @foreach($photos as $idx=>$photo)
              <div class="rounded-xl h-40 flex items-center justify-center border border-navy-900/5 shadow-sm overflow-hidden bg-white">
                <img src="{{ asset('storage/'.$photo->file_path) }}" alt="{{ $photo->alt_text }}" class="w-full h-full object-cover">
              </div>
            @endforeach
            @for($i=count($photos);$i<4;$i++)
              <div class="rounded-xl bg-white h-40 flex items-center justify-center border border-navy-900/5 shadow-sm">
                <div class="text-center">
                  <i data-lucide="{{ $icons[$i] }}" class="w-10 h-10 text-blue-500/20 mx-auto mb-2"></i>
                  <span class="text-navy-900/40 text-xs font-medium">Foto Kegiatan {{ $i+1 }}</span>
                </div>
              </div>
            @endfor
          @else
            @for($i=0;$i<4;$i++)
              <div class="rounded-xl bg-white h-40 flex items-center justify-center border border-navy-900/5 shadow-sm">
                <div class="text-center">
                  <i data-lucide="{{ $icons[$i] }}" class="w-10 h-10 text-blue-500/20 mx-auto mb-2"></i>
                  <span class="text-navy-900/40 text-xs font-medium">Foto Kegiatan {{ $i+1 }}</span>
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
      <div class="overflow-x-auto hide-scrollbar pb-4 scroll-smooth">
        <div class="inline-flex gap-4 snap-x snap-mandatory pl-2 sm:pl-4">
          @foreach($partners as $partner)
            <div class="partner-logo rounded-xl h-20 w-32 flex items-center justify-center shadow-sm overflow-hidden flex-none snap-center">
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

  <!-- VIDEO MODAL (global) -->
  <div id="video-modal" role="dialog" aria-modal="true" aria-label="Pemutar Video"
       onclick="if(event.target===this)closeVideoModal()">
    <div id="modal-box">
      <button id="modal-close-btn" onclick="closeVideoModal()" aria-label="Tutup video">
        <i data-lucide="x" style="width:18px;height:18px;"></i>
      </button>
      <div id="modal-header">
        <p id="modal-video-title" style="color:#fff;font-weight:600;font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;padding-right:8px;"></p>
        <p id="modal-video-badge" style="color:rgba(255,255,255,.35);font-size:11px;margin-top:2px;"></p>
      </div>
      <div id="modal-video-wrapper">
        <div id="modal-video-container" class="vc-portrait"></div>
      </div>
    </div>
  </div>

  @php
  function renderVideoCard($video, $index, $section) {
    $isUpload  = $video->source_type === 'upload' && $video->file_path;
    $rawUrl    = $video->url ?? '';
    $embedUrl  = ''; $thumbUrl = ''; $videoType = 'external'; $igShortcode = '';

    if ($isUpload) {
      $videoType = 'local';
      $embedUrl  = asset('storage/'.$video->file_path);
    } elseif (str_contains($rawUrl, 'youtu')) {
      $videoType = 'youtube';
      preg_match('/(?:v=|\/embed\/|youtu\.be\/)([A-Za-z0-9_-]{11})/', $rawUrl, $m);
      $ytId     = $m[1] ?? '';
      $embedUrl = "https://www.youtube.com/embed/{$ytId}?autoplay=1&rel=0&modestbranding=1";
      $thumbUrl = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
    } elseif (str_contains($rawUrl, 'instagram.com')) {
      $videoType   = 'instagram';
      $embedUrl    = rtrim(strtok($rawUrl, '?'), '/').'/embed';
      $igShortcode = igShortcode($rawUrl);
    } else {
      $embedUrl = $rawUrl;
    }
    return compact('isUpload','embedUrl','thumbUrl','videoType','igShortcode','rawUrl');
  }
  @endphp

  <!-- VIDEO TRAINING -->
  <section class="bg-transparent py-16 sm:py-24" id="section-video-training">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-2 text-navy-900">Video Training</h2>
        <p class="text-navy-900/50 text-sm">Dokumentasi kegiatan pelatihan kami</p>
      </div>

      @if($trainings->isNotEmpty())
        <div class="relative" id="training-carousel-wrapper">
          <div class="carousel-outer" id="training-track-outer">
            <div id="training-track" class="carousel-track">

              @foreach($trainings as $index => $video)
                @php extract(renderVideoCard($video, $index, 'training')); @endphp

                <div class="video-card flex-none w-[220px] sm:w-[260px] rounded-xl overflow-hidden
                             bg-white border border-navy-900/8 shadow-lg hover:shadow-xl
                             transition duration-300 ease-out group" data-index="{{ $index }}">

                  <button type="button" class="video-card-thumb"
                          onclick="openVideoModal('training',{{ $index }})"
                          aria-label="Putar video {{ $video->title ?? 'Training '.($index+1) }}">

                    @if($thumbUrl)
                      <img class="thumb-media" src="{{ $thumbUrl }}" alt="{{ $video->title ?? '' }}">
                    @elseif($isUpload)
                      <video class="thumb-media" src="{{ $embedUrl }}" preload="metadata" muted playsinline></video>
                    @elseif($videoType === 'instagram')
                      <div class="ig-thumb-target ig-loading"
                           data-ig-shortcode="{{ $igShortcode }}"
                           data-ig-thumb="{{ $igShortcode ? igThumb($igShortcode) : '' }}"
                           style="position:absolute;inset:0;">
                        <div class="ig-placeholder">
                          <div class="ig-logo-ring">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                          </div>
                          <div class="ig-placeholder-text">
                            <div class="ig-title">Instagram Reel</div>
                            <div class="ig-sub ig-shortcode">Tap untuk putar</div>
                          </div>
                        </div>
                      </div>
                    @else
                      <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#072d52,#0a3f6f);">
                        <i data-lucide="video" style="width:48px;height:48px;color:rgba(255,255,255,.15);"></i>
                      </div>
                    @endif

                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.65) 0%,rgba(0,0,0,.1) 45%,transparent 75%);pointer-events:none;z-index:1;"></div>

                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;z-index:2;">
                      <div style="width:54px;height:54px;border-radius:50%;background:rgba(255,255,255,.18);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);border:1.5px solid rgba(255,255,255,.5);display:flex;align-items:center;justify-content:center;transition:transform .3s,background .3s;box-shadow:0 4px 20px rgba(0,0,0,.4);"
                           class="group-hover:scale-110 group-hover:!bg-white/30">
                        <i data-lucide="play" style="width:22px;height:22px;color:#fff;fill:#fff;margin-left:3px;"></i>
                      </div>
                    </div>

                    <div style="position:absolute;top:10px;left:10px;z-index:3;">
                      @if($videoType==='youtube')
                        <span style="padding:2px 8px;background:#dc2626;color:#fff;font-size:10px;font-weight:700;border-radius:999px;">YouTube</span>
                      @elseif($videoType==='instagram')
                        <span style="padding:2px 8px;background:linear-gradient(135deg,#7c3aed,#ec4899);color:#fff;font-size:10px;font-weight:700;border-radius:999px;">IG</span>
                      @else
                        <span style="padding:2px 8px;background:#2563eb;color:#fff;font-size:10px;font-weight:700;border-radius:999px;">Video</span>
                      @endif
                    </div>
                  </button>

                  <div class="px-4 py-3">
                    <p class="text-navy-900 font-semibold text-sm truncate">{{ $video->title ?? 'Video Training '.($index+1) }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Training • Esensial</p>
                  </div>
                </div>
              @endforeach

            </div>
          </div>

          <button id="training-prev"
                  class="absolute top-1/2 -translate-y-1/2 -left-4 sm:-left-5 w-10 h-10 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center hover:bg-gray-50 active:scale-95 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed z-10"
                  onclick="carouselScroll('training',-1)" aria-label="Sebelumnya">
            <i data-lucide="chevron-left" class="w-5 h-5 text-navy-900"></i>
          </button>
          <button id="training-next"
                  class="absolute top-1/2 -translate-y-1/2 -right-4 sm:-right-5 w-10 h-10 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center hover:bg-gray-50 active:scale-95 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed z-10"
                  onclick="carouselScroll('training',1)" aria-label="Berikutnya">
            <i data-lucide="chevron-right" class="w-5 h-5 text-navy-900"></i>
          </button>
        </div>
        <div id="training-dots" class="flex justify-center gap-2 mt-6"></div>
      @else
        <div class="flex flex-col items-center justify-center py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-navy-50 flex items-center justify-center mb-4">
            <i data-lucide="video-off" class="w-7 h-7 text-navy-900/20"></i>
          </div>
          <p class="text-navy-900/40 text-sm">Belum ada video training tersedia.</p>
        </div>
      @endif
    </div>
  </section>

  <!-- VIDEO TESTIMONI -->
  <section class="bg-transparent py-16 sm:py-24" id="section-video-testimoni">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10">
        <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-2 text-navy-900">Video Testimoni</h2>
        <p class="text-navy-900/50 text-sm">Apa kata peserta pelatihan kami</p>
      </div>

      @if($testimonials->isNotEmpty())
        <div class="relative" id="testimonial-carousel-wrapper">
          <div class="carousel-outer" id="testimonial-track-outer">
            <div id="testimonial-track" class="carousel-track">

              @foreach($testimonials as $index => $video)
                @php extract(renderVideoCard($video, $index, 'testimonial')); @endphp

                <div class="video-card flex-none w-[220px] sm:w-[260px] rounded-xl overflow-hidden
                             bg-white border border-navy-900/8 shadow-lg hover:shadow-xl
                             transition duration-300 ease-out group" data-index="{{ $index }}">

                  <button type="button" class="video-card-thumb"
                          onclick="openVideoModal('testimonial',{{ $index }})"
                          aria-label="Putar testimoni {{ $video->title ?? 'Testimoni '.($index+1) }}">

                    @if($thumbUrl)
                      <img class="thumb-media" src="{{ $thumbUrl }}" alt="{{ $video->title ?? '' }}">
                    @elseif($isUpload)
                      <video class="thumb-media" src="{{ $embedUrl }}" preload="metadata" muted playsinline></video>
                    @elseif($videoType === 'instagram')
                      <div class="ig-thumb-target ig-loading"
                           data-ig-shortcode="{{ $igShortcode }}"
                           data-ig-thumb="{{ $igShortcode ? igThumb($igShortcode) : '' }}"
                           style="position:absolute;inset:0;">
                        <div class="ig-placeholder">
                          <div class="ig-logo-ring">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
                              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                          </div>
                          <div class="ig-placeholder-text">
                            <div class="ig-title">Instagram Reel</div>
                            <div class="ig-sub ig-shortcode">Tap untuk putar</div>
                          </div>
                        </div>
                      </div>
                    @else
                      <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0a3f6f,#051f3a);">
                        <i data-lucide="message-square" style="width:48px;height:48px;color:rgba(255,255,255,.15);"></i>
                      </div>
                    @endif

                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.65) 0%,rgba(0,0,0,.1) 45%,transparent 75%);pointer-events:none;z-index:1;"></div>

                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;z-index:2;">
                      <div style="width:54px;height:54px;border-radius:50%;background:rgba(255,255,255,.18);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);border:1.5px solid rgba(255,255,255,.5);display:flex;align-items:center;justify-content:center;transition:transform .3s,background .3s;box-shadow:0 4px 20px rgba(0,0,0,.4);"
                           class="group-hover:scale-110 group-hover:!bg-white/30">
                        <i data-lucide="play" style="width:22px;height:22px;color:#fff;fill:#fff;margin-left:3px;"></i>
                      </div>
                    </div>

                    <div style="position:absolute;bottom:10px;right:10px;opacity:.5;pointer-events:none;z-index:2;">
                      <i data-lucide="quote" style="width:18px;height:18px;color:#fff;"></i>
                    </div>

                    <div style="position:absolute;top:10px;left:10px;z-index:3;">
                      @if($videoType==='youtube')
                        <span style="padding:2px 8px;background:#dc2626;color:#fff;font-size:10px;font-weight:700;border-radius:999px;">YouTube</span>
                      @elseif($videoType==='instagram')
                        <span style="padding:2px 8px;background:linear-gradient(135deg,#7c3aed,#ec4899);color:#fff;font-size:10px;font-weight:700;border-radius:999px;">IG</span>
                      @else
                        <span style="padding:2px 8px;background:#2563eb;color:#fff;font-size:10px;font-weight:700;border-radius:999px;">Video</span>
                      @endif
                    </div>
                  </button>

                  <div class="px-4 py-3">
                    <p class="text-navy-900 font-semibold text-sm truncate">{{ $video->title ?? 'Testimoni '.($index+1) }}</p>
                    <p class="text-gray-400 text-xs mt-0.5">Testimoni Peserta</p>
                  </div>
                </div>
              @endforeach

            </div>
          </div>

          <button id="testimonial-prev"
                  class="absolute top-1/2 -translate-y-1/2 -left-4 sm:-left-5 w-10 h-10 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center hover:bg-gray-50 active:scale-95 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed z-10"
                  onclick="carouselScroll('testimonial',-1)" aria-label="Sebelumnya">
            <i data-lucide="chevron-left" class="w-5 h-5 text-navy-900"></i>
          </button>
          <button id="testimonial-next"
                  class="absolute top-1/2 -translate-y-1/2 -right-4 sm:-right-5 w-10 h-10 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center hover:bg-gray-50 active:scale-95 transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed z-10"
                  onclick="carouselScroll('testimonial',1)" aria-label="Berikutnya">
            <i data-lucide="chevron-right" class="w-5 h-5 text-navy-900"></i>
          </button>
        </div>
        <div id="testimonial-dots" class="flex justify-center gap-2 mt-6"></div>
      @else
        <div class="flex flex-col items-center justify-center py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-navy-50 flex items-center justify-center mb-4">
            <i data-lucide="message-circle" class="w-7 h-7 text-navy-900/20"></i>
          </div>
          <p class="text-navy-900/40 text-sm">Belum ada video testimoni tersedia.</p>
        </div>
      @endif
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="bg-transparent py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">About Us</h2>
        <p class="text-navy-900/70 font-bold">Kenali founder dan tim di balik Esensial Training</p>
      </div>
      <div class="grid lg:grid-cols-3 gap-10">
        <div class="lg:col-span-1">
          <div class="bg-white rounded-2xl p-6 border border-navy-900/5 text-center sticky top-24 shadow-xl">
            <div class="w-36 h-36 rounded-full bg-navy-800 mx-auto mb-4 flex items-center justify-center border-2 border-navy-600/30 overflow-hidden">
              <img src="{{ $founderPhoto }}" alt="{{ $s['founder_name'] ?? 'Founder' }}" class="w-full h-full object-cover object-top">
            </div>
            <h3 class="font-heading text-xl font-bold mb-1 text-navy-900">{{ $s['founder_name'] ?? 'Faris Isnawan, S.Pd., M.Pd.' }}</h3>
            <p class="text-blue-600 text-sm font-semibold mb-4">{{ $s['founder_position'] ?? 'Founder & CEO' }}</p>
            <div class="flex flex-col gap-2 text-sm text-gray-600 mb-6">
              <span>Professional Trainer</span><span>Konsultan SDM</span><span>Praktisi Pendidikan</span>
            </div>
            <div class="flex justify-center gap-3">
              <a href="https://instagram.com/{{ $s['founder_instagram'] ?? 'faris_isnawan' }}" target="_blank" rel="noopener noreferrer"
                 class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-blue-50 transition-colors">
                <i data-lucide="instagram" class="w-4 h-4 text-gray-600"></i>
              </a>
              <a href="https://wa.me/{{ $s['founder_whatsapp'] ?? '6285713014064' }}" target="_blank" rel="noopener noreferrer"
                 class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center hover:bg-blue-50 transition-colors">
                <i data-lucide="phone" class="w-4 h-4 text-gray-600"></i>
              </a>
            </div>
            @if(!empty($s['founder_whatsapp']))<p class="text-gray-400 text-xs mt-4">📞 0{{ substr($s['founder_whatsapp'],2) }}</p>@endif
            @if(!empty($s['founder_instagram']))<p class="text-gray-400 text-xs mt-1">📸 {{ '@'.$s['founder_instagram'] }}</p>@endif
          </div>
        </div>
        <div class="lg:col-span-2 space-y-8">
          @if($certs->isNotEmpty())
          <div>
            <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color:var(--color-primary);">
              <i data-lucide="shield-check" class="w-5 h-5"></i> Sertifikasi &amp; Keahlian
            </h3>
            <div class="grid sm:grid-cols-2 gap-3">
              @foreach($certs->where('is_visible',true) as $cert)
                <div class="cert-badge rounded-lg p-4">
                  <span class="text-sm text-white/90 font-medium">{{ $cert->title }}</span>
                </div>
              @endforeach
            </div>
          </div>
          @endif
          @if(isset($businesses)&&$businesses->isNotEmpty())
          <div>
            <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color:var(--color-primary);">
              <i data-lucide="briefcase" class="w-5 h-5"></i> Kepemilikan Bisnis
            </h3>
            <div class="bg-white rounded-xl p-5 border border-navy-900/5 space-y-4 shadow-md">
              @php $owners=$businesses->where('role','owner')->where('is_visible',true); $founders2=$businesses->where('role','founder')->where('is_visible',true); @endphp
              @if($owners->isNotEmpty())<div><p class="text-gray-400 text-xs uppercase tracking-wider mb-2">Owner</p><p class="text-navy-900 font-medium text-sm">{{ $owners->pluck('entity_name')->implode(' • ') }}</p></div>@endif
              @if($founders2->isNotEmpty())<div><p class="text-gray-400 text-xs uppercase tracking-wider mb-2">Founder</p><p class="text-navy-900 font-medium text-sm">{{ $founders2->pluck('entity_name')->implode(' • ') }}</p></div>@endif
            </div>
          </div>
          @endif
          @if(isset($experiences)&&$experiences->isNotEmpty())
          <div>
            <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color:var(--color-primary);">
              <i data-lucide="trending-up" class="w-5 h-5"></i> Pengalaman Pelatihan
            </h3>
            <div class="space-y-4">
              @foreach($experiences->where('is_visible',true) as $exp)
                <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                  <div class="flex items-center gap-3 mb-3">
                    <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">{{ $exp->stat_label }}</span>
                    <span class="text-navy-900 font-bold">{{ $exp->category }}</span>
                  </div>
                  @if(!empty($exp->description))<p class="text-gray-600 text-sm">{{ $exp->description }}</p>@endif
                </div>
              @endforeach
            </div>
          </div>
          @else
          <div>
            <h3 class="font-heading text-xl font-bold mb-4 flex items-center gap-2" style="color:var(--color-primary);">
              <i data-lucide="trending-up" class="w-5 h-5"></i> Pengalaman Pelatihan
            </h3>
            <div class="space-y-4">
              @foreach([['stat_corporate','35+','Instansi Korporasi'],['stat_government','60+','Instansi Pemerintah'],['stat_education','200+','Instansi Pendidikan']] as [$k,$d,$l])
              <div class="bg-white rounded-xl p-5 border border-navy-900/5 shadow-md">
                <div class="flex items-center gap-3">
                  <span class="text-2xl font-heading font-black" style="color:var(--color-primary);">{{ $s[$k]??$d }}</span>
                  <span class="text-navy-900 font-bold">{{ $l }}</span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endif
        </div>
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
      <div class="flex justify-center gap-3 mb-10">
        <button class="tab-btn px-6 py-2.5 rounded-lg font-semibold text-sm border transition-all bg-[var(--color-primary)] text-white border-[var(--color-primary)]" data-tab="news" onclick="switchTab('news',this)">News</button>
        <button class="tab-btn px-6 py-2.5 rounded-lg font-semibold text-sm border transition-all bg-white text-navy-900 border-[var(--color-primary)]" data-tab="gallery" onclick="switchTab('gallery',this)">Gallery</button>
      </div>
      <div id="tab-news">
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          @foreach($posts as $post)
            <article class="bg-white rounded-3xl overflow-hidden border border-navy-900/5 hover:border-blue-500/20 transition-colors shadow-md">
              @if($post->thumbnail_path)
                <img src="{{ asset('storage/'.$post->thumbnail_path) }}" alt="{{ $post->title }}" class="h-44 w-full object-cover">
              @else
                <div class="h-44 bg-gray-50 flex items-center justify-center border-b border-gray-100">
                  <i data-lucide="newspaper" class="w-10 h-10 text-blue-500/20"></i>
                </div>
              @endif
              <div class="p-5">
                <div class="flex items-center justify-between gap-3 mb-3">
                  <span class="text-blue-600 text-xs font-bold uppercase tracking-wider">{{ $post->category }}</span>
                  <span class="text-gray-400 text-xs">{{ $post->display_date ?? $post->created_at->format('d M Y') }}</span>
                </div>
                <h4 class="font-heading font-bold mt-2 mb-3 text-navy-900">{{ $post->title }}</h4>
                <p class="text-gray-600 text-sm mb-5">{{ $post->excerpt }}</p>
                <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center justify-center rounded-full bg-[var(--color-primary)] px-4 py-2 text-sm font-semibold text-white hover:bg-blue-600 transition">Baca Selengkapnya</a>
              </div>
            </article>
          @endforeach
        </div>
        <div class="mt-10 text-center">
          <a href="{{ route('blog.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-[var(--color-primary)] border border-[var(--color-primary)] hover:bg-[var(--color-primary)] hover:text-white transition">Lihat Semua Berita</a>
        </div>
      </div>
      <div id="tab-gallery" class="hidden space-y-8">
        @if($gallery->isNotEmpty())
          @php $chunks=$gallery->chunk(ceil($gallery->count()/2)); @endphp
          @foreach($chunks as $row)
            <div class="flex overflow-x-auto hide-scrollbar snap-x snap-mandatory">
              <div class="flex gap-4 px-4 pb-4 {{ $row->count()<=5?'mx-auto':'' }}">
                @foreach($row as $item)
                  <div class="flex-none w-44 sm:w-52 aspect-square rounded-2xl overflow-hidden shadow-lg snap-center gallery-item bg-navy-800/10 border border-navy-900/5">
                    @if($item->type==='image')
                      <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @else
                      <video src="{{ asset('storage/'.$item->file_path) }}" class="w-full h-full object-cover" muted loop playsinline onmouseover="this.play()" onmouseout="this.pause()"></video>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        @else
          <p class="text-center text-white/50 py-8">Belum ada foto/video galeri.</p>
        @endif
      </div>
    </div>
  </section>
  @endif

  {{--
  ╔══════════════════════════════════════════════════════════════
  ║  CONTACT SECTION
  ║  ► Kartu Email menggunakan mailto: dengan subject & body
  ║    yang sudah disiapkan di variabel $mailtoLink (PHP atas)
  ╚══════════════════════════════════════════════════════════════
  --}}
  <!-- CONTACT -->
  <section id="contact" class="bg-transparent py-16 sm:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-3 text-navy-900">Contact Us</h2>
        <p class="text-navy-900/70 font-bold max-w-2xl mx-auto leading-relaxed">
          Mari berkolaborasi dengan Esensial Training &amp; Consulting guna mewujudkan sumber daya manusia instansi yang berkualitas dan berdaya saing tinggi.
        </p>
      </div>
      <div class="grid sm:grid-cols-3 gap-5">

        {{-- Instagram --}}
        <a href="https://instagram.com/{{ $s['contact_instagram']??'esensial.trainingconsulting' }}"
           target="_blank" rel="noopener noreferrer"
           class="bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="instagram" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">Instagram</p>
          <p class="text-gray-600 text-xs">{{ '@'.($s['contact_instagram']??'esensial.trainingconsulting') }}</p>
        </a>

        {{-- WhatsApp --}}
        <a href="https://wa.me/{{ $s['contact_whatsapp']??'6285713014064' }}"
           target="_blank" rel="noopener noreferrer"
           class="bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="phone" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">WhatsApp</p>
          <p class="text-gray-600 text-xs">@php $wa=$s['contact_whatsapp']??'6285713014064';echo '0'.substr($wa,2); @endphp</p>
        </a>

        {{--
          ╔═══════════════════════════════════════════════════
          ║  EMAIL CARD — mailto: dengan subject + body
          ║  • target="_self" agar browser tidak blokir popup
          ║  • rel="noopener" tetap aman
          ║  • Semua hover effect dipertahankan
          ╚═══════════════════════════════════════════════════
        --}}
        <a href="{{ $mailtoLink }}"
           target="_self"
           rel="noopener"
           class="contact-card-email bg-white rounded-xl p-6 border border-navy-900/5 text-center hover:border-blue-500/30 transition-all group shadow-lg">
          <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
            <i data-lucide="mail" class="w-6 h-6 text-blue-600"></i>
          </div>
          <p class="font-bold text-sm mb-1 text-navy-900">Email</p>
          <p class="text-gray-600 text-xs break-all">{{ $contactEmail }}</p>
        </a>

      </div>
    </div>
  </section>

  {{--
  ╔══════════════════════════════════════════════════════════════
  ║  FOOTER
  ║  ► Baris email di footer juga menggunakan $mailtoLink
  ╚══════════════════════════════════════════════════════════════
  --}}
  <!-- FOOTER -->
  <footer class="border-t border-white/10" style="background:var(--color-footer);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <div>
          <div class="flex items-center gap-3 mb-4">
            <img src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}" alt="Logo" class="h-10 w-auto rounded-lg object-contain">
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
            <i data-lucide="map-pin" class="w-4 h-4 inline mr-1"></i>{{ $s['contact_address']??'' }}
          </p>
        </div>
        <div>
          <h4 class="font-heading font-bold text-sm mb-4">Hubungi Kami</h4>
          <div class="space-y-2 text-sm text-white/50">
            <p>
              <i data-lucide="instagram" class="w-4 h-4 inline mr-1"></i>
              {{ '@'.($s['contact_instagram']??'') }}
            </p>
            <p>
              <i data-lucide="phone" class="w-4 h-4 inline mr-1"></i>
              {{ $s['contact_whatsapp']??'' }}
            </p>
            {{--
              ► Footer email: anchor mailto agar bisa diklik langsung
                Tetap pakai style footer (text-white/50) + hover lebih terang
            --}}
            <p>
              <i data-lucide="mail" class="w-4 h-4 inline mr-1"></i>
              <a href="{{ $mailtoLink }}"
                 target="_self"
                 rel="noopener"
                 class="footer-email-link hover:text-white/85 underline-offset-2 hover:underline">
                {{ $contactEmail }}
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="section-divider mt-10 mb-6"></div>
      <p class="text-center text-white/30 text-xs">© {{ date('Y') }} Esensial Training & Consulting. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function switchTab(tab,btn){
      ['news','gallery'].forEach(t=>document.getElementById('tab-'+t).classList.add('hidden'));
      document.getElementById('tab-'+tab).classList.remove('hidden');
      document.querySelectorAll('.tab-btn').forEach(b=>{b.classList.remove('bg-[var(--color-primary)]','text-white');b.classList.add('bg-white','text-navy-900');});
      btn.classList.remove('bg-white','text-navy-900');btn.classList.add('bg-[var(--color-primary)]','text-white');
    }
    document.getElementById('mobile-menu-btn').addEventListener('click',()=>document.getElementById('mobile-menu').classList.add('open'));
    document.getElementById('mobile-close-btn').addEventListener('click',()=>document.getElementById('mobile-menu').classList.remove('open'));
    document.querySelectorAll('.mobile-nav-link').forEach(l=>l.addEventListener('click',()=>document.getElementById('mobile-menu').classList.remove('open')));

    function updateNavbarState(){
      const nav=document.getElementById('main-nav');
      const brand=document.getElementById('nav-brand');
      const tagline=document.getElementById('nav-tagline');
      const cBtn=document.getElementById('nav-contact-btn');
      const links=document.querySelectorAll('.nav-link');
      const mBtn=document.getElementById('mobile-menu-btn');
      if(window.scrollY>50){
        nav.classList.add('scrolled');
        nav.style.background='rgba(4,89,154,.95)';nav.style.backdropFilter='blur(12px)';nav.style.boxShadow='0 2px 20px rgba(0,0,0,.3)';
        brand?.classList.replace('text-navy-900','text-white');tagline?.classList.replace('text-navy-900','text-white/80');
        cBtn?.classList.replace('border-blue-600','border-white');cBtn?.classList.replace('text-blue-600','text-white');
        mBtn?.classList.replace('text-navy-900','text-white');links.forEach(l=>l.classList.replace('text-navy-900/80','text-white/80'));
      }else{
        nav.classList.remove('scrolled');
        nav.style.background='transparent';nav.style.backdropFilter='none';nav.style.boxShadow='none';
        brand?.classList.replace('text-white','text-navy-900');tagline?.classList.replace('text-white/80','text-navy-900');
        cBtn?.classList.replace('border-white','border-blue-600');cBtn?.classList.replace('text-white','text-blue-600');
        mBtn?.classList.replace('text-white','text-navy-900');links.forEach(l=>l.classList.replace('text-white/80','text-navy-900/80'));
      }
    }

    window.addEventListener('scroll', updateNavbarState);
    window.addEventListener('load', updateNavbarState);
    lucide.createIcons();
  </script>
</body>
</html>