@extends('layouts.app')

@section('title', 'Markah Petani - DariTani.co.id')

@section('content')

    <div class="flex items-center justify-between mb-6 pt-2">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.index') }}" aria-label="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-medium text-black">Markah Petani</h1>
        </div>

        @if ($bookmarks->isNotEmpty())
            <form method="POST" action="{{ route('markah.destroyAll') }}"
                  onsubmit="return confirm('Hapus semua markah?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-brand-200 font-medium">
                    Hapus Semua
                </button>
            </form>
        @endif
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($bookmarks->isEmpty())
        {{-- Markah kosong --}}
        <div class="flex flex-col items-center justify-center py-12 text-center min-h-[65vh]">
            <div class="relative w-72 h-52 mx-auto flex items-center justify-center mb-6">
                <img src="{{ asset('images/empty-cart-bg.png') }}" alt="" class="absolute inset-0 w-full h-full object-contain">
                <img src="{{ asset('images/empty-markah-icon.png') }}" alt="Markah Kosong" class="relative w-28 h-28 object-contain z-10">
            </div>

            <h2 class="text-xl font-bold text-black mb-1">Yah Markah mu Kosong</h2>
            <p class="text-sm text-gray-700 mb-6">Yuk jelajahi kebun sekarang!</p>

            <a href="{{ route('user.index') }}"
               class="inline-flex items-center justify-center px-8 py-3 bg-brand-300 hover:bg-brand-400 active:scale-95 transition-all text-white font-bold text-base rounded-full shadow-sm">
                Jelajahi Kebun
            </a>
        </div>
    @else
        <div class="flex flex-col gap-4 pb-4">
            @foreach ($bookmarks as $bookmark)
                @php $farm = $bookmark->farm; @endphp
                @continue (! $farm)
                <div
                    x-data="{ removing: false, removed: false }"
                    x-show="! removed"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="relative h-[220px] rounded-lg overflow-hidden shadow-md"
                    :class="removing ? 'opacity-60' : ''"
                >
                    <a href="{{ route('kebun.show', $farm) }}" class="absolute inset-0">
                        @if ($farm->photo_farm)
                            <img src="{{ asset('storage/' . $farm->photo_farm) }}" alt="{{ $farm->name_farm }}"
                                 class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-green-200 to-green-400"></div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 h-3/5 bg-gradient-to-t from-black/80 to-transparent"></div>
                    </a>

                    {{-- Tombol hapus markah, animasi fade-out sebelum card hilang --}}
                    <button
                        type="button"
                        @click="
                            if (removing) return;
                            removing = true;
                            fetch('{{ route('markah.destroy', $farm) }}', {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                            }).then(() => {
                                removed = true;
                                $dispatch('toast', { message: 'Dihapus dari markah.' });
                            });
                        "
                        :class="removing ? 'scale-90' : 'scale-100'"
                        class="absolute top-3 right-3 bg-brand-200 rounded-full p-2 transition-transform duration-200"
                        aria-label="Hapus dari markah"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </button>

                    {{-- Info kebun --}}
                    <a href="{{ route('kebun.show', $farm) }}" class="absolute bottom-4 left-4 right-4 text-white pointer-events-none">
                        <p class="font-medium text-lg mb-1">{{ $farm->name_farm }}</p>
                        <p class="text-xs leading-snug line-clamp-3">
                            {{ $farm->location ?? 'Lokasi belum diisi' }} —
                            dikelola oleh {{ $farm->farmer->farm_name ?? $farm->farmer->user->name_user ?? 'Petani' }}.
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

@endsection
