{{-- views/admin/gallery/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Galeri')

@section('content')
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Upload Media Baru</h3>
  <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    
    <label class="upload-zone block cursor-pointer mb-4" id="upload-zone-label">
      <input type="file" name="file" accept="image/*,video/mp4" class="hidden" id="file-input" required>
      <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-400 mx-auto mb-2"></i>
      <p class="text-sm text-gray-500 font-medium">Drag & drop atau klik untuk memilih file</p>
      <p class="text-xs text-gray-400 mt-1">JPG, PNG, MP4 · maks 20MB</p>
    </label>
    <div class="grid sm:grid-cols-2 gap-4">
      <div class="sm:col-span-2">
        <label>Keterangan (opsional)</label>
        <input type="text" name="title" placeholder="Keterangan foto/video...">
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
    <div id="gallery-container" class="flex flex-wrap gap-4 justify-center items-start mx-auto px-4 max-h-96 overflow-y-auto pb-2 bg-gray-50 rounded-lg p-6 border border-dashed border-gray-300">
      @foreach($items as $item)
        <div class="relative group flex-shrink-0" style="width: 120px; height: 120px;">
          @if($item->type === 'image')
            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}"
              class="w-full h-full object-cover rounded-lg border border-gray-200">
          @else
            <div class="w-full h-full bg-gray-800 rounded-lg border border-gray-200 flex items-center justify-center">
              <i data-lucide="video" class="w-8 h-8 text-white/60"></i>
            </div>
          @endif
          <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" data-confirm="Hapus media ini?">
              @csrf @method('DELETE')
              <button type="submit" class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center hover:bg-red-600 transition">
                <i data-lucide="trash-2" class="w-3.5 h-3.5 text-white"></i>
              </button>
            </form>
          </div>
          <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-xs px-2 py-1 rounded-b-lg truncate opacity-0 group-hover:opacity-100 transition-opacity">
            {{ $item->title ?: 'Media' }}
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

<script>
  const fileInput = document.getElementById('file-input');
  const uploadZoneLabel = document.getElementById('upload-zone-label');

  // Handle file selection
  fileInput.addEventListener('change', function() {
    handleFileSelect();
  });

  // Handle drag & drop
  uploadZoneLabel.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadZoneLabel.classList.add('border-blue-500', 'bg-blue-50');
  });

  uploadZoneLabel.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadZoneLabel.classList.remove('border-blue-500', 'bg-blue-50');
  });

  uploadZoneLabel.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadZoneLabel.classList.remove('border-blue-500', 'bg-blue-50');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      fileInput.files = files;
      handleFileSelect();
    }
  });

  function handleFileSelect() {
    const file = fileInput.files[0];
    if (!file) return;

    // Check file size (max 20MB)
    if (file.size > 20 * 1024 * 1024) {
      alert('File terlalu besar. Ukuran maksimal 20MB.');
      fileInput.value = '';
      return;
    }
  }

  function clearPreview() {
    fileInput.value = '';
  }
</script>
@endsection