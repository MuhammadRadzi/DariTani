@extends('layouts.app')

@section('title', 'Beranda - DariTani.co.id')

@section('content')

    {{-- Banner Selamat Datang --}}
    <div class="relative h-[171px] rounded-lg overflow-hidden mb-4"
         style="background: radial-gradient(circle at 50% 50%, #A2ED40, #8AC936, #6EA12B);">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
            <p class="font-bold text-2xl" style="text-shadow: -1px 3px 0 rgba(0,0,0,0.25);">Selamat Datang</p>
            <p class="text-sm mt-1" style="text-shadow: -1px 2px 0 rgba(0,0,0,0.25);">
                Di <span class="font-semibold">DariTani</span>
            </p>
        </div>
    </div>

    {{-- Kategori produk --}}
    <div class="grid grid-cols-4 gap-3 mb-5">
        {{-- Semua --}}
        <a href="{{ route('user.index', $q ? ['q' => $q] : []) }}"
           class="flex flex-col items-center gap-2">
            <div class="w-14 h-14 rounded-full flex items-center justify-center {{ !$kategori ? 'ring-2 ring-offset-2 ring-brand-500' : '' }}"
                 style="background: linear-gradient(228deg, #8AC936 5%, #A2ED40 165%);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </div>
            <span class="text-[10px] text-center leading-tight {{ !$kategori ? 'font-semibold text-brand-600' : 'text-[#343434]' }}">Semua</span>
        </a>

        @foreach ($categories as $category)
            @php $isActive = (string) $kategori === (string) $category->id_category; @endphp
            <a href="{{ route('user.index', array_filter(['q' => $q, 'kategori' => $isActive ? '' : $category->id_category])) }}"
               class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-full flex items-center justify-center {{ $isActive ? 'ring-2 ring-offset-2 ring-brand-500' : '' }}"
                     style="background: linear-gradient(228deg, #8AC936 5%, #A2ED40 165%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                    </svg>
                </div>
                <span class="text-[10px] text-center leading-tight {{ $isActive ? 'font-semibold text-brand-600' : 'text-[#343434]' }}">{{ $category->name_category }}</span>
            </a>
        @endforeach
    </div>

    {{-- Judul & info filter aktif --}}
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-xl font-medium text-black">Produk DariTani</h2>
        @if ($q || $kategori)
            <a href="{{ route('user.index') }}" class="text-xs text-brand-600 underline">Reset filter</a>
        @endif
    </div>

    @if ($q || $kategori)
        <p class="text-xs text-gray-500 mb-3">
            @if ($q)Mencari: <span class="font-medium text-black">"{{ $q }}"</span>@endif
            @if ($q && $kategori) · @endif
            @if ($kategori)Kategori: <span class="font-medium text-black">{{ $categories->firstWhere('id_category', $kategori)?->name_category ?? $kategori }}</span>@endif
        </p>
    @endif

    {{-- List kebun --}}
    <div class="flex flex-col gap-4 pb-4">
        @forelse ($farms as $farm)
            @php $isBookmarked = in_array($farm->id_farm, $bookmarkedFarmIds); @endphp
            <div class="relative block h-[220px] rounded-lg overflow-hidden shadow-md">
                <a href="{{ route('kebun.show', $farm) }}" class="absolute inset-0">
                    {{-- Placeholder gambar kebun --}}
                    @if ($farm->photo_farm)
                        <img src="{{ asset('storage/' . $farm->photo_farm) }}" alt="{{ $farm->name_farm }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-green-200 to-green-400"></div>
                    @endif

                    {{-- Overlay gradasi gelap di bawah --}}
                    <div class="absolute inset-x-0 bottom-0 h-3/5 bg-gradient-to-t from-black/80 to-transparent"></div>
                </a>

                {{-- Tombol bookmark, toggle tanpa reload + animasi --}}
                <div
                    x-data="{
                        bookmarked: {{ $isBookmarked ? 'true' : 'false' }},
                        loading: false,
                        pop: false,
                        async toggle() {
                            if (this.loading) return;
                            this.loading = true;

                            // trigger animasi pop setiap kali diklik
                            this.pop = false;
                            requestAnimationFrame(() => { this.pop = true; });
                            setTimeout(() => { this.pop = false; }, 300);

                            const url = this.bookmarked
                                ? '{{ route('markah.destroy', $farm) }}'
                                : '{{ route('markah.store', $farm) }}';
                            try {
                                const res = await fetch(url, {
                                    method: this.bookmarked ? 'DELETE' : 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                });
                                if (!res.ok) {
                                    $dispatch('toast', { message: await pesanGagal(res, 'Gagal memperbarui markah') });
                                    return;
                                }
                                this.bookmarked = !this.bookmarked;
                                if (this.bookmarked) {
                                    $dispatch('toast', {
                                        message: 'Telah ditambahkan di markah.',
                                        link: '{{ route('markah.index') }}',
                                        linkText: 'Lihat',
                                    });
                                } else {
                                    $dispatch('toast', { message: 'Dihapus dari markah.' });
                                }
                            } catch (e) {
                                $dispatch('toast', { message: 'Gagal memperbarui markah' });
                            } finally {
                                this.loading = false;
                            }
                        },
                    }"
                    class="absolute top-3 right-3"
                >
                    <button
                        type="button"
                        @click="toggle()"
                        :class="[loading ? 'opacity-50' : '', pop ? 'scale-125' : 'scale-100']"
                        class="bg-brand-200 rounded-full p-2 transition-transform duration-200 ease-out"
                        aria-label="Toggle markah"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white transition-transform duration-200"
                             :class="pop ? 'rotate-12' : 'rotate-0'"
                             :fill="bookmarked ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>
                </div>

                {{-- Info kebun --}}
                <a href="{{ route('kebun.show', $farm) }}" class="absolute bottom-4 left-4 right-4 text-white">
                    <p class="font-medium text-lg mb-1">{{ $farm->name_farm }}</p>
                    <p class="text-xs leading-snug line-clamp-3">
                        {{ $farm->location ?? 'Lokasi belum diisi' }} —
                        dikelola oleh {{ $farm->farmer->farm_name ?? $farm->farmer->user->name_user ?? 'Petani' }}.
                    </p>
                </a>
            </div>
        @empty
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
                <p class="text-sm text-gray-500">
                    @if ($q || $kategori)
                        Tidak ada kebun yang cocok dengan filter ini.
                    @else
                        Belum ada kebun yang terdaftar.
                    @endif
                </p>
                @if ($q || $kategori)
                    <a href="{{ route('user.index') }}" class="mt-3 inline-block text-xs text-brand-600 underline">Tampilkan semua kebun</a>
                @endif
            </div>
        @endforelse
    </div>

@endsection
