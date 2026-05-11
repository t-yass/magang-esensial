<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin – Esensial Training</title>
  <link rel="icon" type="image/png" href="{{ \App\Models\SiteSetting::faviconUrl() }}">
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'DM Sans', sans-serif; }
    .font-heading { font-family: 'Playfair Display', serif; }
    .input-with-icon { position: relative; }
    .input-with-icon input { padding-right: 3.75rem; }
    .password-toggle-btn {
      position: absolute;
      top: 50%;
      right: 0.85rem;
      transform: translateY(-50%);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 2.2rem;
      height: 2.2rem;
      background: rgba(15,23,42,0.04);
      border: 1px solid rgba(148,163,184,0.3);
      color: #475569;
      cursor: pointer;
      transition: color .2s ease, background .2s ease, transform .2s ease;
      border-radius: 9999px;
      padding: 0;
      line-height: 0;
    }
    .password-toggle-btn svg { width: 1.05rem; height: 1.05rem; }
    .password-toggle-btn:hover { color: #1e3a8a; background: rgba(15,23,42,0.08); transform: translateY(-50%) scale(1.02); }
    .password-toggle-btn:focus { outline: none; box-shadow: 0 0 0 3px rgba(4,89,154,.18); }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#051f3a] to-[#04599A] flex items-center justify-center p-4">

  <div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
      <img src="{{ \App\Models\SiteSetting::logoUrl() }}" alt="Logo" class="h-16 w-auto mx-auto rounded-xl mb-4 object-contain">
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
          <div class="input-with-icon">
            <input
              id="login-password"
              type="password"
              name="password"
              placeholder="••••••••"
              class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
              required
            >
            <button type="button" class="password-toggle-btn" onclick="togglePassword(event, 'login-password')" aria-label="Tampilkan password">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 icon-show">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 icon-hide hidden">
                <path d="M17.94 17.94C16.34 19.16 14.25 20 12 20c-7 0-11-8-11-8a21.2 21.2 0 0 1 4.12-5.79" />
                <path d="M1 1l22 22" />
                <path d="M9.88 9.88A3 3 0 0 0 14.12 14.12" />
                <path d="M14.12 9.88A3 3 0 0 0 9.88 14.12" />
              </svg>
            </button>
          </div>
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

  <script>
    function togglePassword(event, fieldId) {
      const input = document.getElementById(fieldId);
      if (!input) return;
      const button = event.currentTarget;
      const showIcon = button.querySelector('.icon-show');
      const hideIcon = button.querySelector('.icon-hide');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      showIcon?.classList.toggle('hidden', !isHidden);
      hideIcon?.classList.toggle('hidden', isHidden);
      button.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
    }
  </script>
</body>
</html>