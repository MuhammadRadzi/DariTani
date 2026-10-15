<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Petani - DariTani.co.id')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white"
      x-data="{
          toasts: [],
          showToast(message, link = null, linkText = 'Lihat') {
              const id = Date.now() + Math.random();
              this.toasts.push({ id, message, link, linkText, visible: false });
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

    {{-- Toast notification --}}
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
                <a x-show="toast.link" :href="toast.link" x-text="toast.linkText"
                   class="text-brand-300 font-medium underline shrink-0"></a>
            </div>
        </template>
    </div>

    <div class="max-w-md mx-auto min-h-screen relative pb-20">

        {{-- Navbar --}}
        <div class="sticky top-0 z-10 bg-white flex items-center justify-between gap-4 px-4 py-3">
            <x-logo variant="full" class="h-8 w-auto text-brand-500" />

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
                    <div @click.outside="confirmLogout = false" class="w-full max-w-xs bg-white rounded-2xl shadow-lg p-5 text-center">
                        <p class="text-sm font-semibold text-black mb-1">Yakin mau keluar?</p>
                        <p class="text-xs text-gray-500 mb-4">Kamu perlu login lagi untuk membuka dashboard.</p>
                        <div class="flex gap-2">
                            <button type="button" @click="confirmLogout = false"
                                    class="flex-1 py-2 text-sm font-medium rounded-xl border border-gray-200 text-black">
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

        {{-- Bottom nav petani --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-[#f3f3f3] shadow-[0_-2px_6px_rgba(0,0,0,0.1)] flex items-center justify-around px-6 py-2">
            <a href="{{ route('kebun-saya.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('kebun-saya.*') ? 'text-brand-200' : 'text-[#595959]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 20h10" />
                    <path d="M10 20c5.5-2.5.8-6.4 3-10" />
                    <path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z" />
                    <path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z" />
                </svg>
                <span class="text-[9px]">Kebun saya</span>
            </a>

            {{-- Tampil otomatis begitu route pesanan-masuk.index dibuat --}}
            @if (Route::has('pesanan-masuk.index'))
                <a href="{{ route('pesanan-masuk.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('pesanan-masuk.*') ? 'text-brand-200' : 'text-[#595959]' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                        <path d="M12 11h4" />
                        <path d="M12 16h4" />
                        <path d="M8 11h.01" />
                        <path d="M8 16h.01" />
                    </svg>
                    <span class="text-[9px]">Pesanan masuk</span>
                </a>
            @endif
        </div>
    </div>

</body>
</html>