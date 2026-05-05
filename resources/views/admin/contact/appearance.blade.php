{{-- views/admin/settings/appearance.blade.php --}}
@extends('admin.layout')
@section('title', 'Tampilan & Font')

@section('content')
<form method="POST" action="{{ route('admin.appearance.update') }}">
  @csrf

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

  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Warna Brand</h3>
    <div class="grid sm:grid-cols-2 gap-4">
      @foreach([
        ['color_primary',    'Warna Utama (Primary)',    '#04599A'],
        ['color_accent',     'Warna Aksen',              '#d4af37'],
        ['color_background', 'Warna Background',         '#072d52'],
        ['color_text',       'Warna Teks',               '#ffffff'],
      ] as [$key, $label, $default])
        <div>
          <label>{{ $label }}</label>
          <div class="flex gap-2">
            <input type="color" name="{{ $key }}_picker" value="{{ $s[$key] ?? $default }}"
              oninput="document.getElementById('txt_{{ $key }}').value=this.value"
              style="width:42px;height:38px;padding:2px;border-radius:8px;border:1.5px solid #e5e7eb;cursor:pointer;flex-shrink:0;">
            <input type="text" name="{{ $key }}" id="txt_{{ $key }}"
              value="{{ old($key, $s[$key] ?? $default) }}"
              oninput="this.previousElementSibling.value=this.value"
              style="flex:1;">
          </div>
        </div>
      @endforeach
    </div>
  </div>

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

  <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Pengaturan</button>
</form>
@endsection