@extends('admin.layout')
@section('title', 'Program Pelatihan')

@section('content')
{{-- Add Form --}}
<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tambah Program Baru</h3>
  <form method="POST" action="{{ route('admin.programs.store') }}">
    @csrf
    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label>Nama Program</label>
        <input type="text" name="name" placeholder="Nama program pelatihan" required>
      </div>
      <div>
        <label>Icon (Lucide name)</label>
        <input type="text" name="icon" placeholder="book-open, monitor, star …" required>
      </div>
      <div class="sm:col-span-2">
        <label>Deskripsi</label>
        <textarea name="description" style="min-height:70px;" placeholder="Deskripsi singkat program…"></textarea>
      </div>
      <div class="flex items-end gap-3 sm:col-span-2">
        <button type="submit" class="btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Tambah Program</button>
      </div>
    </div>
  </form>
</div>

{{-- List --}}
<div class="form-card p-0 overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100">
    <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Daftar Program ({{ $programs->count() }})</h3>
  </div>
  <table>
    <thead>
      <tr><th>No</th><th>Nama Program</th><th>Icon</th><th>Deskripsi</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($programs as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td class="font-medium text-gray-800">{{ $p->name }}</td>
          <td><span class="badge badge-blue">{{ $p->icon }}</span></td>
          <td class="text-gray-500 max-w-xs truncate">{{ $p->description }}</td>
          <td>
            <div class="flex gap-2">
              {{-- Edit modal trigger --}}
              <button 
                class="btn-success"
                data-id="{{ $p->id }}"
                data-name="{{ $p->name }}"
                data-icon="{{ $p->icon }}"
                data-description="{{ $p->description }}"
                onclick="openEditFromButton(this)"
              >
                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
              </button>
              {{-- Delete --}}
              <form method="POST" action="{{ route('admin.programs.destroy', $p) }}" data-confirm="Hapus program ini?">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-gray-400 py-8">Belum ada program.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Edit Modal --}}
<div id="edit-modal" class="fixed inset-0 bg-black/40 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
    <h3 class="font-heading font-bold text-[#072d52] text-lg mb-4">Edit Program</h3>
    <form id="edit-form" method="POST">
      @csrf @method('PUT')
      <div class="grid gap-4">
        <div>
          <label>Nama Program</label>
          <input type="text" name="name" id="edit-name" required>
        </div>
        <div>
          <label>Icon</label>
          <input type="text" name="icon" id="edit-icon" required>
        </div>
        <div>
          <label>Deskripsi</label>
          <textarea name="description" id="edit-desc" style="min-height:70px;"></textarea>
        </div>
      </div>
      <div class="flex gap-3 mt-5">
        <button type="submit" class="btn-primary"><i data-lucide="save" class="w-4 h-4"></i> Simpan</button>
        <button type="button" onclick="closeEdit()" class="btn-secondary">Batal</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  const baseUrl = "{{ url('admin/programs') }}";
  function openEdit(id, name, icon, desc) {
    document.getElementById('edit-form').action = baseUrl + '/' + id;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-icon').value = icon;
    document.getElementById('edit-desc').value = desc;
    document.getElementById('edit-modal').classList.remove('hidden');
  }
  function closeEdit() {
    document.getElementById('edit-modal').classList.add('hidden');
  }
  function openEditFromButton(btn){
    let id = btn.dataset.id;
    let name = btn.dataset.name;
    let icon = btn.dataset.icon;
    let desc = btn.dataset.description;
    openEdit(id, name, icon, desc);
  }
</script>
@endsection