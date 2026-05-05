@extends('admin.layout')
@section('title', 'Hero Section')

@section('content')
<form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data">
  @csrf

  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-5 text-sm uppercase tracking-wide">Konten Teks Hero</h3>
    <div class="grid gap-5">
      <div>
        <label>Judul Utama</label>
        <input type="text" name="hero_title" value="{{ old('hero_title', $s['hero_title'] ?? '') }}" placeholder="ESENSIAL TRAINING & CONSULTING" required>
      </div>
      <div>
        <label>Tagline</label>
        <input type="text" name="hero_tagline" value="{{ old('hero_tagline', $s['hero_tagline'] ?? '') }}" placeholder="Professional Skills Excellent" required>
      </div>
      <div>
        <label>Deskripsi Singkat</label>
        <textarea name="hero_description">{{ old('hero_description', $s['hero_description'] ?? '') }}</textarea>
      </div>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label>Teks Tombol CTA</label>
          <input type="text" name="hero_cta_text" value="{{ old('hero_cta_text', $s['hero_cta_text'] ?? 'Lihat Program') }}">
        </div>
        <div>
          <label>Link Tombol CTA</label>
          <input type="text" name="hero_cta_link" value="{{ old('hero_cta_link', $s['hero_cta_link'] ?? '#program') }}">
        </div>
      </div>
    </div>
  </div>

  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Foto Founder (Hero)</h3>
    @if(!empty($s['founder_photo']))
      <div class="mb-4 flex items-center gap-3">
        <img src="{{ asset('storage/' . $s['founder_photo']) }}" alt="Founder" class="h-24 w-auto rounded-lg object-cover border border-gray-200">
        <span class="text-sm text-gray-500">Foto saat ini</span>
      </div>
    @endif
    <label class="upload-zone block cursor-pointer">
      <input type="file" name="founder_photo" accept="image/*" class="hidden">
      <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
      <p class="text-sm text-gray-500 font-medium">Klik untuk upload foto founder</p>
      <p class="text-xs text-gray-400 mt-1">PNG, JPG — maks 5MB · Rekomendasi 400×500px</p>
    </label>
  </div>

  <div class="flex gap-3">
    <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
    <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
  </div>
</form>
@endsection