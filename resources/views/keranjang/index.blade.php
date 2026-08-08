@extends('layouts.app')

@section('title', 'Keranjang Belanja - DariTani.co.id')

@section('content')

    <div class="flex items-center gap-3 mb-5 pt-2">
        <a href="{{ route('user.index') }}" aria-label="Kembali">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-lg font-medium text-black">Keranjang Belanja</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($groupedByFarm->isEmpty())
        {{-- Keranjang kosong --}}
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="text-sm text-gray-500">Keranjang kamu masih kosong.</p>
            <a href="{{ route('user.index') }}" class="mt-4 text-sm text-[#26e118] font-medium underline">
                Mulai belanja
            </a>
        </div>
    @else
        {{-- Setiap grup = 1 kebun. Checkout hanya diperbolehkan untuk 1 kebun
             per transaksi, jadi tiap grup punya form checkout sendiri-sendiri.
             State qty semua item disimpan di sini supaya subtotal bisa
             dihitung ulang secara reaktif tanpa reload. --}}
        @foreach ($groupedByFarm as $idFarm => $items)
            @php
                $farm = $items->first()->product->farm;
                $farmer = $farm->farmer;
                $itemsData = $items->map(fn ($item) => [
                    'id' => $item->id_cart_item,
                    'qty' => (int) $item->qty,
                    'price' => (float) $item->product->price_per_kg,
                ]);
            @endphp

            <div
                class="mb-6 border border-gray-100 rounded-xl shadow-sm overflow-hidden"
                x-data="{
                    items: {{ $itemsData->toJson() }},
                    get subtotal() {
                        return this.items.reduce((sum, i) => sum + (i.qty * i.price), 0);
                    },
                    setQty(id, qty) {
                        const item = this.items.find(i => i.id === id);
                        if (item) item.qty = qty;
                    },
                }"
            >

                {{-- Header kebun --}}
                <div class="bg-gray-50 px-4 py-3">
                    <p class="font-medium text-black">{{ $farm->name_farm }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $farmer->farm_name ?? $farmer->user->name_user }} — {{ $farm->location ?? 'Lokasi belum diisi' }}
                    </p>
                </div>

                {{-- Item produk dalam kebun ini --}}
                <div class="divide-y divide-gray-100">
                    @foreach ($items as $item)
                        <div class="flex items-center gap-3 px-4 py-3" data-cart-item>
                            {{-- Foto --}}
                            <div class="w-16 h-16 rounded-lg overflow-hidden shrink-0 bg-gray-100">
                                @if ($item->product->product_image)
                                    <img src="{{ asset('storage/' . $item->product->product_image) }}"
                                         alt="{{ $item->product->product_name }}"
                                         class="w-full h-full object-cover">
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-black truncate">{{ $item->product->product_name }}</p>
                                <p class="text-xs text-gray-500">
                                    Rp{{ number_format($item->product->price_per_kg, 0, ',', '.') }}/Kg
                                </p>
                            </div>

                            {{-- Qty selector, update tanpa reload + subtotal reaktif --}}
                            <div
                                x-data="{
                                    qty: {{ (int) $item->qty }},
                                    loading: false,
                                    async ubah(delta) {
                                        const baru = Math.max(1, this.qty + delta);
                                        if (baru === this.qty) return;
                                        this.qty = baru;
                                        setQty({{ $item->id_cart_item }}, baru);
                                        this.loading = true;
                                        try {
                                            await fetch('{{ route('keranjang.update', $item) }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'X-HTTP-Method-Override': 'PATCH',
                                                },
                                                body: JSON.stringify({ qty: this.qty }),
                                            });
                                        } finally {
                                            this.loading = false;
                                        }
                                    },
                                }"
                                class="flex items-center border border-gray-200 rounded-full"
                                :class="{ 'opacity-50': loading }"
                            >
                                <button type="button" @click="ubah(-1)"
                                        class="w-7 h-7 flex items-center justify-center text-gray-500">-</button>
                                <span class="text-sm w-6 text-center" x-text="qty"></span>
                                <button type="button" @click="ubah(1)"
                                        class="w-7 h-7 flex items-center justify-center text-gray-500">+</button>
                            </div>

                            {{-- Hapus, tanpa reload + toast + subtotal reaktif --}}
                            <button
                                type="button"
                                @click="
                                    if ($el.dataset.removing) return;
                                    $el.dataset.removing = '1';
                                    const card = $el.closest('[data-cart-item]');
                                    fetch('{{ route('keranjang.destroy', $item) }}', {
                                        method: 'DELETE',
                                        headers: {
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                    }).then(() => {
                                        $dispatch('toast', { message: 'Produk dihapus dari keranjang.' });
                                        items = items.filter(i => i.id !== {{ $item->id_cart_item }});
                                        card.style.transition = 'opacity 250ms, transform 250ms';
                                        card.style.opacity = '0';
                                        card.style.transform = 'scale(0.97)';
                                        setTimeout(() => card.remove(), 250);
                                    });
                                "
                                aria-label="Hapus"
                                class="text-red-400 ml-1"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                {{-- Subtotal (reaktif) + checkout, khusus kebun ini saja --}}
                <div class="px-4 py-3 bg-gray-50 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Subtotal</p>
                        <p class="text-sm font-medium text-black" x-text="'Rp' + subtotal.toLocaleString('id-ID')"></p>
                    </div>
                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf
                        <input type="hidden" name="id_farm" value="{{ $idFarm }}">
                        <button type="submit"
                                class="bg-[#26e118] hover:bg-[#1fc713] transition-colors text-white text-sm font-medium px-5 py-2 rounded-full">
                            Checkout kebun ini
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        <p class="text-xs text-gray-400 text-center mb-6">
            Checkout hanya bisa dilakukan untuk 1 kebun per transaksi.
            Item dari kebun lain akan tetap tersimpan di keranjang.
        </p>
    @endif

@endsection
