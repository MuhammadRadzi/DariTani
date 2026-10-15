@extends('layouts.farmer')

@section('title', 'Kebun Saya - DariTani.co.id')

@section('content')

    @php
        $input     = 'w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-transparent';
        $btnSimpan = 'w-full h-[47px] rounded-lg border-2 border-brand-300 text-brand-300 font-medium hover:bg-brand-100/20 transition-colors';
        $btnBatal  = 'w-full h-[47px] rounded-lg border-2 border-gray-500 text-gray-500 font-medium hover:bg-gray-50 transition-colors';
    @endphp

    <div
        x-data="{
            modal: null,
            produk: {},
            hapusUrl: '',
            preview: null,
            openTambah() { this.produk = {}; this.preview = null; this.modal = 'produk'; },
            openUbah(p) { this.produk = p; this.preview = p.image; this.modal = 'produk'; },
            openHapus(url) { this.hapusUrl = url; this.modal = 'hapus'; },
            close() { this.modal = null; },
            pilihGambar(e) {
                const f = e.target.files[0];
                if (f) this.preview = URL.createObjectURL(f);
            },
        }"
    >

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

        {{-- Banner kebun --}}
        <div class="relative h-40 rounded-2xl overflow-hidden mb-5">
            @if ($farm->photo_farm)
                <img src="{{ asset('storage/' . $farm->photo_farm) }}" alt="{{ $farm->name_farm }}"
                     class="absolute inset-0 w-full h-full object-cover">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-brand-200 to-brand-300"></div>
            @endif

            <form x-ref="fotoForm" method="POST" action="{{ route('kebun-saya.update', $farm) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label class="absolute bottom-3 right-3 flex items-center gap-2 bg-black/50 hover:bg-black/60 text-white text-xs font-medium rounded-full px-3 py-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
                    </svg>
                    Ganti foto
                    <input type="file" name="photo_farm" accept="image/*" class="hidden" @change="$refs.fotoForm.submit()">
                </label>
            </form>
        </div>

        {{-- Nama kebun --}}
        <div class="flex items-center justify-between gap-3 mb-3">
            <h1 class="text-2xl font-medium text-black">{{ $farm->name_farm }}</h1>
            <button type="button" @click="modal = 'nama'" class="bg-brand-200 rounded-full p-2 shrink-0" aria-label="Ganti nama kebun">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
        </div>

        {{-- Deskripsi kebun --}}
		<form method="POST" action="{{ route('kebun-saya.update', $farm) }}" class="mb-4" x-data="{ dirty: false }">
		    @csrf
		    @method('PUT')
		    <textarea
		        name="description_farm"
		        rows="4"
		        maxlength="500"
		        placeholder="Tulis deskripsi kebun kamu..."
		        @input="dirty = true"
		        class="w-full border border-[#878787] rounded-lg px-3 py-2 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-transparent resize-none"
		    >{{ old('description_farm', $farm->description_farm) }}</textarea>
		
		    <button type="submit" x-show="dirty" x-transition
		            class="mt-2 px-4 py-1.5 text-sm font-medium rounded-lg border-2 border-brand-300 text-brand-300 hover:bg-brand-100/20"
		            style="display: none;">
		        Simpan deskripsi
		    </button>
		</form>

        {{-- Lokasi --}}
        <div class="flex items-center justify-between gap-3 mb-6">
            <p class="text-base text-black">
                <span class="text-[#4e4e4e]">Lokasi:</span> {{ $farm->location ?? 'Belum diisi' }}
            </p>
            <button type="button" @click="modal = 'lokasi'" class="bg-brand-200 rounded-full p-2 shrink-0" aria-label="Ganti lokasi">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
        </div>

        {{-- Header daftar produk --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-medium text-black">Produk anda</h2>
            <button type="button" @click="openTambah()" class="flex items-center gap-2 text-sm font-medium text-black">
                Tambah Produk
                <span class="bg-brand-200 rounded-full p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </span>
            </button>
        </div>

        {{-- Daftar produk --}}
        <div class="flex flex-col gap-4 mb-6">
            @forelse ($farm->products as $product)
                @php
                    $payload = [
                        'name'     => $product->product_name,
                        'price'    => (float) $product->price_per_kg,
                        'stock'    => (float) $product->stock_qty,
                        'date'     => $product->harvest_date?->format('Y-m-d'),
                        'category' => $product->id_category,
                        'image'    => $product->product_image ? asset('storage/' . $product->product_image) : null,
                        'action'   => route('kebun-saya.produk.update', $product),
                    ];
                @endphp

                <div class="flex items-start gap-3 p-3 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div class="relative w-[110px] h-[110px] shrink-0 rounded-lg overflow-hidden">
                        @if ($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}"
                                 class="absolute inset-0 w-full h-full object-cover">
                        @else
                            +<div class="absolute inset-0 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-[#2e3137] mb-1">
                            Rp{{ number_format($product->price_per_kg, 0, ',', '.') }}/Kg
                        </p>
						@if ($product->rating !== null)
                        <div class="flex items-center gap-1 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.286-3.957a1 1 0 00-.363-1.118L2.98 9.385c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.958z" />
                            </svg>
                            <span class="text-xs text-[#818588]">{{ number_format($product->rating, 1) }}</span>
                        </div>
						@endif
                        <p class="text-sm text-[#232323] mb-2 line-clamp-2">{{ $product->product_name }}</p>
                        <div class="text-xs text-[#818588] space-y-0.5">
                            <p>Stok Total: <span class="text-[#181818]">{{ (float) $product->stock_qty }}</span></p>
                            <p>Waktu Panen: <span class="text-[#181818]">{{ $product->harvest_date?->format('d/m/Y') ?? '-' }}</span></p>
                            <p>Jenis: <span class="text-[#181818]">{{ $product->category->name_category ?? '-' }}</span></p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 shrink-0 w-17">
                        <button type="button" @click="openUbah(@js($payload))"
                                class="py-1.5 text-xs font-medium rounded-lg border border-brand-300 text-brand-300">
                            Ubah
                        </button>
                        <button type="button" @click="openHapus('{{ route('kebun-saya.produk.destroy', $product) }}')"
                                class="py-1.5 text-xs font-medium rounded-lg border border-red-600 text-red-600">
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 text-center py-10">Belum ada produk. Tekan "Tambah Produk" untuk mulai.</p>
            @endforelse
        </div>

        {{-- Modal: ganti nama kebun --}}
        <div x-show="modal === 'nama'" x-transition.opacity class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="close()" class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-5">
                <form method="POST" action="{{ route('kebun-saya.update', $farm) }}" class="flex flex-col gap-3">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-semibold text-black">Nama kebun/sawah</label>
                    <input type="text" name="name_farm" value="{{ old('name_farm', $farm->name_farm) }}" required class="{{ $input }}">
                    <button type="submit" class="{{ $btnSimpan }} mt-2">Simpan</button>
                    <button type="button" @click="close()" class="{{ $btnBatal }}">Batal</button>
                </form>
            </div>
        </div>



        {{-- Modal: ganti lokasi --}}
        <div x-show="modal === 'lokasi'" x-transition.opacity class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="close()" class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-5">
                <form method="POST" action="{{ route('kebun-saya.update', $farm) }}" class="flex flex-col gap-3">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-semibold text-black">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $farm->location) }}" required class="{{ $input }}">
                    <button type="submit" class="{{ $btnSimpan }} mt-2">Simpan</button>
                    <button type="button" @click="close()" class="{{ $btnBatal }}">Batal</button>
                </form>
            </div>
        </div>

        {{-- Modal: tambah / ubah produk --}}
        <div x-show="modal === 'produk'" x-transition.opacity class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="close()" class="w-full max-w-sm max-h-[90vh] overflow-y-auto bg-white rounded-2xl shadow-lg p-5">
                <form method="POST" :action="produk.action ?? '{{ route('kebun-saya.produk.store', $farm) }}'" enctype="multipart/form-data">
                    @csrf
                    <template x-if="produk.action"><input type="hidden" name="_method" value="PUT"></template>

                    <label class="relative flex flex-col items-center justify-center h-[170px] rounded-lg bg-gray-300 cursor-pointer overflow-hidden mb-5">
                        <template x-if="preview">
                            <img :src="preview" alt="" class="absolute inset-0 w-full h-full object-cover">
                        </template>
                        <template x-if="!preview">
                            <div class="flex flex-col items-center gap-2 text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-xs">Tambahkan Gambar</span>
                            </div>
                        </template>
                        <input type="file" name="product_image" accept="image/*" class="hidden" @change="pilihGambar($event)">
                    </label>

                    @foreach ([
                        ['product_name', 'Nama Produk', 'text', 'name'],
                        ['price_per_kg', 'Harga (per Kg)', 'number', 'price'],
                        ['stock_qty', 'Stok Total', 'number', 'stock'],
                        ['harvest_date', 'Waktu Panen', 'date', 'date'],
                    ] as [$field, $label, $type, $key])
                        <div class="mb-4">
                            <label class="block text-sm text-black mb-2">{{ $label }}</label>
                            <input type="{{ $type }}" name="{{ $field }}" :value="produk.{{ $key }} ?? ''"
                                   @if ($type === 'number') min="0" step="any" @endif
                                   @required($field !== 'harvest_date')
                                   class="{{ $input }}">
                        </div>
                    @endforeach

                    <div class="mb-6">
                        <label class="block text-sm text-black mb-2">Jenis</label>
                        <select name="id_category" :value="produk.category ?? ''" required class="{{ $input }} bg-white">
                            <option value="" disabled>Pilih jenis</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="{{ $btnSimpan }}">Simpan</button>
                        <button type="button" @click="close()" class="{{ $btnBatal }}">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal: konfirmasi hapus produk --}}
        <div x-show="modal === 'hapus'" x-transition.opacity class="fixed inset-0 z-9999 flex items-center justify-center bg-black/40 px-6" style="display: none;">
            <div @click.outside="close()" class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-5">
                <p class="text-xl font-medium text-black mb-2">Ingin menghapus produk?</p>
                <p class="text-sm text-gray-500 mb-6">Menghapus produk akan menghapusnya secara permanen.</p>
                <form method="POST" :action="hapusUrl" class="flex flex-col gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full h-[47px] rounded-lg border-2 border-red-600 bg-red-100 text-red-600 font-medium">Hapus</button>
                    <button type="button" @click="close()" class="{{ $btnBatal }}">Batal</button>
                </form>
            </div>
        </div>

    </div>

@endsection