{{-- views/admin/video-content/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Video Training & Testimoni')

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
      <div>
        <label>Urutan</label>
        <input type="number" name="sort_order" value="0">
      </div>
    </div>
    <div class="mb-4">
      <label>Deskripsi (opsional)</label>
      <textarea name="description" rows="3" placeholder="Deskripsi pendek..."></textarea>
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
            <th>Urutan</th>
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
              <td>{{ $video->sort_order }}</td>
              <td class="text-right">
                <div class="flex justify-end gap-2">
                  <form method="POST" action="{{ route('admin.video-content.destroy', $video) }}" data-confirm="Hapus video ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
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
@endsection
