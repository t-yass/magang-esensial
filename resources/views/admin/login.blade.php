<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin – Esensial Training</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .font-heading { font-family: 'Playfair Display', serif; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#051f3a] to-[#04599A] flex items-center justify-center p-4">

  <div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
      <img src="{{ asset('images/logo.JPEG') }}" alt="Logo" class="h-16 w-auto mx-auto rounded-xl mb-4 object-contain">
      <h1 class="font-heading text-2xl font-bold text-white">ESENSIAL TRAINING</h1>
      <p class="text-blue-200 text-sm tracking-widest mt-1">ADMIN PANEL</p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl p-8 shadow-2xl">
      <h2 class="text-xl font-semibold text-gray-800 mb-2">Selamat Datang 👋</h2>
      <p class="text-gray-500 text-sm mb-6">Masuk menggunakan akun admin Anda</p>

      @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3 mb-5">
          {{ session('error') }}
        </div>
      @endif

      @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg px-4 py-3 mb-5">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
        @csrf

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
          <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="admin@esensialtraining.com"
            class="w-full px-4 py-2.5 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror"
            required autofocus
          >
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
          <input
            type="password"
            name="password"
            placeholder="••••••••"
            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          >
        </div>

        <div class="flex items-center gap-2">
          <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-blue-600">
          <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
        </div>

        <button type="submit"
          class="w-full bg-[#04599A] hover:bg-[#034580] text-white font-semibold py-3 rounded-lg transition-colors text-sm">
          Masuk ke Dashboard
        </button>
      </form>
    </div>

    <p class="text-center text-blue-200/50 text-xs mt-6">© 2026 Esensial Training & Consulting</p>
  </div>

</body>
</html>