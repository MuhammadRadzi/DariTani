<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DariTani.co.id')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">

    <div class="max-w-md mx-auto min-h-screen relative pb-20">

        {{-- Navbar --}}
        <div class="flex items-center gap-4 px-4 py-3">
            <img src="{{ asset('images/logo-daritani-green.png') }}" alt="DariTani" class="w-10 h-auto shrink-0">

            <div class="flex-1 flex items-center border border-[#1d1b20] rounded-lg px-3 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1d1b20]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
                <input type="text" placeholder="Cari produk atau kebun..." class="flex-1 ml-2 text-sm outline-none">
            </div>

            <button type="button" class="shrink-0" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- Konten halaman --}}
        <main class="px-4">
            @yield('content')
        </main>

        {{-- Bottom nav --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-[#f3f3f3] shadow-[0_-2px_6px_rgba(0,0,0,0.1)] flex items-center justify-around px-6 py-2">
            <a href="{{ route('user.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('user.index') ? 'text-[#56ec4b]' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px]">Beranda</span>
            </a>
            <a href="{{ route('keranjang.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('keranjang.*') ? 'text-[#56ec4b]' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="text-[9px]">Keranjang</span>
            </a>
            <a href="{{ route('markah.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('markah.*') ? 'text-[#56ec4b]' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <span class="text-[9px]">Markah Petani</span>
            </a>
        </div>
    </div>

</body>
</html>
