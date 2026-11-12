@extends('layouts.farmer')

@section('title', 'Pesanan Masuk - DariTani.co.id')

@section('content')

    @php
        $labels = [
            'pending'   => ['Menunggu',   'bg-yellow-100 text-yellow-700'],
            'paid'      => ['Dibayar',    'bg-blue-100 text-blue-700'],
            'shipped'   => ['Dikirim',    'bg-brand-100/50 text-brand-400'],
            'completed' => ['Selesai',    'bg-brand-300 text-white'],
            'cancelled' => ['Dibatalkan', 'bg-red-100 text-red-600'],
        ];
        $aksi = [
            'paid'      => 'Tandai sudah dibayar',
            'shipped'   => 'Tandai dikirim',
            'completed' => 'Tandai selesai',
        ];
        $chip = 'shrink-0 px-3 py-1.5 text-xs font-medium rounded-full border';
    @endphp

    <div x-data="{ batalUrl: null }">

        @if (session('success'))
            <div x-init="$dispatch('toast', { message: @js(session('success')) })"></div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-xl font-medium text-black mb-4">Pesanan masuk</h1>

        {{-- Filter status --}}
        <div class="flex gap-2 overflow-x-auto pb-3 mb-3">
            <a href="{{ route('pesanan-masuk.index') }}"
               class="{{ $chip }} {{ $status === null ? 'bg-brand-300 border-brand-300 text-white' : 'border-gray-300 text-gray-600' }}">
                Semua
            </a>
            @foreach ($labels as $key => [$text])
                <a href="{{ route('pesanan-masuk.index', ['status' => $key]) }}"
                   class="{{ $chip }} {{ $status === $key ? 'bg-brand-300 border-brand-300 text-white' : 'border-gray-300 text-gray-600' }}">
                    {{ $text }}
                </a>
            @endforeach
        </div>

        @forelse ($orders as $order)
            @php
                $st = $order->status ?? 'pending';
                [$stText, $stClass] = $labels[$st] ?? [$st, 'bg-gray-100 text-gray-600'];
                $allowed   = $transitions[$st] ?? [];
                $next      = collect($allowed)->first(fn ($s) => $s !== 'cancelled');
                $canCancel = in_array('cancelled', $allowed, true);

                // wa.me butuh format internasional: 08xx -> 628xx
                $digits = preg_replace('/\D+/', '', $order->customer->phone ?? '');
                $wa = $digits
                    ? 'https://wa.me/' . (str_starts_with($digits, '0') ? '62' . substr($digits, 1) : $digits)
                    : null;
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-4">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div>
                        <p class="text-base font-medium text-black">Pesanan #{{ $order->order_number }}</p>
                        <p class="text-xs text-[#818588]">
                            {{ $order->order_date->format('d/m/Y') }} · {{ $order->customer->user->name_user }}
                        </p>
                    </div>
                    <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $stClass }}">{{ $stText }}</span>
                </div>

                <div class="border-t border-gray-100 pt-3 space-y-2 mb-3">
                    @foreach ($order->items as $item)
                        <div class="flex items-start justify-between gap-3 text-sm">
                            <div class="min-w-0">
                                <p class="text-[#232323]">{{ $item->product->product_name }}</p>
                                <p class="text-xs text-[#818588]">
                                    {{ (float) $item->qty }} Kg × Rp{{ number_format($item->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <p class="text-[#232323] shrink-0">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach

                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <p class="text-sm font-medium text-black">Total</p>
                        <p class="text-sm font-medium text-black">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="text-xs text-[#818588] space-y-0.5 mb-3">
                    <p>Alamat: <span class="text-[#181818]">{{ $order->delivery_address }}</span></p>
                    @if ($order->customer->phone)
                        <p>No. HP: <span class="text-[#181818]">{{ $order->customer->phone }}</span></p>
                    @endif
                    @if ($order->notes)
                        <p>Catatan: <span class="text-[#181818]">{{ $order->notes }}</span></p>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2">
                    @if ($wa)
                        <a href="{{ $wa }}" target="_blank" rel="noopener"
                           class="flex-1 min-w-[120px] flex items-center justify-center text-center px-3 py-2 text-xs font-medium rounded-lg border border-brand-300 text-brand-300">
                            Hubungi pembeli
                        </a>
                    @endif

                    @if ($next)
                        <form method="POST" action="{{ route('pesanan-masuk.status', $order) }}" class="flex flex-1 min-w-[120px]">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $next }}">
                            <button type="submit"
                                    class="w-full px-3 py-2 text-xs font-medium rounded-lg bg-brand-300 text-white hover:bg-brand-400">
                                {{ $aksi[$next] }}
                            </button>
                        </form>
                    @endif

                    @if ($canCancel)
                        <button type="button" @click="batalUrl = '{{ route('pesanan-masuk.status', $order) }}'"
                                class="px-3 py-2 text-xs font-medium rounded-lg border border-red-600 text-red-600">
                            Batalkan
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500 text-center py-10">Belum ada pesanan masuk.</p>
        @endforelse

        <div class="mb-6">{{ $orders->links() }}</div>

        {{-- Modal: konfirmasi batalkan pesanan --}}
        <div x-show="batalUrl" x-transition.opacity class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="batalUrl = null" class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-5">
                <p class="text-xl font-medium text-black mb-2">Batalkan pesanan?</p>
                <p class="text-sm text-gray-500 mb-6">Pesanan yang dibatalkan tidak bisa diaktifkan kembali.</p>
                <form method="POST" :action="batalUrl" class="flex flex-col gap-3">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="w-full h-[47px] rounded-lg border-2 border-red-600 bg-red-100 text-red-600 font-medium">
                        Batalkan pesanan
                    </button>
                    <button type="button" @click="batalUrl = null"
                            class="w-full h-[47px] rounded-lg border-2 border-gray-500 text-gray-500 font-medium">
                        Kembali
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection