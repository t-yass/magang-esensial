@extends('admin.layout')
@section('title', 'Blog & Berita')

@section('content')

{{-- Add Article Form --}}
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tulis Artikel Baru</h3>
  <form id="blog-form" method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" id="blog-form-method" value="POST">
    <div class="grid gap-4">
      <div>
        <label>Judul Artikel</label>
        <input id="blog-title" type="text" name="title" placeholder="Judul artikel yang menarik..." required>
      </div>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label>Kategori</label>
          <input id="blog-category" list="blog-categories" type="text" name="category" placeholder="Workshop, Training, Event..." required>
          <datalist id="blog-categories">
            <option value="Workshop">
            <option value="Training">
            <option value="Pendidikan">
            <option value="Event">
            <option value="Lainnya">
          </datalist>
        </div>
        <div>
          <label>Tanggal</label>
          <input id="blog-event-date" type="date" name="event_date">
        </div>
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
        <textarea id="blog-content" name="content" style="min-height:160px;" placeholder="Tulis konten artikel di sini..."></textarea>
      </div>
    </div>
    <div class="flex flex-wrap gap-3 mt-4">
      <button type="submit" id="blog-submit-btn" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan Artikel</button>
      <button type="button" id="blog-cancel-btn" class="btn-secondary" style="display:none;">Batalkan Edit</button>
    </div>
  </form>
</div>

{{-- Article List --}}
<div class="form-card p-0 overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100">
    <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Semua Artikel ({{ $posts->count() }})</h3>
  </div>
  <table>
    <thead>
      <tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($posts as $post)
        <tr>
          <td>
            <div class="font-medium text-gray-800">{{ $post->title }}</div>
            <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ strip_tags(Str::limit($post->content, 80)) }}</div>
          </td>
          <td>
            <span class="badge {{ match($post->category) { 'Workshop' => 'badge-blue', 'Training' => 'badge-amber', 'Event' => 'badge-green', default => 'badge-gray' } }}">
              {{ $post->category }}
            </span>
          </td>
          <td class="text-gray-400 text-sm">{{ $post->display_date ?? $post->created_at->format('d M Y') }}</td>
          <td>
            <div class="flex flex-wrap gap-2">
              <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn-secondary" style="padding:7px 10px;font-size:13px;">Lihat</a>
              <button type="button" class="btn-success rounded-full p-2.5 edit-article-btn" data-id="{{ $post->id }}"
                data-title="{{ e($post->title) }}"
                data-category="{{ e($post->category) }}"
                data-event-date="{{ $post->event_date?->format('Y-m-d') }}"
                data-content="{{ e($post->content) }}"
                aria-label="Edit Artikel"
              >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-emerald-800">
                  <path d="M12 20h9" />
                  <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L8.5 17.5 3 18l.5-5.5L16.5 3.5z" />
                </svg>
              </button>
              <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" data-confirm="Hapus artikel ini?">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center text-gray-400 py-8">Belum ada artikel.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-article-btn');
    const blogForm = document.getElementById('blog-form');
    const methodInput = document.getElementById('blog-form-method');
    const titleInput = document.getElementById('blog-title');
    const categoryInput = document.getElementById('blog-category');
    const eventDateInput = document.getElementById('blog-event-date');
    const contentInput = document.getElementById('blog-content');
    const submitBtn = document.getElementById('blog-submit-btn');
    const cancelBtn = document.getElementById('blog-cancel-btn');
    const originalAction = blogForm.action;

    editButtons.forEach(button => {
      button.addEventListener('click', function () {
        const postId = this.dataset.id;
        titleInput.value = this.dataset.title;
        categoryInput.value = this.dataset.category;
        eventDateInput.value = this.dataset.eventDate || '';
        contentInput.value = this.dataset.content || '';

        methodInput.value = 'PUT';
        blogForm.action = originalAction.replace(/\/blog$/, `/blog/${postId}`);
        submitBtn.innerHTML = '<i data-lucide="save" class="w-4 h-4"></i> Perbarui Artikel';
        cancelBtn.style.display = 'inline-flex';
        cancelBtn.focus();
        lucide.createIcons();
      });
    });

    cancelBtn.addEventListener('click', function () {
      blogForm.reset();
      methodInput.value = 'POST';
      blogForm.action = originalAction;
      submitBtn.innerHTML = '<i data-lucide="save" class="w-4 h-4"></i> Simpan Artikel';
      cancelBtn.style.display = 'none';
      titleInput.focus();
      lucide.createIcons();
    });
  });
</script>
@endsection