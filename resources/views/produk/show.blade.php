@extends('layouts.app')

@section('title', $farm->name_farm . ' - DariTani.co.id')

@section('content')

    {{-- Banner kebun --}}
    <div class="relative h-[204px] rounded-2xl overflow-hidden mb-5">
        @if ($farm->photo_farm)
            <img src="{{ asset('storage/' . $farm->photo_farm) }}" alt="{{ $farm->name_farm }}"
                 class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-green-300 to-green-500"></div>
        @endif
    </div>

    {{-- Nama & deskripsi kebun --}}
    <div class="mb-6">
        <h1 class="text-2xl font-medium text-black mb-3">{{ $farm->name_farm }}</h1>

        <p class="text-sm text-[#585454] leading-relaxed mb-3">
            {{ $farm->farmer->farm_name ? $farm->farmer->farm_name . '. ' : '' }}
            Kebun ini dikelola langsung oleh {{ $farm->farmer->user->name_user ?? 'petani' }}.
        </p>

        <p class="text-base text-black mb-5">
            <span class="text-[#4e4e4e]">Lokasi:</span>
            {{ $farm->location ?? 'Belum diisi' }}
        </p>

        <h2 class="text-xl font-medium text-black">
            Produk <span class="font-normal text-[#272727]">dari</span> {{ $farm->farmer->farm_name ?? $farm->farmer->user->name_user }}
        </h2>
    </div>

    {{-- Grid produk --}}
    <div class="grid grid-cols-2 gap-4 mb-6">
        @forelse ($farm->products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden relative">

                {{-- Foto produk --}}
                <div class="relative w-full aspect-square">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-100 to-gray-200"></div>
                    @endif

                    {{-- Tombol tambah ke keranjang, dengan animasi feedback --}}
                    <div
                        x-data="{
                            loading: false,
                            added: false,
                            async tambah() {
                                if (this.loading) return;
                                this.loading = true;
                                try {
                                    await fetch('{{ route('keranjang.store') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: JSON.stringify({ id_product: {{ $product->id_product }} }),
                                    });
                                    this.added = true;
                                    setTimeout(() => this.added = false, 1200);
                                } finally {
                                    this.loading = false;
                                }
                            },
                        }"
                        class="absolute top-2 right-2"
                    >
                        <button
                            type="button"
                            @click="tambah()"
                            :class="added ? 'bg-[#26e118] scale-125' : 'bg-[#3ba133] scale-100'"
                            class="rounded-full p-2 shadow transition-all duration-300 ease-out"
                            aria-label="Tambah ke keranjang"
                        >
                            <template x-if="!added">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </template>
                            <template x-if="added">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                        </button>

                        {{-- Toast kecil "Ditambahkan" --}}
                        <div
                            x-show="added"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute top-full mt-1 right-0 bg-black/80 text-white text-[10px] px-2 py-1 rounded whitespace-nowrap"
                            style="display: none;"
                        >
                            Ditambahkan
                        </div>
                    </div>
                </div>

                {{-- Info produk --}}
                <div class="p-3">
                    <p class="text-sm font-medium text-[#2e3137] mb-1">
                        Rp{{ number_format($product->price_per_kg, 0, ',', '.') }}/Kg
                    </p>

                    <div class="flex items-center gap-1 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.286-3.957a1 1 0 00-.363-1.118L2.98 9.385c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.958z" />
                        </svg>
                        <span class="text-xs text-[#818588]">{{ number_format($product->rating, 1) }}</span>
                    </div>

                    <p class="text-sm text-[#232323] mb-2 line-clamp-2">{{ $product->product_name }}</p>

                    <div class="text-xs text-[#818588] space-y-0.5">
                        <p>Stok Total: <span class="text-[#181818]">{{ (int) $product->stock_qty }}</span></p>
                        <p>Waktu Panen:
                            <span class="text-[#181818]">
                                {{ $product->harvest_date?->format('d/m/Y') ?? '-' }}
                            </span>
                        </p>
                        <p>Jenis: <span class="text-[#181818]">{{ $product->category->name_category ?? '-' }}</span></p>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-2 text-sm text-gray-500 text-center py-10">
                Belum ada produk di kebun ini.
            </p>
        @endforelse
    </div>

@endsection
