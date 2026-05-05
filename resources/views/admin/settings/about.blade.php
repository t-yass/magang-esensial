@extends('admin.layout')
@section('title', 'About / Founder')

@section('content')
<form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
  @csrf

  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Profil Founder</h3>
    <div class="grid sm:grid-cols-2 gap-5">
      <div>
        <label>Nama Lengkap</label>
        <input type="text" name="founder_name" value="{{ old('founder_name', $s['founder_name'] ?? '') }}" required>
      </div>
      <div>
        <label>Jabatan</label>
        <input type="text" name="founder_position" value="{{ old('founder_position', $s['founder_position'] ?? '') }}" required>
      </div>
      <div>
        <label>Username Instagram (tanpa @)</label>
        <input type="text" name="founder_instagram" value="{{ old('founder_instagram', $s['founder_instagram'] ?? '') }}">
      </div>
      <div>
        <label>WhatsApp (format: 62xxx)</label>
        <input type="tel" name="founder_whatsapp" value="{{ old('founder_whatsapp', $s['founder_whatsapp'] ?? '') }}">
      </div>
      <div class="sm:col-span-2">
        <label>Foto Profil</label>
        @if(!empty($s['founder_photo']))
          <div class="mb-3 flex items-center gap-3">
            <img src="{{ asset('storage/' . $s['founder_photo']) }}" alt="Founder" class="h-20 w-20 rounded-full object-cover border border-gray-200">
            <span class="text-sm text-gray-500">Foto saat ini</span>
          </div>
        @endif
        <label class="upload-zone block cursor-pointer">
          <input type="file" name="profile_photo" accept="image/*" class="hidden">
          <i data-lucide="user" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
          <p class="text-sm text-gray-500">Klik untuk upload foto profil</p>
          <p class="text-xs text-gray-400 mt-1">Rekomendasi 400×400px</p>
        </label>
      </div>
    </div>
  </div>

  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Statistik Pengalaman</h3>
    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label>Instansi Korporasi</label>
        <input type="text" name="stat_corporate" value="{{ old('stat_corporate', $s['stat_corporate'] ?? '35+') }}" placeholder="35+">
      </div>
      <div>
        <label>Instansi Pemerintah</label>
        <input type="text" name="stat_government" value="{{ old('stat_government', $s['stat_government'] ?? '60+') }}" placeholder="60+">
      </div>
      <div>
        <label>Instansi Pendidikan</label>
        <input type="text" name="stat_education" value="{{ old('stat_education', $s['stat_education'] ?? '200+') }}" placeholder="200+">
      </div>
    </div>
  </div>

  <div class="form-card">
    <div class="flex items-center justify-between mb-4">
      <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Sertifikasi & Keahlian</h3>
      <button type="button" onclick="addCertRow()" class="btn-success"><i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah</button>
    </div>
    <div id="cert-list" class="space-y-2">
      @foreach($certs as $cert)
        <div class="flex gap-2 items-center">
          <input type="text" name="certs[]" value="{{ $cert->title }}" class="flex-1" placeholder="Nama sertifikasi...">
          <button type="button" class="btn-danger" onclick="this.closest('div').remove()">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
        </div>
      @endforeach
    </div>
  </div>

  <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
</form>
@endsection

@section('scripts')
<script>
  function addCertRow() {
    const list = document.getElementById('cert-list');
    const div = document.createElement('div');
    div.className = 'flex gap-2 items-center';
    div.innerHTML = `<input type="text" name="certs[]" placeholder="Nama sertifikasi..." class="flex-1" style="width:100%;padding:9px 12px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:14px;"><button type="button" class="btn-danger" onclick="this.closest('div').remove()"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>`;
    list.appendChild(div);
    lucide.createIcons();
  }
</script>
@endsection