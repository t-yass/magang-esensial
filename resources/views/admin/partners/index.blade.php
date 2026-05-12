@extends('admin.layout')
@section('title', 'Mitra / Partner')

@section('content')

<div class="form-card">
  <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Tambah Mitra Baru</h3>
  <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label>Nama Instansi</label>
        <input type="text" name="name" placeholder="Nama instansi mitra" required>
      </div>
      <div>
        <label>Website (opsional)</label>
        <input type="url" name="website" placeholder="https://...">
      </div>
      <div>
        <label>Logo</label>
        <input type="file" name="logo" accept="image/*">
      </div>
    </div>
    <button type="submit" class="btn-primary mt-4"><i data-lucide="plus" class="w-4 h-4"></i> Tambah Mitra</button>
  </form>
</div>

<div class="form-card p-0 overflow-hidden">
  <div class="px-6 py-4 border-b border-gray-100">
    <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wide">Daftar Mitra ({{ $partners->count() }})</h3>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full">
      <thead>
        <tr><th>No</th><th>Logo</th><th>Nama Instansi</th><th>Website</th><th>Tampilkan</th><th>Aksi</th></tr>
      </thead>
      <tbody>
      @forelse($partners as $p)
        <tr>
          <td>{{ $p->sort_order }}</td>
          <td>
            @if($p->logo_path)
              <img src="{{ asset('storage/'.$p->logo_path) }}" class="h-10 w-16 object-contain rounded border border-gray-200">
            @else
              <div class="w-16 h-10 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">Logo</div>
            @endif
          </td>
          <td class="font-medium">{{ $p->name }}</td>
          <td class="text-gray-400 text-sm">{{ $p->website ?: '–' }}</td>
          <td>
            <form method="POST" action="{{ route('admin.partners.toggle', $p) }}">
              @csrf @method('PATCH')
              <label class="toggle cursor-pointer">
                <input type="checkbox" {{ $p->is_visible ? 'checked' : '' }} onchange="this.form.submit()">
                <span class="toggle-slider"></span>
              </label>
            </form>
          </td>
          <td>
            <form method="POST" action="{{ route('admin.partners.destroy', $p) }}" data-confirm="Hapus mitra ini?">
              @csrf @method('DELETE')
              <button type="submit" class="btn-danger"><i data-lucide="trash-2" class="w-3.5 h-3.5"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-gray-400 py-8">Belum ada mitra.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection