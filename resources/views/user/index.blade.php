@extends('layouts.app')

@section('title', 'Beranda - DariTani.co.id')

@section('content')

    {{-- Banner Selamat Datang --}}
    <div class="relative h-[171px] rounded-lg overflow-hidden mb-4"
         style="background: radial-gradient(circle at 50% 50%, #56ec4b, #3ad62f, #1ec112);">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
            <p class="font-bold text-2xl" style="text-shadow: -1px 3px 0 rgba(0,0,0,0.25);">Selamat Datang</p>
            <p class="text-sm mt-1" style="text-shadow: -1px 2px 0 rgba(0,0,0,0.25);">
                Di <span class="font-semibold">DariTani</span>
            </p>
        </div>
    </div>

    {{-- Kategori produk (pengganti widget statistik) --}}
    <div class="grid grid-cols-4 gap-3 mb-5">
        @foreach ($categories as $category)
            <a href="#" class="flex flex-col items-center gap-2">
                <div class="w-14 h-14 rounded-full flex items-center justify-center"
                     style="background: linear-gradient(228deg, #56ec4b 5%, #94ff8c 165%);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                    </svg>
                </div>
                <span class="text-[10px] text-center text-[#343434] leading-tight">{{ $category->name_category }}</span>
            </a>
        @endforeach
    </div>

    {{-- List kebun --}}
    <h2 class="text-xl font-medium text-black mb-3">Produk DariTani</h2>

    <div class="flex flex-col gap-4 pb-4">
        @forelse ($farms as $farm)
            <a href="{{ route('kebun.show', $farm) }}" class="relative block h-[220px] rounded-lg overflow-hidden shadow-md">
                {{-- Placeholder gambar kebun --}}
                @if ($farm->photo_farm)
                    <img src="{{ asset('storage/' . $farm->photo_farm) }}" alt="{{ $farm->name_farm }}"
                         class="absolute inset-0 w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-green-200 to-green-400"></div>
                @endif

                {{-- Overlay gradasi gelap di bawah --}}
                <div class="absolute inset-x-0 bottom-0 h-3/5 bg-gradient-to-t from-black/80 to-transparent"></div>

                {{-- Tombol bookmark --}}
                <div class="absolute top-3 right-3 bg-[#56ec4b] rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </div>

                {{-- Info kebun --}}
                <div class="absolute bottom-4 left-4 right-4 text-white">
                    <p class="font-medium text-lg mb-1">{{ $farm->name_farm }}</p>
                    <p class="text-xs leading-snug line-clamp-3">
                        {{ $farm->location ?? 'Lokasi belum diisi' }} —
                        dikelola oleh {{ $farm->farmer->farm_name ?? $farm->farmer->user->name_user ?? 'Petani' }}.
                    </p>
                </div>
            </a>
        @empty
            <p class="text-sm text-gray-500 text-center py-10">Belum ada kebun yang terdaftar.</p>
        @endforelse
    </div>

@endsection
