{{-- views/admin/video-content/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Video')

@section('content')
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tambah Video Baru</h3>
  <form method="POST" action="{{ route('admin.video-content.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid sm:grid-cols-2 gap-4 mb-4">
      <div>
        <label>Section</label>
        <select name="section">
          <option value="training">Training</option>
          <option value="testimonial">Testimoni</option>
        </select>
      </div>
      <div>
        <label>Source</label>
        <select name="source_type">
          <option value="link">Link</option>
          <option value="upload">Upload Video</option>
        </select>
      </div>
    </div>
    <div class="grid sm:grid-cols-2 gap-4 mb-4">
      <div>
        <label>Judul</label>
        <input type="text" name="title" placeholder="Judul video (opsional)">
      </div>
    </div>
    <div class="mb-4">
      <label>Link Video (jika pilih link)</label>
      <input type="text" name="url" placeholder="https://www.instagram.com/...">
    </div>
    <div class="mb-4">
      <label>Upload Video (jika pilih upload)</label>
      <input type="file" name="file" accept="video/mp4,video/webm,video/ogg">
      <p class="text-xs text-gray-500 mt-2">Maks 50MB. Hanya video upload jika pilih 'Upload Video'.</p>
    </div>
    <div class="flex items-center gap-2 mb-4">
      <input type="checkbox" name="is_visible" id="is_visible" checked>
      <label for="is_visible" class="mb-0">Tampilkan</label>
    </div>
    <button type="submit" class="btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Tambah Video</button>
  </form>
</div>

<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Video Tersimpan</h3>
  @if($videos->isEmpty())
    <p class="text-center text-gray-400 py-8">Belum ada video tersimpan.</p>
  @else
    <div class="overflow-x-auto">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Section</th>
            <th>Source</th>
            <th>Judul</th>
            <th>Status</th>
            <th class="text-right">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($videos as $video)
            <tr>
              <td>{{ $video->id }}</td>
              <td class="text-sm text-gray-600 uppercase">{{ $video->section }}</td>
              <td class="text-sm text-gray-600 uppercase">{{ $video->source_type }}</td>
              <td>{{ $video->title ?: '-' }}</td>
              <td>
                <span class="badge {{ $video->is_visible ? 'badge-green' : 'badge-gray' }}">{{ $video->is_visible ? 'Tampil' : 'Tersembunyi' }}</span>
              </td>
              <td class="text-right">
                <div class="flex justify-end gap-2">
                  <button
                    type="button"
                    class="btn-success rounded-full p-2.5"
                    data-id="{{ $video->id }}"
                    data-section="{{ $video->section }}"
                    data-source-type="{{ $video->source_type }}"
                    data-title="{{ $video->title }}"
                    data-url="{{ $video->url }}"
                    data-is-visible="{{ $video->is_visible ? '1' : '0' }}"
                    onclick="openEditVideo(this)"
                    aria-label="Edit Video"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-emerald-800">
                      <path d="M12 20h9" />
                      <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L8.5 17.5 3 18l.5-5.5L16.5 3.5z" />
                    </svg>
                  </button>
                  <form method="POST" action="{{ route('admin.video-content.destroy', $video) }}" data-confirm="Hapus video ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

{{-- Edit Video Modal --}}
<div id="edit-video-modal" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center p-4">
  <div class="bg-white rounded-2xl p-6 w-full max-w-xl shadow-2xl">
    <h3 class="font-heading font-bold text-[#072d52] text-lg mb-4">Edit Video</h3>
    <form id="edit-video-form" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="grid sm:grid-cols-2 gap-4 mb-4">
        <div>
          <label>Section</label>
          <select name="section" id="edit-section">
            <option value="training">Training</option>
            <option value="testimonial">Testimoni</option>
          </select>
        </div>
        <div>
          <label>Source</label>
          <select name="source_type" id="edit-source_type">
            <option value="link">Link</option>
            <option value="upload">Upload Video</option>
          </select>
        </div>
      </div>
      <div class="grid sm:grid-cols-2 gap-4 mb-4">
        <div>
          <label>Judul</label>
          <input type="text" name="title" id="edit-title" placeholder="Judul video (opsional)">
        </div>
      </div>
      <div class="mb-4">
        <label>Link Video (jika pilih link)</label>
        <input type="text" name="url" id="edit-url" placeholder="https://www.instagram.com/...">
      </div>
      <div class="mb-4">
        <label>Upload Video (jika pilih upload)</label>
        <input type="file" name="file" id="edit-file" accept="video/mp4,video/webm,video/ogg">
        <p class="text-xs text-gray-500 mt-2">Maks 50MB. Hanya video upload jika pilih 'Upload Video'.</p>
      </div>
      <div class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="is_visible" id="edit-is_visible">
        <label for="edit-is_visible" class="mb-0">Tampilkan</label>
      </div>
      <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
        <button type="button" onclick="closeEditVideo()" class="btn-secondary">Batal</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function openEditVideo(button) {
    const form = document.getElementById('edit-video-form');
    const modal = document.getElementById('edit-video-modal');
    form.action = `{{ url('admin/video-content') }}/${button.dataset.id}`;
    document.getElementById('edit-section').value = button.dataset.section;
    document.getElementById('edit-source_type').value = button.dataset.sourceType;
    document.getElementById('edit-title').value = button.dataset.title || '';
    document.getElementById('edit-url').value = button.dataset.url || '';
    document.getElementById('edit-is_visible').checked = button.dataset.isVisible === '1';
    modal.classList.remove('hidden');
  }

  function closeEditVideo() {
    document.getElementById('edit-video-modal').classList.add('hidden');
  }
</script>
@endsection
