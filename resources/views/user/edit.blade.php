@extends('layouts.app')

@section('title', 'Edit Profil - DariTani.co.id')

@section('content')

    <div class="flex items-center gap-3 mb-6 pt-2">
        <a href="{{ route('user.index') }}" aria-label="Kembali">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-lg font-medium text-black">Edit Profil</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
            {{ session('error') }}
        </div>
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

    <p class="text-xs text-gray-500 mb-6">
        Data ini digunakan sebagai informasi pengiriman saat checkout, supaya
        petani tahu pesanan ini dari siapa dan harus dikirim ke mana.
    </p>

    <form method="POST" action="{{ route('user.update') }}" class="flex flex-col gap-5">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name_user" class="block text-sm text-black mb-2">Nama</label>
            <input
                type="text"
                name="name_user"
                id="name_user"
                value="{{ old('name_user', $user->name_user) }}"
                required
                class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
            >
        </div>

        {{-- Email, read-only --}}
        <div>
            <label for="email_user" class="block text-sm text-black mb-2">Email</label>
            <input
                type="email"
                id="email_user"
                value="{{ $user->email_user }}"
                disabled
                class="w-full border border-gray-200 bg-gray-50 rounded-lg px-3 py-3 text-sm text-gray-500"
            >
            <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah.</p>
        </div>

        {{-- No. HP --}}
        <div>
            <label for="phone" class="block text-sm text-black mb-2">No. HP</label>
            <input
                type="tel"
                name="phone"
                id="phone"
                value="{{ old('phone', $customer->phone) }}"
                placeholder="08xxxxxxxxxx"
                class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
            >
        </div>

        {{-- Alamat --}}
        <div>
            <label for="address" class="block text-sm text-black mb-2">Alamat Pengiriman</label>
            <textarea
                name="address"
                id="address"
                rows="3"
                placeholder="Nama jalan, nomor rumah, kelurahan, kecamatan, kota"
                class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent resize-none"
            >{{ old('address', $customer->address) }}</textarea>
        </div>

        <button
            type="submit"
            class="bg-[#26e118] hover:bg-[#1fc713] transition-colors w-full h-[47px] rounded-lg text-white text-base font-medium mt-2"
        >
            Simpan Perubahan
        </button>
    </form>

@endsection
