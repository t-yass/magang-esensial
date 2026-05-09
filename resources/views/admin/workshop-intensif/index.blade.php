{{-- views/admin/workshop-intensif/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Workshop Intensif')

@section('content')
<!-- Edit Workshop Info -->
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Informasi Workshop</h3>
  <form method="POST" action="{{ route('admin.workshop-intensif.update', $workshop) }}">
    @csrf @method('PUT')
    <div class="mb-4">
      <label>Deskripsi</label>
      <textarea name="description" rows="4" placeholder="Deskripsi workshop...">{{ $workshop->description }}</textarea>
    </div>
    <div class="mb-4">
      <label>Tagline (pisahkan dengan koma)</label>
      <input type="text" name="taglines" value="{{ implode(', ', $workshop->taglines ?? []) }}" placeholder="Pelayanan Prima, Citra Positif, Kompetitif, Profesional">
      <p class="text-xs text-gray-500 mt-1">Masukkan tagline dipisah dengan koma</p>
    </div>
    <div class="flex items-center gap-2 mb-4">
      <input type="checkbox" name="is_visible" id="is_visible" {{ $workshop->is_visible ? 'checked' : '' }}>
      <label for="is_visible" class="mb-0">Tampilkan di halaman utama</label>
    </div>
    <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
  </form>
</div>

<!-- Upload Photo -->
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Upload Foto Kegiatan</h3>
  <form method="POST" action="{{ route('admin.workshop-intensif.photo.upload', $workshop) }}" enctype="multipart/form-data">
    @csrf
    <label class="upload-zone block cursor-pointer mb-4">
      <input type="file" name="file" accept="image/*" class="hidden" required>
      <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
      <p class="text-sm text-gray-500 font-medium">Drag & drop atau klik untuk memilih foto</p>
      <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP · maks 5MB</p>
    </label>
    <div>
      <label>Teks Alt (opsional)</label>
      <input type="text" name="alt_text" placeholder="Deskripsi foto...">
    </div>
    <button type="submit" class="btn-primary mt-4"><i data-lucide="upload" class="w-4 h-4"></i> Upload Foto</button>
    <p class="text-xs text-gray-500 mt-2">Foto baru akan otomatis aktif. Jika sudah ada 4 foto aktif, foto terlama akan disembunyikan.</p>
  </form>
</div>

<!-- Manage Photos -->
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Foto Kegiatan ({{ $photos->where('is_visible', true)->count() }}/4 ditampilkan)</h3>
  <p class="text-sm text-gray-600 mb-4">Upload foto kegiatan workshop. Hanya 4 foto terbaru yang aktif akan ditampilkan di halaman utama.</p>
  @if($photos->isEmpty())
    <p class="text-center text-gray-400 py-8">Belum ada foto diupload. Mulai upload foto kegiatan workshop.</p>
  @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
      @foreach($photos as $photo)
        <div class="relative group">
          <div class="aspect-square rounded-lg border border-gray-200 overflow-hidden bg-gray-100 {{ $photo->is_visible ? 'ring-2 ring-blue-500' : '' }}">
            <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->alt_text }}"
              class="w-full h-full object-cover {{ !$photo->is_visible ? 'opacity-50' : '' }}">
            @if(!$photo->is_visible)
              <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                <span class="text-white text-xs font-semibold">Tersembunyi</span>
              </div>
            @else
              <div class="absolute top-2 right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                <i data-lucide="eye" class="w-3 h-3 text-white"></i>
              </div>
            @endif
          </div>
          <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
            <form method="POST" action="{{ route('admin.workshop-intensif.photo.toggle', $photo) }}" style="display:inline;">
              @csrf @method('PATCH')
              <button type="submit" class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center" title="{{ $photo->is_visible ? 'Sembunyikan' : 'Tampilkan' }}">
                <i data-lucide="{{ $photo->is_visible ? 'eye-off' : 'eye' }}" class="w-3.5 h-3.5 text-white"></i>
              </button>
            </form>
            <form method="POST" action="{{ route('admin.workshop-intensif.photo.delete', $photo) }}" data-confirm="Hapus foto ini?" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                <i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i>
              </button>
            </form>
          </div>
          <p class="text-xs text-gray-400 mt-1 truncate">{{ $photo->alt_text ?: 'Foto '.$photo->id }}</p>
        </div>
      @endforeach
    </div>
  @endif
</div>

<style>
  .upload-zone {
    border: 2px dashed #e5e7eb;
    border-radius: 0.5rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s;
  }
  .upload-zone:hover {
    border-color: #3b82f6;
    background-color: #eff6ff;
  }
  .upload-zone input:focus + i {
    color: #3b82f6;
  }
</style>
@endsection
