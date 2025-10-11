<!doctype html>
<html lang="id" style="margin: 0; padding: 0;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'HaloBun' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root { 
      --blue: #1e3a8a; 
      --yellow: #facc15; 
    }
    
    /* CSS Reset untuk menghilangkan default browser styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    html, body {
      margin: 0 !important;
      padding: 0 !important;
      height: 100%;
    }
    
    /* Terapkan font Plus Jakarta Sans ke seluruh body */
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    /* Pastikan header menempel ke atas */
    header {
      position: sticky;
      top: 0;
      z-index: 50;
    }
    
    /* Hapus semua spacing default */
    body > * {
      margin-top: 0 !important;
    }
    
    /* Override default browser styles */
    h1, h2, h3, h4, h5, h6 {
      margin-top: 0;
    }

    
    
    /* Full width hero section that breaks out of container */
    .hero-fullwidth {
      width: 100vw;
      margin-left: calc(-50vw + 50%);
      margin-right: calc(-50vw + 50%);
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;
    }
    
    /* Ensure navbar stays on top of hero */
    header {
      position: fixed;
      z-index: 100;
      top: 0;
      left: 0;
      right: 0;
    }
    
    /* Smooth scrolling for better UX */
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="bg-gray-50 text-slate-800 min-h-screen flex flex-col" style="margin: 0; padding: 0;">
  
  <header class="bg-white border-b fixed top-0 left-0 right-0 z-50" style="padding: 8px 0; margin: 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="max-w-7xl mx-auto px-4">
      <div class="bg-white py-2 px-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-2">
            <img src="{{ asset('images/AR.webp') }}" alt="HaloBun Logo" class="h-8 w-8">
            <a href="/" class="font-bold text-lg text-[var(--blue)]">HaloBun</a>
          </div>
        </div>

        <nav class="hidden md:flex items-center space-x-6 text-[var(--blue)] font-semibold">
          <a href="/pregnancy-tracker" class="hover:text-blue-600 transition-colors">Pregnancy Track</a>
          <a href="/articles" class="hover:text-blue-600 transition-colors">Artikel</a>
          <a href="/videos" class="hover:text-blue-600 transition-colors">Video</a>
          <a href="/threads" class="hover:text-blue-600 transition-colors">Forum Bunda</a>
          <a href="/facilities" class="hover:text-blue-600 transition-colors">Faskes</a>
        </nav>

        <div class="flex items-center gap-3">
          <div class="relative hidden lg:block">
            <input type="text" placeholder="Pencarian" class="py-1.5 pl-3 pr-8 rounded-full bg-blue-50 text-slate-800 focus:outline-none focus:ring-2 focus:ring-[var(--blue)] text-sm">
            <svg class="w-4 h-4 absolute right-2 top-1/2 -translate-y-1/2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.655l4.635 4.635a1 1 0 01-1.414 1.414l-4.635-4.635A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
          @auth
            {{-- User Profile Dropdown --}}
            <div class="relative group">
              <button class="flex items-center space-x-2 text-[var(--blue)] hover:text-blue-600 transition-colors">
                @if(auth()->user()->avatar)
                  <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                       alt="Avatar" 
                       class="w-8 h-8 rounded-full object-cover border-2 border-blue-100">
                @else
                  <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                  </div>
                @endif
                <span class="font-semibold text-sm hidden sm:block">Halo, {{ explode(' ', auth()->user()->name)[0] }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              {{-- Dropdown Menu --}}
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="p-3 border-b border-gray-100">
                  <div class="flex items-center space-x-3">
                    @if(auth()->user()->avatar)
                      <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                           alt="Avatar" 
                           class="w-10 h-10 rounded-full object-cover border-2 border-blue-100">
                    @else
                      <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                      </div>
                    @endif
                    <div>
                      <p class="font-semibold text-gray-900 text-sm">{{ auth()->user()->name }}</p>
                      <p class="text-gray-500 text-xs">{{ auth()->user()->email }}</p>
                    </div>
                  </div>
                </div>
                
                <div class="py-2">
                  <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile Saya
                  </a>
                  
                  @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors">
                      <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                      </svg>
                      Dashboard Admin
                    </a>
                  @endif
                  
                  <div class="border-t border-gray-100 my-2"></div>
                  
                  <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                      <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                      </svg>
                      Logout
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @else
            <a href="{{ route('login') }}" class="bg-white text-[var(--blue)] font-semibold px-3 py-1.5 rounded-full border border-gray-300 hover:bg-gray-100 transition-colors text-sm">Masuk</a>
            <a href="{{ route('register') }}" class="bg-[var(--blue)] text-white font-semibold px-3 py-1.5 rounded-full hover:bg-blue-600 transition-colors text-sm">Daftar</a>
          @endauth
        </div>
      </div>
    </div>
  </header>

  <main class="flex-1">
    @if(session('ok'))
      <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4 max-w-7xl mx-auto px-4" style="margin-top: 60px;">
        {{ session('ok') }}
      </div>
    @endif
    @yield('content')
  </main>

  <footer class="bg-gray-100 border-t border-gray-200 py-8 px-4 text-sm text-gray-600">
    <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-6 text-center md:text-left">
      <div>
        <h4 class="font-bold text-lg text-[var(--blue)] mb-2">HaloBun</h4>
        <p>Solusi dan panduan lengkap untuk perjalanan kehamilan dan pasca melahirkan.</p>
      </div>
      <div>
        <h4 class="font-bold text-lg text-[var(--blue)] mb-2">Navigasi</h4>
        <ul class="space-y-1">
          <li><a href="/pregnancy-tracker" class="hover:text-blue-600">Pregnancy Track</a></li>
          <li><a href="/articles" class="hover:text-blue-600">Artikel</a></li>
          <li><a href="/videos" class="hover:text-blue-600">Video</a></li>
          <li><a href="/threads" class="hover:text-blue-600">Forum Bunda</a></li>
          <li><a href="/facilities" class="hover:text-blue-600">Faskes</a></li>
          <li><a href="/faq" class="hover:text-blue-600">FAQ</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-lg text-[var(--blue)] mb-2">Kontak Kami</h4>
        <ul class="space-y-1">
          <li>Email: <a href="mailto:halo@halobun.id" class="hover:text-blue-600">halo@halobun.id</a></li>
          <li>Telepon: (021) 123-4567</li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-lg text-[var(--blue)] mb-2">Ikuti Kami</h4>
        <div class="flex justify-center md:justify-start space-x-3">
          <a href="#" class="hover:text-blue-600"><img src="{{ asset('images/1.png') }}" alt="Facebook" class="w-6 h-6"></a>
          <a href="#" class="hover:text-blue-600"><img src="{{ asset('images/2.png') }}" alt="Instagram" class="w-6 h-6"></a>
          <a href="#" class="hover:text-blue-600"><img src="{{ asset('images/3.png') }}" alt="Twitter" class="w-6 h-6"></a>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-300 mt-6 pt-6 text-center">
      © {{ date('Y') }} HaloBun. All Rights Reserved.
    </div>
  </footer>

   @stack('scripts')
   
</body>
</html>