<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DariTani.co.id')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
</head>
<body class="font-sans antialiased bg-white"
      x-data="{
          toasts: [],
          showToast(message, link = null, linkText = 'Lihat') {
              const id = Date.now() + Math.random();
              this.toasts.push({ id, message, link, linkText, visible: false });
              // beri jeda 1 tick supaya Alpine sempat render state awal
              // (visible: false) sebelum di-set true, sehingga transisi
              // enter benar-benar terpicu.
              this.$nextTick(() => {
                  const t = this.toasts.find(t => t.id === id);
                  if (t) t.visible = true;
              });
              setTimeout(() => {
                  const t = this.toasts.find(t => t.id === id);
                  if (t) t.visible = false;
                  setTimeout(() => {
                      this.toasts = this.toasts.filter(t => t.id !== id);
                  }, 200);
              }, 2500);
          },
      }"
      @toast.window="showToast($event.detail.message, $event.detail.link, $event.detail.linkText)"
>

    {{-- Toast notification, global untuk semua halaman -- card putih + link "Lihat", sesuai desain Figma --}}
    <div class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 flex flex-col-reverse gap-2 w-full max-w-sm px-4 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-show="toast.visible"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                class="bg-white text-black text-sm rounded-xl shadow-lg px-4 py-3 flex items-center justify-between gap-3 pointer-events-auto"
            >
                <span x-text="toast.message"></span>
                <a
                    x-show="toast.link"
                    :href="toast.link"
                    x-text="toast.linkText"
                    class="text-brand-300 font-medium underline shrink-0"
                ></a>
            </div>
        </template>
    </div>

    <div class="max-w-md mx-auto min-h-screen relative pb-20">

        {{-- Navbar --}}
        <div class="sticky top-0 z-10 bg-white flex items-center gap-4 px-4 py-3">
            <x-logo class="w-10 h-auto shrink-0 text-brand-500" />

            <div class="flex-1 flex items-center border border-[#1d1b20] rounded-lg px-3 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#1d1b20]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
                <input type="text" placeholder="Cari produk atau kebun..." class="flex-1 ml-2 text-sm outline-none">
            </div>

            <div class="relative shrink-0" x-data="{ open: false, confirmLogout: false }">
                <button type="button" @click.stop="open = !open" aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 top-full mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 py-1"
                    style="display: none; z-index: 9999;"
                >
                    <a href="{{ route('user.edit') }}" class="block px-4 py-2 text-sm text-black hover:bg-gray-50">
                        Edit Profil
                    </a>
                    <button
                        type="button"
                        @click="open = false; confirmLogout = true"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50"
                    >
                        Keluar
                    </button>
                </div>

                {{-- Dialog konfirmasi logout --}}
                <div
                    x-show="confirmLogout"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6"
                    style="display: none;"
                >
                    <div
                        @click.outside="confirmLogout = false"
                        class="w-full max-w-xs bg-white rounded-2xl shadow-lg p-5 text-center"
                    >
                        <p class="text-sm font-semibold text-black mb-1">Yakin mau keluar?</p>
                        <p class="text-xs text-gray-500 mb-4">Kamu perlu login lagi untuk melanjutkan belanja.</p>
                        <div class="flex gap-2">
                            <button
                                type="button"
                                @click="confirmLogout = false"
                                class="flex-1 py-2 text-sm font-medium rounded-xl border border-gray-200 text-black"
                            >
                                Batal
                            </button>
                            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full py-2 text-sm font-medium rounded-xl bg-red-600 text-white">
                                    Ya, Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten halaman --}}
        <main class="px-4">
            @yield('content')
        </main>

        {{-- Bottom nav --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-[#f3f3f3] shadow-[0_-2px_6px_rgba(0,0,0,0.1)] flex items-center justify-around px-6 py-2">
            <a href="{{ route('user.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('user.index') ? 'text-brand-200' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-[9px]">Beranda</span>
            </a>
            <a href="{{ route('keranjang.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('keranjang.*') ? 'text-brand-200' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="text-[9px]">Keranjang</span>
            </a>
            <a href="{{ route('markah.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('markah.*') ? 'text-brand-200' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <span class="text-[9px]">Markah Petani</span>
            </a>
        </div>
    </div>

</body>
</html>
