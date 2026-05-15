@extends('admin.layout')
@section('title', 'About Us / Founder')

@section('content')
<form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
  @csrf

  {{-- ── PROFIL FOUNDER ──────────────────────────────────────────────────────── --}}
  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide flex items-center gap-2">
      <i data-lucide="user" class="w-4 h-4 text-blue-500"></i> Profil Founder
    </h3>

    <div class="grid sm:grid-cols-2 gap-5">
      <div>
        <label class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
        <input type="text" name="founder_name"
               value="{{ old('founder_name', $s['founder_name'] ?? '') }}"
               class="form-input" required placeholder="Faris Isnawan, S.Pd., M.Pd.">
      </div>
      <div>
        <label class="form-label">Jabatan <span class="text-red-500">*</span></label>
        <input type="text" name="founder_position"
               value="{{ old('founder_position', $s['founder_position'] ?? '') }}"
               class="form-input" required placeholder="Founder & CEO">
      </div>
      <div>
        <label class="form-label">Username Instagram <span class="text-gray-400 font-normal">(tanpa @)</span></label>
        <input type="text" name="founder_instagram"
               value="{{ old('founder_instagram', $s['founder_instagram'] ?? '') }}"
               class="form-input" placeholder="faris_isnawan">
      </div>
      <div>
        <label class="form-label">WhatsApp <span class="text-gray-400 font-normal">(format: 62xxx)</span></label>
        <input type="tel" name="founder_whatsapp"
               value="{{ old('founder_whatsapp', $s['founder_whatsapp'] ?? '') }}"
               class="form-input" placeholder="6285713014064">
      </div>

      <div class="sm:col-span-2">
        <label class="form-label">Foto Profil</label>
        @if(!empty($s['founder_photo']))
          <div class="mb-3 flex items-center gap-4">
            <img src="{{ asset('storage/' . $s['founder_photo']) }}"
                 alt="Founder"
                 class="h-24 w-24 rounded-full object-cover border-2 border-blue-100 shadow">
            <div>
              <p class="text-sm font-medium text-gray-700">Foto saat ini</p>
              <p class="text-xs text-gray-400 mt-0.5">Upload baru untuk mengganti</p>
            </div>
          </div>
        @endif
        <label class="upload-zone block cursor-pointer border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-400 transition-colors">
          <input type="file" name="profile_photo" accept="image/*" class="hidden" id="photo-input">
          <i data-lucide="upload-cloud" class="w-8 h-8 text-gray-300 mx-auto mb-2"></i>
          <p class="text-sm text-gray-500">Klik untuk upload foto profil</p>
          <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP — Rekomendasi 400×400px, maks 5MB</p>
          <p id="photo-filename" class="text-xs text-blue-600 mt-2 font-medium hidden"></p>
        </label>
      </div>
    </div>
  </div>

  {{-- ── SERTIFIKASI & KEAHLIAN ───────────────────────────────────────────────── --}}
  <div class="form-card">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide flex items-center gap-2">
        <i data-lucide="shield-check" class="w-4 h-4 text-blue-500"></i> Sertifikasi & Keahlian
      </h3>
      <button type="button" onclick="addCertRow()" class="btn-success flex items-center gap-1.5 text-xs px-3 py-1.5">
        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah
      </button>
    </div>
    <div id="cert-list" class="space-y-3">
      @forelse($certs as $cert)
        <div class="cert-row flex gap-2 items-start p-3 bg-gray-50 rounded-lg border border-gray-100">
          <div class="flex-1">
            <input type="text" name="cert_titles[]"
                   value="{{ $cert->title }}"
                   class="form-input text-sm" placeholder="Nama sertifikasi...">
          </div>
          <button type="button" class="btn-danger mt-0.5 shrink-0" onclick="this.closest('.cert-row').remove()">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
        </div>
      @empty
        {{-- default rows kalau belum ada data --}}
        @foreach(['Certified Professional Trainer – BNSP RI','Certified Trainer & Master Neo NLP','Certified Hypnotist & Hypnotherapist','Certified Praktisi Talents Mapping','Certified Master Service Excellence','Certified Public Speaking'] as $default)
          <div class="cert-row flex gap-2 items-start p-3 bg-gray-50 rounded-lg border border-gray-100">
            <div class="flex-1">
              <input type="text" name="cert_titles[]" value="{{ $default }}" class="form-input text-sm" placeholder="Nama sertifikasi...">
            </div>
            <button type="button" class="btn-danger mt-0.5 shrink-0" onclick="this.closest('.cert-row').remove()">
              <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
            </button>
          </div>
        @endforeach
      @endforelse
    </div>
    <p class="text-xs text-gray-400 mt-3">Kolom keterangan bersifat opsional — digunakan sebagai info tambahan di bawah nama sertifikasi.</p>
  </div>

  {{-- ── KEPEMILIKAN BISNIS ───────────────────────────────────────────────────── --}}
  <div class="form-card">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide flex items-center gap-2">
        <i data-lucide="briefcase" class="w-4 h-4 text-blue-500"></i> Kepemilikan Bisnis
      </h3>
      <button type="button" onclick="addBizRow()" class="btn-success flex items-center gap-1.5 text-xs px-3 py-1.5">
        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah
      </button>
    </div>
    <div id="biz-list" class="space-y-3">
      @forelse($businesses as $biz)
        <div class="biz-row flex gap-2 items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
          <select name="biz_roles[]" class="form-input text-sm w-32 shrink-0">
            <option value="owner"   {{ $biz->role === 'owner'   ? 'selected' : '' }}>Owner</option>
            <option value="founder" {{ $biz->role === 'founder' ? 'selected' : '' }}>Founder</option>
          </select>
          <input type="text" name="biz_names[]"
                 value="{{ $biz->entity_name }}"
                 class="form-input text-sm flex-1" placeholder="Nama bisnis / lembaga...">
          <button type="button" class="btn-danger shrink-0" onclick="this.closest('.biz-row').remove()">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
        </div>
      @empty
        {{-- default rows --}}
        @foreach([
            ['owner','CV Trans Cemerlang Indonesia'],
            ['owner','PT. Esensial Mutu Indonesia'],
            ['owner','Shion Fashion'],
            ['founder','Esensial Training & Consulting'],
            ['founder','Communication Skill Academy'],
            ['founder','BukaBakat.id'],
            ['founder','GuruPAI.id'],
            ['founder','Motive Spirit Idea'],
          ] as [$role,$name])
          <div class="biz-row flex gap-2 items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
            <select name="biz_roles[]" class="form-input text-sm w-32 shrink-0">
              <option value="owner"   {{ $role === 'owner'   ? 'selected' : '' }}>Owner</option>
              <option value="founder" {{ $role === 'founder' ? 'selected' : '' }}>Founder</option>
            </select>
            <input type="text" name="biz_names[]" value="{{ $name }}" class="form-input text-sm flex-1" placeholder="Nama bisnis / lembaga...">
            <button type="button" class="btn-danger shrink-0" onclick="this.closest('.biz-row').remove()">
              <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
            </button>
          </div>
        @endforeach
      @endforelse
    </div>
    <p class="text-xs text-gray-400 mt-3">Role <strong>Owner</strong> ditampilkan di kelompok "Owner", role <strong>Founder</strong> di kelompok "Founder".</p>
  </div>

  {{-- ── PENGALAMAN PELATIHAN ─────────────────────────────────────────────────── --}}
  <div class="form-card">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide flex items-center gap-2">
        <i data-lucide="trending-up" class="w-4 h-4 text-blue-500"></i> Pengalaman Pelatihan
      </h3>
      <button type="button" onclick="addExpRow()" class="btn-success flex items-center gap-1.5 text-xs px-3 py-1.5">
        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah
      </button>
    </div>
    <div id="exp-list" class="space-y-4">
      @forelse($experiences as $exp)
        <div class="exp-row p-4 bg-gray-50 rounded-xl border border-gray-100">
          <div class="grid gap-3 sm:grid-cols-[160px_auto_48px] items-start mb-3">
            <div>
              <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Statistik</label>
              <input type="text" name="exp_stats[]"
                     value="{{ $exp->stat_label }}"
                     class="form-input text-sm w-full font-bold text-blue-600" placeholder="35+">
            </div>
            <div>
              <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Kategori</label>
              <input type="text" name="exp_categories[]"
                     value="{{ $exp->category }}"
                     class="form-input text-sm w-full" placeholder="Instansi Korporasi">
            </div>
            <div class="flex justify-end">
              <button type="button" class="btn-danger align-top mt-6 shrink-0" onclick="this.closest('.exp-row').remove()" aria-label="Hapus pengalaman">
                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
              </button>
            </div>
          </div>
          <div>
            <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Deskripsi</label>
            <textarea name="exp_descriptions[]" rows="3"
                      class="form-input text-sm w-full resize-none"
                      placeholder="Deskripsi singkat (opsional)...">{{ $exp->description }}</textarea>
          </div>
        </div>
      @empty
        {{-- default rows --}}
        @foreach([
          ['35+','Instansi Korporasi','PT. Mitaka (Indonesia & Jepang), PT. Chickin Indonesia, PT. Intan Giri Indonesia, dan lainnya.'],
          ['60+','Instansi Pemerintah','Kementerian PUPR (Jateng & Jatim), DPUPR Kab. Sragen, SEKDA Kab. Ngawi, Dinas PU Karanganyar, Disdukcapil Kab. Sukoharjo, dan lainnya.'],
          ['200+','Instansi Pendidikan','UIN Riau, Yayasan Al Abidin Surakarta, MAN 1 Surakarta, SMK Negeri 6 Surakarta, dan berbagai sekolah negeri/swasta serta jaringan sekolah IT di Indonesia.'],
        ] as [$stat,$cat,$desc])
          <div class="exp-row p-4 bg-gray-50 rounded-xl border border-gray-100">
            <div class="grid gap-3 sm:grid-cols-[160px_auto_48px] items-start mb-3">
              <div>
                <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Statistik</label>
                <input type="text" name="exp_stats[]" value="{{ $stat }}" class="form-input text-sm w-full font-bold text-blue-600" placeholder="35+">
              </div>
              <div>
                <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Kategori</label>
                <input type="text" name="exp_categories[]" value="{{ $cat }}" class="form-input text-sm w-full" placeholder="Kategori...">
              </div>
              <div class="flex justify-end">
                <button type="button" class="btn-danger align-top mt-6 shrink-0" onclick="this.closest('.exp-row').remove()" aria-label="Hapus pengalaman">
                  <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>
            <div>
              <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Deskripsi</label>
              <textarea name="exp_descriptions[]" rows="3" class="form-input text-sm w-full resize-none" placeholder="Deskripsi singkat (opsional)...">{{ $desc }}</textarea>
            </div>
          </div>
        @endforeach
      @endforelse
    </div>
  </div>

  {{-- Submit --}}
  <div class="flex items-center gap-4">
    <button type="submit" class="btn-primary flex items-center gap-2">
      <i data-lucide="save" class="w-4 h-4"></i> Simpan Semua Perubahan
    </button>
    @if(session('success'))
      <span class="text-green-600 text-sm font-medium flex items-center gap-1.5">
        <i data-lucide="check-circle" class="w-4 h-4"></i> {{ session('success') }}
      </span>
    @endif
  </div>
