{{-- views/admin/gallery/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Galeri')

@section('content')
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Upload Media Baru</h3>
  <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    <label class="upload-zone block cursor-pointer mb-4">
      <input type="file" name="file" accept="image/*,video/mp4" class="hidden" required>
      <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
      <p class="text-sm text-gray-500 font-medium">Drag & drop atau klik untuk memilih file</p>
      <p class="text-xs text-gray-400 mt-1">JPG, PNG, MP4 · maks 20MB</p>
    </label>
    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label>Keterangan (opsional)</label>
        <input type="text" name="title" placeholder="Keterangan foto/video...">
      </div>
      <div>
        <label>Kategori</label>
        <select name="category">
          <option>Workshop</option><option>Training Korporasi</option><option>Training Pemerintah</option><option>Pendidikan</option><option>Event</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn-primary mt-4"><i data-lucide="upload" class="w-4 h-4"></i> Upload</button>
  </form>
</div>

<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Media Tersimpan ({{ $items->count() }})</h3>
  @if($items->isEmpty())
    <p class="text-center text-gray-400 py-8">Belum ada media diupload.</p>
  @else
    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
      @foreach($items as $item)
        <div class="relative group">
          @if($item->type === 'image')
            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}"
              class="aspect-square object-cover rounded-lg border border-gray-200 w-full">
          @else
            <div class="aspect-square bg-gray-800 rounded-lg flex items-center justify-center">
              <i data-lucide="video" class="w-8 h-8 text-white/60"></i>
            </div>
          @endif
          <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" onsubmit="return confirm('Hapus media ini?')">
              @csrf @method('DELETE')
              <button type="submit" class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                <i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i>
              </button>
            </form>
          </div>
          <p class="text-xs text-gray-400 mt-1 truncate">{{ $item->title ?: $item->category }}</p>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection