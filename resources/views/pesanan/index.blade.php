@extends('layouts.app')

@section('title', 'Pesanan Saya - DariTani.co.id')

@section('content')

    @php
        $labels = [
            'pending'   => ['Menunggu',   'bg-yellow-100 text-yellow-700'],
            'paid'      => ['Dibayar',    'bg-blue-100 text-blue-700'],
            'shipped'   => ['Dikirim',    'bg-brand-100/50 text-brand-400'],
            'completed' => ['Selesai',    'bg-brand-300 text-white'],
            'cancelled' => ['Dibatalkan', 'bg-red-100 text-red-600'],
        ];
        $chip = 'shrink-0 px-3 py-1.5 text-xs font-medium rounded-full border transition-colors';
    @endphp

    <div x-data="{ batalUrl: null, nomorPesanan: '' }" class="pb-16">

        @if (session('success'))
            <div x-init="$dispatch('toast', { message: @js(session('success')) })"></div>
        @endif

        @if (session('error'))
            <div x-init="$dispatch('toast', { message: @js(session('error')) })"></div>
        @endif

        <h1 class="text-xl font-medium text-black mb-4">Pesanan Saya</h1>

        {{-- Filter status --}}
        <div class="flex gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
            <a href="{{ route('pesanan.index') }}"
               class="{{ $chip }} {{ $status === null ? 'bg-brand-300 border-brand-300 text-white' : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300' }}">
                Semua
            </a>
            @foreach ($labels as $key => [$text])
                <a href="{{ route('pesanan.index', ['status' => $key]) }}"
                   class="{{ $chip }} {{ $status === $key ? 'bg-brand-300 border-brand-300 text-white' : 'border-gray-200 bg-white text-gray-600 hover:border-gray-300' }}">
                    {{ $text }}
                </a>
            @endforeach
        </div>

        @forelse ($orders as $order)
            @php
                $st = $order->status ?? 'pending';
                [$stText, $stClass] = $labels[$st] ?? [$st, 'bg-gray-100 text-gray-600'];
                $farm = $order->items->first()?->product?->farm;
                $farmer = $farm?->farmer;
                $waUrl = $order->formatWaUrl();
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-4">
                {{-- Header kartu pesanan --}}
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div>
                        <p class="text-base font-medium text-black">Pesanan #{{ $order->order_number }}</p>
                        <p class="text-xs text-[#818588]">
                            {{ $order->order_date ? $order->order_date->format('d/m/Y') : '-' }} ·
                            <span class="font-medium text-gray-700">{{ $farm->name_farm ?? 'Kebun' }}</span>
                        </p>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $stClass }}">{{ $stText }}</span>
                </div>

                {{-- Daftar item pesanan --}}
                <div class="border-t border-gray-100 pt-3 space-y-2 mb-3">
                    @foreach ($order->items as $item)
                        <div class="flex items-start justify-between gap-3 text-sm">
                            <div class="min-w-0">
                                <p class="text-[#232323] font-medium">{{ $item->product?->product_name ?? 'Produk' }}</p>
                                <p class="text-xs text-[#818588]">
                                    {{ (float) $item->qty }} Kg × Rp{{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <p class="text-[#232323] shrink-0 font-medium">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach

                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <p class="text-sm font-medium text-black">Total Pesanan</p>
                        <p class="text-base font-semibold text-brand-400">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Alamat pengiriman --}}
                <div class="text-xs text-[#818588] bg-gray-50 rounded-xl p-3 mb-3 space-y-1">
                    <p><span class="font-medium text-gray-700">Alamat Kirim:</span> {{ $order->delivery_address }}</p>
                    @if ($order->notes)
                        <p><span class="font-medium text-gray-700">Catatan:</span> {{ $order->notes }}</p>
                    @endif
                </div>

                {{-- Tombol aksi --}}
                <div class="flex flex-wrap gap-2 pt-1">
                    @if ($st === 'pending')
                        @if ($waUrl)
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                               class="flex-1 min-w-[140px] flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-medium rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.54 1.771.82 2.791.82 3.181 0 5.767-2.586 5.768-5.766 0-3.18-2.587-5.766-5.768-5.766m9.969 5.768c0 5.505-4.495 10-10 10-.001 0-.002 0-.003 0-1.748 0-3.411-.459-4.872-1.314l-5.125 1.374 1.4-5.003c-.933-1.493-1.4-3.233-1.4-5.057 0-5.505 4.495-10 10-10 5.505 0 10 4.495 10 10"/>
                                </svg>
                                <span>Kirim ulang ke WhatsApp</span>
                            </a>
                        @endif

                        <button type="button"
                                @click="batalUrl = '{{ route('pesanan.cancel', $order) }}'; nomorPesanan = '{{ $order->order_number }}'"
                                class="px-3 py-2 text-xs font-medium rounded-lg border border-red-500 text-red-600 hover:bg-red-50 transition">
                            Batalkan
                        </button>
                    @elseif ($farmer && !blank($farmer->whatsapp_number))
                        @php
                            $digits = preg_replace('/\D+/', '', $farmer->whatsapp_number);
                            if (str_starts_with($digits, '0')) $digits = '62' . substr($digits, 1);
                        @endphp
                        <a href="https://wa.me/{{ $digits }}" target="_blank" rel="noopener"
                           class="flex-1 min-w-[120px] flex items-center justify-center text-center px-3 py-2 text-xs font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                            Hubungi Petani
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center my-6">
                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-brand-50 flex items-center justify-center text-brand-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <p class="text-base font-medium text-black mb-1">Belum ada pesanan</p>
                <p class="text-xs text-gray-500 mb-5">Pesanan hasil panen langsung dari petani akan muncul di sini.</p>
                <a href="{{ route('user.index') }}"
                   class="inline-block px-5 py-2 text-xs font-medium rounded-xl bg-brand-300 text-white hover:bg-brand-400 transition">
                    Mulai Belanja
                </a>
            </div>
        @endforelse

        <div class="mt-4 mb-8">{{ $orders->links() }}</div>

        {{-- Modal: konfirmasi batalkan pesanan --}}
        <div x-show="batalUrl" x-transition.opacity
             class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="batalUrl = null" class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-5">
                <p class="text-lg font-semibold text-black mb-2">Batalkan pesanan?</p>
                <p class="text-sm text-gray-500 mb-6">
                    Pesanan <span class="font-medium text-black" x-text="'#' + nomorPesanan"></span> akan dibatalkan dan stok produk akan dikembalikan.
                </p>
                <form method="POST" :action="batalUrl" class="flex flex-col gap-2.5">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition">
                        Ya, Batalkan Pesanan
                    </button>
                    <button type="button" @click="batalUrl = null"
                            class="w-full py-2.5 rounded-xl border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                        Kembali
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection
