@extends('admin.layout')
@section('title', 'Blog & Berita')

@section('content')

{{-- Add Article Form --}}
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tulis Artikel Baru</h3>
  <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid gap-4">
      <div>
        <label>Judul Artikel</label>
        <input type="text" name="title" placeholder="Judul artikel yang menarik..." required>
      </div>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label>Kategori</label>
          <select name="category">
            <option>Workshop</option><option>Training</option><option>Pendidikan</option><option>Event</option><option>Lainnya</option>
          </select>
        </div>
        <div>
          <label>Status</label>
          <select name="status">
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
          </select>
        </div>
      </div>
      <div>
        <label>Ringkasan (Excerpt)</label>
        <textarea name="excerpt" style="min-height:70px;" placeholder="Ringkasan singkat artikel..."></textarea>
      </div>
      <div>
        <label>Thumbnail / Cover</label>
        <label class="upload-zone block cursor-pointer">
          <input type="file" name="thumbnail" accept="image/*" class="hidden">
          <i data-lucide="image" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
          <p class="text-sm text-gray-500">Klik untuk upload gambar cover</p>
          <p class="text-xs text-gray-400 mt-1">JPG, PNG · maks 3MB</p>
        </label>
      </div>
      <div>
        <label>Konten Artikel</label>
        <textarea name="content" style="min-height:160px;" placeholder="Tulis konten artikel di sini..."></textarea>
      </div>
    </div>
    <button type="submit" class="btn-primary mt-4"><i data-lucide="save" class="w-4 h-4"></i> Simpan Artikel</button>
  </form>
</div>

{{-- Article List --}}
<div class="form-card p-0 overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100">
    <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Semua Artikel ({{ $posts->count() }})</h3>
  </div>
  <table>
    <thead>
      <tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($posts as $post)
        <tr>
          <td>
            <div class="font-medium text-gray-800">{{ $post->title }}</div>
            <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $post->excerpt }}</div>
          </td>
          <td>
            <span class="badge {{ match($post->category) { 'Workshop' => 'badge-blue', 'Training' => 'badge-amber', 'Event' => 'badge-green', default => 'badge-gray' } }}">
              {{ $post->category }}
            </span>
          </td>
          <td class="text-gray-400 text-sm">{{ $post->created_at->format('d M Y') }}</td>
          <td>
            <span class="badge {{ $post->status === 'published' ? 'badge-green' : 'badge-red' }}">
              {{ $post->status === 'published' ? 'Publish' : 'Draft' }}
            </span>
          </td>
          <td>
            <div class="flex gap-2">
              <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" data-confirm="Hapus artikel ini?">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-gray-400 py-8">Belum ada artikel.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection