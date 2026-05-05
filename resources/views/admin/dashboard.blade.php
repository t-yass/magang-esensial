@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<p class="text-2xl font-heading font-bold text-[#072d52] mb-1">Selamat datang, {{ Auth::user()->name }} 👋</p>
<p class="text-gray-500 text-sm mb-6">Ringkasan konten website Esensial Training & Consulting</p>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="bg-white rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <span class="text-gray-500 text-sm">Program Aktif</span>
      <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center"><i data-lucide="book-open" class="w-4 h-4 text-blue-600"></i></div>
    </div>
    <div class="text-2xl font-bold text-[#072d52]">{{ $stats['programs'] }}</div>
    <div class="text-xs text-green-600 font-medium mt-1">Program terdaftar</div>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <span class="text-gray-500 text-sm">Artikel Blog</span>
      <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center"><i data-lucide="newspaper" class="w-4 h-4 text-amber-600"></i></div>
    </div>
    <div class="text-2xl font-bold text-[#072d52]">{{ $stats['posts'] }}</div>
    <div class="text-xs text-gray-400 font-medium mt-1">Draft: {{ $stats['drafts'] }}</div>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <span class="text-gray-500 text-sm">Mitra</span>
      <div class="w-9 h-9 rounded-lg bg-teal-50 flex items-center justify-center"><i data-lucide="building-2" class="w-4 h-4 text-teal-600"></i></div>
    </div>
    <div class="text-2xl font-bold text-[#072d52]">{{ $stats['partners'] }}</div>
    <div class="text-xs text-gray-400 font-medium mt-1">Instansi mitra</div>
  </div>
  <div class="bg-white rounded-2xl p-5 shadow-sm">
    <div class="flex items-center justify-between mb-3">
      <span class="text-gray-500 text-sm">Galeri Media</span>
      <div class="w-9 h-9 rounded-lg bg-pink-50 flex items-center justify-center"><i data-lucide="image" class="w-4 h-4 text-pink-600"></i></div>
    </div>
    <div class="text-2xl font-bold text-[#072d52]">{{ $stats['galleries'] }}</div>
    <div class="text-xs text-gray-400 font-medium mt-1">Foto & Video</div>
  </div>
</div>

<div class="form-card">
  <h3 class="font-heading font-bold text-base mb-4 text-[#072d52]">Aksi Cepat</h3>
  <div class="grid sm:grid-cols-4 gap-3">
    <a href="{{ route('admin.hero') }}" class="btn-primary"><i data-lucide="edit-3" class="w-4 h-4"></i> Edit Hero</a>
    <a href="{{ route('admin.blog') }}" class="btn-secondary"><i data-lucide="plus" class="w-4 h-4"></i> Artikel Baru</a>
    <a href="{{ route('admin.gallery') }}" class="btn-secondary"><i data-lucide="upload" class="w-4 h-4"></i> Upload Galeri</a>
    <a href="{{ route('admin.appearance') }}" class="btn-secondary"><i data-lucide="settings" class="w-4 h-4"></i> Atur Tampilan</a>
  </div>
</div>
@endsection