</form>
@endsection

@section('scripts')
<script>
  // ── Dynamic row templates ────────────────────────────────────────────────────

  function addCertRow() {
    const list = document.getElementById('cert-list');
    const div  = document.createElement('div');
    div.className = 'cert-row flex gap-2 items-start p-3 bg-gray-50 rounded-lg border border-gray-100';
    div.innerHTML  = `
      <div class="flex-1">
        <input type="text" name="cert_titles[]" class="form-input text-sm" placeholder="Nama sertifikasi...">
      </div>
      <button type="button" class="btn-danger mt-0.5 shrink-0" onclick="this.closest('.cert-row').remove()">
        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
      </button>`;
    list.appendChild(div);
    lucide.createIcons();
  }

  function addBizRow() {
    const list = document.getElementById('biz-list');
    const div  = document.createElement('div');
    div.className = 'biz-row flex gap-2 items-center p-3 bg-gray-50 rounded-lg border border-gray-100';
    div.innerHTML  = `
      <select name="biz_roles[]" class="form-input text-sm w-32 shrink-0">
        <option value="owner">Owner</option>
        <option value="founder">Founder</option>
      </select>
      <input type="text" name="biz_names[]" class="form-input text-sm flex-1" placeholder="Nama bisnis / lembaga...">
      <button type="button" class="btn-danger shrink-0" onclick="this.closest('.biz-row').remove()">
        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
      </button>`;
    list.appendChild(div);
    lucide.createIcons();
  }

  function addExpRow() {
    const list = document.getElementById('exp-list');
    const div  = document.createElement('div');
    div.className = 'exp-row p-4 bg-gray-50 rounded-xl border border-gray-100';
    div.innerHTML  = `
      <div class="grid gap-3 sm:grid-cols-[160px_auto_48px] items-start mb-3">
        <div>
          <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Statistik</label>
          <input type="text" name="exp_stats[]" class="form-input text-sm w-full font-bold text-blue-600" placeholder="35+">
        </div>
        <div>
          <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Kategori</label>
          <input type="text" name="exp_categories[]" class="form-input text-sm w-full" placeholder="Instansi Korporasi">
        </div>
        <div class="flex justify-end">
          <button type="button" class="btn-danger align-top mt-6 shrink-0" onclick="this.closest('.exp-row').remove()" aria-label="Hapus pengalaman">
            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
          </button>
        </div>
      </div>
      <div>
        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500">Deskripsi</label>
        <textarea name="exp_descriptions[]" rows="3" class="form-input text-sm w-full resize-none" placeholder="Deskripsi singkat (opsional)..."></textarea>
      </div>`;
    list.appendChild(div);
    lucide.createIcons();
  }

  // ── Photo preview ──────────────────────────────────────────────────────────
  document.getElementById('photo-input')?.addEventListener('change', function () {
    const label = document.getElementById('photo-filename');
    if (this.files.length > 0) {
      label.textContent = '✓ ' + this.files[0].name;
      label.classList.remove('hidden');
    }
  });
</script>
@endsection