{{-- views/admin/settings/appearance.blade.php --}}
@extends('admin.layout')
@section('title', 'Tampilan & Font')

@section('content')

{{-- ═══════════════════════════════════════════════════
     CROP MODAL — dipanggil saat logo diupload
════════════════════════════════════════════════════ --}}
<div id="logoCropModal"
     class="fixed inset-0 z-[999] hidden items-center justify-center p-3 sm:p-5"
     style="background:rgba(2,8,23,.82);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);">

  <div class="relative w-full max-w-5xl rounded-3xl bg-white shadow-2xl overflow-hidden
              flex flex-col" style="max-height:96dvh;">

    {{-- Modal header --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 flex-shrink-0">
      <div>
        <h4 class="font-semibold text-slate-900 text-base">Pengaturan Crop Logo</h4>
        <p class="text-xs text-slate-400 mt-0.5">Drag & zoom untuk menyesuaikan area logo. Preview diperbarui secara realtime.</p>
      </div>
      <button type="button" id="close-logo-modal"
              class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors">
        <i data-lucide="x" class="w-4 h-4 text-slate-600"></i>
      </button>
    </div>

    {{-- Modal body --}}
    <div class="flex-1 overflow-y-auto p-5 sm:p-6">
      <div class="grid gap-6 lg:grid-cols-[1fr_320px]">

        {{-- ── Crop area ── --}}
        <div class="flex flex-col gap-3">
          <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Area Crop</div>
          <div id="crop-stage"
               class="rounded-2xl border border-slate-200 bg-[#f8fafc] overflow-hidden flex items-center justify-center"
               style="min-height:220px; max-height:420px;">
            <img id="logo-cropper-image" src="" alt="Crop logo"
                 class="block max-w-full" style="display:none;">
            <div id="crop-placeholder"
                 class="flex flex-col items-center justify-center gap-3 text-slate-300 py-16">
              <i data-lucide="image" class="w-12 h-12"></i>
              <span class="text-sm">Unggah logo untuk mulai crop</span>
            </div>
          </div>

          {{-- Zoom slider --}}
          <div id="zoom-row" class="hidden flex items-center gap-3">
            <button type="button" id="logo-zoom-out"
                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors flex-shrink-0">
              <i data-lucide="minus" class="w-3.5 h-3.5 text-slate-600"></i>
            </button>
            <input type="range" id="logo-zoom-slider" min="0" max="300" value="0" step="1"
                   class="flex-1 h-1.5 rounded-full appearance-none cursor-pointer"
                   style="accent-color:#4f46e5;">
            <button type="button" id="logo-zoom-in"
                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-colors flex-shrink-0">
              <i data-lucide="plus" class="w-3.5 h-3.5 text-slate-600"></i>
            </button>
            <span id="logo-zoom-value"
                  class="text-xs font-bold text-slate-700 w-10 text-right flex-shrink-0">100%</span>
          </div>
        </div>

        {{-- ── Controls panel ── --}}
        <div class="flex flex-col gap-5">

          {{-- Aspect ratio --}}
          <div>
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Rasio Frame</div>
            <div class="grid grid-cols-2 gap-2" id="ratio-btns">
              <button type="button" data-ratio="4/1"
                      class="ratio-btn px-3 py-2 rounded-xl border text-xs font-semibold transition-all
                             border-indigo-500 bg-indigo-50 text-indigo-700">
                Horizontal 4:1
              </button>
              <button type="button" data-ratio="3/1"
                      class="ratio-btn px-3 py-2 rounded-xl border text-xs font-semibold transition-all
                             border-slate-200 bg-white text-slate-600 hover:border-slate-300">
                Horizontal 3:1
              </button>
              <button type="button" data-ratio="2/1"
                      class="ratio-btn px-3 py-2 rounded-xl border text-xs font-semibold transition-all
                             border-slate-200 bg-white text-slate-600 hover:border-slate-300">
                Horizontal 2:1
              </button>
              <button type="button" data-ratio="1/1"
                      class="ratio-btn px-3 py-2 rounded-xl border text-xs font-semibold transition-all
                             border-slate-200 bg-white text-slate-600 hover:border-slate-300">
                Kotak 1:1
              </button>
            </div>
          </div>

          {{-- Quick actions --}}
          <div>
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Aksi Cepat</div>
            <div class="flex flex-wrap gap-2">
              <button type="button" id="logo-rotate-left"
                      class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200
                             text-xs font-semibold text-slate-600 transition-colors">
                <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i> Putar Kiri
              </button>
              <button type="button" id="logo-rotate-right"
                      class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200
                             text-xs font-semibold text-slate-600 transition-colors">
                <i data-lucide="rotate-cw" class="w-3.5 h-3.5"></i> Putar Kanan
              </button>
              <button type="button" id="logo-flip-h"
                      class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200
                             text-xs font-semibold text-slate-600 transition-colors">
                <i data-lucide="flip-horizontal-2" class="w-3.5 h-3.5"></i> Flip
              </button>
              <button type="button" id="logo-reset-button"
                      class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100
                             text-xs font-semibold text-amber-700 transition-colors border border-amber-200">
                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Reset
              </button>
            </div>
          </div>

          {{-- Preview realtime --}}
          <div>
            <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">
              Pratinjau Realtime
            </div>

            {{-- Navbar simulation --}}
            <div class="rounded-2xl border border-slate-200 overflow-hidden mb-2">
              <div class="bg-slate-700 px-3 py-1.5 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-red-400"></div>
                <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                <div class="w-2 h-2 rounded-full bg-green-400"></div>
                <span class="text-[10px] text-slate-400 ml-1">Navbar Preview</span>
              </div>
              <div class="bg-[#04599A] px-4 py-2.5 flex items-center gap-3">
                <div class="h-9 w-24 rounded-lg overflow-hidden bg-white/10 flex items-center justify-center">
                  <img id="preview-navbar" src="" alt="navbar"
                       class="max-h-full max-w-full object-contain" style="display:none;">
                  <span id="preview-navbar-ph" class="text-[9px] text-white/40">Logo</span>
                </div>
                <div class="flex gap-4 ml-auto">
                  <div class="w-8 h-1.5 rounded bg-white/20"></div>
                  <div class="w-8 h-1.5 rounded bg-white/20"></div>
                  <div class="w-8 h-1.5 rounded bg-white/20"></div>
                </div>
              </div>
            </div>

            {{-- Footer simulation --}}
            <div class="rounded-2xl border border-slate-200 overflow-hidden">
              <div class="bg-[#072d52] px-4 py-3 flex items-center gap-3">
                <div class="h-8 w-20 rounded-lg overflow-hidden bg-white/10 flex items-center justify-center">
                  <img id="preview-footer" src="" alt="footer"
                       class="max-h-full max-w-full object-contain" style="display:none;">
                  <span id="preview-footer-ph" class="text-[9px] text-white/40">Logo</span>
                </div>
                <div class="ml-auto flex flex-col gap-1">
                  <div class="w-16 h-1 rounded bg-white/15"></div>
                  <div class="w-12 h-1 rounded bg-white/10"></div>
                </div>
              </div>
              <div class="bg-[#051f3a] px-4 py-1.5 text-center">
                <div class="w-24 h-1 rounded bg-white/10 mx-auto"></div>
              </div>
            </div>
          </div>

          {{-- Save / cancel --}}
          <div class="flex gap-3 mt-auto pt-2">
            <button type="button" id="save-logo-crop"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
                           bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold
                           transition-colors shadow-sm shadow-indigo-200">
              <i data-lucide="check" class="w-4 h-4"></i> Simpan Crop
            </button>
            <button type="button" id="cancel-logo-crop"
                    class="flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl
                           bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold
                           transition-colors">
              <i data-lucide="x" class="w-4 h-4"></i> Batal
            </button>
          </div>

        </div>{{-- /controls --}}
      </div>{{-- /grid --}}
    </div>{{-- /modal body --}}
  </div>{{-- /modal box --}}
</div>{{-- /modal --}}


{{-- ═══════════════════════════════════════════════════
     FORM UTAMA
════════════════════════════════════════════════════ --}}
<form method="POST" action="{{ route('admin.appearance.update') }}" enctype="multipart/form-data" id="appearance-form">
  @csrf

  {{-- Tipografi --}}
  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tipografi</h3>
    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label>Font Heading</label>
        <select name="font_heading">
          @foreach(['Playfair Display','Merriweather','Lora','DM Serif Display','Georgia'] as $f)
            <option value="{{ $f }}" {{ ($s['font_heading'] ?? 'Playfair Display') === $f ? 'selected' : '' }}>{{ $f }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>Font Body</label>
        <select name="font_body">
          @foreach(['DM Sans','Poppins','Nunito','Inter','Roboto'] as $f)
            <option value="{{ $f }}" {{ ($s['font_body'] ?? 'DM Sans') === $f ? 'selected' : '' }}>{{ $f }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>Ukuran Font (px)</label>
        <select name="font_size">
          @foreach([14,15,16,17,18,20] as $sz)
            <option value="{{ $sz }}" {{ (int)($s['font_size'] ?? 16) === $sz ? 'selected' : '' }}>{{ $sz }}px</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  {{-- SEO & Meta --}}
  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">SEO & Meta</h3>
    <div class="grid gap-4">
      <div>
        <label>Title Website</label>
        <input type="text" name="site_title" value="{{ old('site_title', $s['site_title'] ?? '') }}">
      </div>
      <div>
        <label>Meta Description</label>
        <textarea name="site_description" style="min-height:70px;">{{ old('site_description', $s['site_description'] ?? '') }}</textarea>
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════
       LOGO SECTION — upload + crop + preview
  ════════════════════════════════════════════════ --}}
  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-5 text-sm uppercase tracking-wide">Logo Website</h3>

    <div class="grid gap-6">

      {{-- Upload zone --}}
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-1.5">Upload Logo Baru</label>
        <label for="site_logo_input"
               class="upload-zone flex flex-col items-center justify-center gap-3 rounded-2xl border-2 border-dashed border-slate-200
                      bg-slate-50 hover:bg-slate-100 hover:border-indigo-300 transition-all cursor-pointer
                      p-8 text-center" id="upload-zone-label">
          <input id="site_logo_input" type="file" name="site_logo"
                 accept="image/png,image/jpeg,image/webp,image/svg+xml" class="hidden">
          <div id="upload-icon-wrap"
               class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm
                      flex items-center justify-center transition-transform">
            <i data-lucide="upload-cloud" class="w-7 h-7 text-indigo-400"></i>
          </div>
          <div>
            <p class="text-sm font-semibold text-slate-700">Klik untuk unggah logo</p>
            <p class="text-xs text-slate-400 mt-1">PNG, JPG, WebP, SVG — maks. 5 MB</p>
            <p class="text-xs text-slate-400">Rasio horizontal direkomendasikan (4:1 atau 3:1)</p>
          </div>
          {{-- Filename badge (hidden until file selected) --}}
          <div id="upload-filename-badge"
               class="hidden items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 border border-indigo-100">
            <i data-lucide="file-image" class="w-3.5 h-3.5 text-indigo-500"></i>
            <span id="upload-filename" class="text-xs font-semibold text-indigo-700"></span>
          </div>
        </label>
      </div>

      {{-- Current + cropped preview side by side --}}
      <div class="grid sm:grid-cols-2 gap-4">

        {{-- Logo saat ini --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <div class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-3">Logo Saat Ini</div>
          <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
              <img id="current-logo-display"
                   src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}"
                   alt="Logo saat ini" class="max-h-full max-w-full object-contain p-1">
            </div>
            <div>
              <p class="text-sm font-semibold text-slate-800">Logo aktif</p>
              <p class="text-xs text-slate-400 mt-0.5 break-all">
                {{ !empty($s['site_logo']) ? basename($s['site_logo']) : 'logo.JPEG (default)' }}
              </p>
            </div>
          </div>
        </div>

        {{-- Hasil crop --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4">
          <div class="flex items-center justify-between mb-3">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Hasil Crop</div>
            <span id="crop-status-badge"
                  class="hidden text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200">
              ✓ Siap disimpan
            </span>
          </div>
          <div class="h-20 rounded-xl bg-slate-50 border border-dashed border-slate-200 overflow-hidden
                      flex items-center justify-center relative">
            <img id="logo-crop-preview"
                 src="{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}"
                 alt="Preview crop" class="max-h-full max-w-full object-contain p-1">
            <div id="crop-preview-overlay"
                 class="absolute inset-0 bg-white/70 hidden items-center justify-center">
              <div class="flex items-center gap-2 text-xs text-slate-400">
                <i data-lucide="scissors" class="w-3.5 h-3.5"></i>
                Belum di-crop
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Action buttons --}}
      <div class="flex flex-wrap gap-2.5">
        <button type="button" id="open-logo-modal"
                class="flex items-center gap-2 px-4 py-2 rounded-xl border border-indigo-200 bg-indigo-50
                       text-indigo-700 text-sm font-semibold hover:bg-indigo-100 transition-colors
                       disabled:opacity-40 disabled:cursor-not-allowed" disabled>
          <i data-lucide="crop" class="w-4 h-4"></i> Atur Crop Logo
        </button>
        <button type="button" id="reset-logo-crop"
                class="flex items-center gap-2 px-4 py-2 rounded-xl border border-amber-200 bg-amber-50
                       text-amber-700 text-sm font-semibold hover:bg-amber-100 transition-colors
                       disabled:opacity-40 disabled:cursor-not-allowed" disabled>
          <i data-lucide="refresh-ccw" class="w-4 h-4"></i> Reset Crop
        </button>
        <button type="button" id="clear-logo-upload"
                class="flex items-center gap-2 px-4 py-2 rounded-xl border border-rose-200 bg-rose-50
                       text-rose-700 text-sm font-semibold hover:bg-rose-100 transition-colors
                       disabled:opacity-40 disabled:cursor-not-allowed" disabled>
          <i data-lucide="trash-2" class="w-4 h-4"></i> Batalkan Unggah
        </button>
      </div>

    </div>{{-- /grid --}}

    {{-- Hidden crop data --}}
    <input type="hidden" name="site_logo_crop" id="site_logo_crop" value="">

  </div>{{-- /form-card logo --}}


  <button type="submit" class="btn-primary">
    <i data-lucide="save" class="w-4 h-4"></i> Simpan Pengaturan
  </button>
</form>


{{-- ═══════════════════════════════════════════════════
     CROPPER.JS
════════════════════════════════════════════════════ --}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css"
      crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"
        crossorigin="anonymous"></script>

<script>
(function () {
  'use strict';

  /* ── DOM refs ─────────────────────────────────────────────── */
  const logoInput       = document.getElementById('site_logo_input');
  const cropInput       = document.getElementById('site_logo_crop');
  const openModalBtn    = document.getElementById('open-logo-modal');
  const resetCropBtn    = document.getElementById('reset-logo-crop');
  const clearUploadBtn  = document.getElementById('clear-logo-upload');
  const modal           = document.getElementById('logoCropModal');
  const cropperImg      = document.getElementById('logo-cropper-image');
  const cropPlaceholder = document.getElementById('crop-placeholder');
  const cropPreview     = document.getElementById('logo-crop-preview');
  const previewNavbar   = document.getElementById('preview-navbar');
  const previewNavbarPh = document.getElementById('preview-navbar-ph');
  const previewFooter   = document.getElementById('preview-footer');
  const previewFooterPh = document.getElementById('preview-footer-ph');
  const zoomSlider      = document.getElementById('logo-zoom-slider');
  const zoomValue       = document.getElementById('logo-zoom-value');
  const zoomRow         = document.getElementById('zoom-row');
  const zoomInBtn       = document.getElementById('logo-zoom-in');
  const zoomOutBtn      = document.getElementById('logo-zoom-out');
  const resetBtn        = document.getElementById('logo-reset-button');
  const rotateLeftBtn   = document.getElementById('logo-rotate-left');
  const rotateRightBtn  = document.getElementById('logo-rotate-right');
  const flipHBtn        = document.getElementById('logo-flip-h');
  const closeModalBtn   = document.getElementById('close-logo-modal');
  const cancelCropBtn   = document.getElementById('cancel-logo-crop');
  const saveCropBtn     = document.getElementById('save-logo-crop');
  const ratioBtns       = document.querySelectorAll('.ratio-btn');
  const cropStatusBadge = document.getElementById('crop-status-badge');
  const uploadBadge     = document.getElementById('upload-filename-badge');
  const uploadFilename  = document.getElementById('upload-filename');
  const uploadZone      = document.getElementById('upload-zone-label');

  /* ── State ────────────────────────────────────────────────── */
  let cropper       = null;
  let rawImageData  = '';   // original file as data-url
  let croppedData   = '';   // last saved crop result
  let activeRatio   = 4 / 1;
  let flipH         = 1;    // 1 or -1
  let minZoom       = 0;

  /* ── Helpers ──────────────────────────────────────────────── */
  function toggleActions(on) {
    [openModalBtn, resetCropBtn, clearUploadBtn].forEach(b => b.disabled = !on);
  }

  function showPreviewImages(src) {
    /* crop preview card */
    cropPreview.src = src;

    /* navbar & footer simulations */
    previewNavbar.src    = src;
    previewNavbar.style.display = '';
    previewNavbarPh.style.display = 'none';

    previewFooter.src    = src;
    previewFooter.style.display = '';
    previewFooterPh.style.display = 'none';

    /* hidden input for form submission */
    cropInput.value = src;
    croppedData     = src;

    /* status badge */
    cropStatusBadge.classList.remove('hidden');
  }

  function buildCroppedCanvas() {
    if (!cropper) return null;
    const w = Math.round(1200);
    const h = Math.round(1200 / activeRatio);
    return cropper.getCroppedCanvas({
      width: w,
      height: h,
      imageSmoothingEnabled: true,
      imageSmoothingQuality: 'high',
      fillColor: 'transparent',
    });
  }

  function refreshLivePreviews() {
    const canvas = buildCroppedCanvas();
    if (!canvas) return;
    const url = canvas.toDataURL('image/png');
    showPreviewImages(url);
  }

  /* Debounce preview refresh while dragging/zooming */
  let previewTimer = null;
  function schedulePreview() {
    clearTimeout(previewTimer);
    previewTimer = setTimeout(refreshLivePreviews, 60);
  }

  /* Update zoom badge from slider value */
  function syncZoomUI(val) {
    const pct = Math.round(val * 100);
    zoomValue.textContent = pct + '%';
  }

  /* ── Init Cropper ─────────────────────────────────────────── */
  function initCropper(src) {
    cropperImg.src = src;
    cropperImg.style.display = '';
    cropPlaceholder.style.display = 'none';
    zoomRow.classList.remove('hidden');
    flipH = 1;

    if (cropper) { cropper.destroy(); cropper = null; }

    cropper = new Cropper(cropperImg, {
      aspectRatio    : activeRatio,
      viewMode       : 1,          /* restrict to canvas */
      dragMode       : 'move',
      autoCropArea   : 0.9,
      background     : true,
      responsive     : true,
      restore        : false,
      checkCrossOrigin: false,
      checkOrientation: false,
      movable        : true,
      zoomable       : true,
      zoomOnTouch    : true,
      zoomOnWheel    : true,
      cropBoxMovable : true,
      cropBoxResizable: true,
      toggleDragModeOnDblclick: false,

      ready() {
        const data = cropper.getCanvasData();
        minZoom = data.width ? (data.width / data.naturalWidth) : 0.1;
        zoomSlider.min   = 0;
        zoomSlider.max   = 300;
        zoomSlider.value = 0;
        syncZoomUI(1);
        refreshLivePreviews();
      },

      crop() {
        if (cropper) {
          const cd = cropper.getCanvasData();
          const ratio = cd.naturalWidth ? cd.width / cd.naturalWidth : 1;
          syncZoomUI(ratio);
        }
        schedulePreview();
      },
    });
  }

  /* ── Show / hide modal ────────────────────────────────────── */
  function showModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    if (cropper) setTimeout(() => cropper.resize(), 50);
  }

  function hideModal() {
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  }

  /* ── File input ───────────────────────────────────────────── */
  logoInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) { toggleActions(false); return; }

    /* Validate size 5 MB */
    if (file.size > 5 * 1024 * 1024) {
      alert('Ukuran file melebihi 5 MB. Pilih file yang lebih kecil.');
      logoInput.value = '';
      return;
    }

    /* Show filename badge */
    uploadFilename.textContent = file.name;
    uploadBadge.classList.remove('hidden');
    uploadBadge.classList.add('flex');

    /* Read file */
    const reader = new FileReader();
    reader.onload = ev => {
      rawImageData = ev.target.result;
      initCropper(rawImageData);
      toggleActions(true);
      showModal();
    };
    reader.readAsDataURL(file);
  });

  /* Drag & drop on upload zone */
  uploadZone.addEventListener('dragover',  e => { e.preventDefault(); uploadZone.classList.add('border-indigo-400', 'bg-indigo-50'); });
  uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('border-indigo-400', 'bg-indigo-50'));
  uploadZone.addEventListener('drop', e => {
    e.preventDefault();
    uploadZone.classList.remove('border-indigo-400', 'bg-indigo-50');
    const file = e.dataTransfer.files[0];
    if (!file || !file.type.startsWith('image/')) return;
    const dt = new DataTransfer();
    dt.items.add(file);
    logoInput.files = dt.files;
    logoInput.dispatchEvent(new Event('change'));
  });

  /* ── Modal controls ───────────────────────────────────────── */
  openModalBtn.addEventListener('click', () => {
    if (!rawImageData) return;
    showModal();
  });

  [closeModalBtn, cancelCropBtn].forEach(b => b.addEventListener('click', hideModal));

  /* Click outside modal to close */
  modal.addEventListener('click', e => { if (e.target === modal) hideModal(); });

  /* Escape key */
  document.addEventListener('keydown', e => { if (e.key === 'Escape') hideModal(); });

  /* Save crop */
  saveCropBtn.addEventListener('click', () => {
    const canvas = buildCroppedCanvas();
    if (!canvas) return;
    const url = canvas.toDataURL('image/png');
    showPreviewImages(url);
    rawImageData = url; /* so re-opening modal shows cropped version */
    hideModal();
  });

  /* Zoom buttons */
  zoomInBtn.addEventListener('click',  () => { if (cropper) cropper.zoom(0.1); });
  zoomOutBtn.addEventListener('click', () => { if (cropper) cropper.zoom(-0.1); });

  /* Zoom slider */
  zoomSlider.addEventListener('input', () => {
    if (!cropper) return;
    const target = minZoom + (parseInt(zoomSlider.value, 10) / 300) * 3;
    const cd     = cropper.getCanvasData();
    const current = cd.naturalWidth ? cd.width / cd.naturalWidth : 1;
    cropper.zoom(target - current);
  });

  /* Rotate */
  rotateLeftBtn.addEventListener('click',  () => { if (cropper) { cropper.rotate(-90); schedulePreview(); } });
  rotateRightBtn.addEventListener('click', () => { if (cropper) { cropper.rotate(90);  schedulePreview(); } });

  /* Flip horizontal */
  flipHBtn.addEventListener('click', () => {
    if (!cropper) return;
    flipH = flipH * -1;
    cropper.scaleX(flipH);
    schedulePreview();
  });

  /* Reset */
  resetBtn.addEventListener('click', () => {
    if (!cropper) return;
    flipH = 1;
    cropper.reset();
    schedulePreview();
  });

  /* Aspect ratio buttons */
  ratioBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      /* Active styling */
      ratioBtns.forEach(b => {
        b.classList.remove('border-indigo-500', 'bg-indigo-50', 'text-indigo-700');
        b.classList.add('border-slate-200', 'bg-white', 'text-slate-600');
      });
      btn.classList.remove('border-slate-200', 'bg-white', 'text-slate-600');
      btn.classList.add('border-indigo-500', 'bg-indigo-50', 'text-indigo-700');

      const [a, b2] = btn.dataset.ratio.split('/').map(Number);
      activeRatio = a / b2;

      if (cropper) {
        cropper.setAspectRatio(activeRatio);
        cropper.reset();
        schedulePreview();
      }
    });
  });

  /* Reset crop (back to raw) */
  resetCropBtn.addEventListener('click', () => {
    if (!rawImageData) return;
    initCropper(rawImageData);
    showPreviewImages(rawImageData);
    showModal();
  });

  /* Clear upload entirely */
  clearUploadBtn.addEventListener('click', () => {
    logoInput.value   = '';
    cropInput.value   = '';
    rawImageData      = '';
    croppedData       = '';

    uploadFilename.textContent = '';
    uploadBadge.classList.add('hidden');
    uploadBadge.classList.remove('flex');

    const defaultSrc = '{{ !empty($s['site_logo']) ? asset('storage/'.$s['site_logo']) : asset('images/logo.JPEG') }}';
    cropPreview.src = defaultSrc;

    previewNavbar.style.display    = 'none';
    previewNavbarPh.style.display  = '';
    previewFooter.style.display    = 'none';
    previewFooterPh.style.display  = '';

    cropStatusBadge.classList.add('hidden');

    if (cropper) { cropper.destroy(); cropper = null; }
    cropperImg.style.display    = 'none';
    cropPlaceholder.style.display = '';
    zoomRow.classList.add('hidden');

    hideModal();
    toggleActions(false);
  });

  /* ── Init ─────────────────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', () => {
    toggleActions(false);
    lucide?.createIcons?.();
  });

})();
</script>

@endsection