@extends('admin.layout')
@section('title', 'Kontak')

@section('content')
<form method="POST" action="{{ route('admin.contact.update') }}">
  @csrf
  <div class="form-card">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Informasi Kontak</h3>
    <div class="grid gap-4">
      <div>
        <label>Nomor WhatsApp (format: 62xxx tanpa +)</label>
        <input type="tel" name="contact_whatsapp" value="{{ old('contact_whatsapp', $s['contact_whatsapp'] ?? '') }}">
      </div>
      <div>
        <label>Instagram (username tanpa @)</label>
        <input type="text" name="contact_instagram" value="{{ old('contact_instagram', $s['contact_instagram'] ?? '') }}">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="contact_email" value="{{ old('contact_email', $s['contact_email'] ?? '') }}">
      </div>
      <div>
        <label>Alamat Lengkap</label>
        <textarea name="contact_address">{{ old('contact_address', $s['contact_address'] ?? '') }}</textarea>
      </div>
    </div>
    <button type="submit" class="btn-primary mt-5"><i data-lucide="save" class="w-4 h-4"></i> Simpan</button>
  </div>
</form>
@endsection