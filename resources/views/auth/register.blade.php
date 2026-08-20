@extends('layouts.guest')

@section('title', 'Daftar - DariTani.co.id')

@section('content')
<div class="min-h-screen bg-[#56ec4b] flex flex-col items-center justify-center px-4 py-10">

    {{-- Logo --}}
    <div class="mb-7">
        <img src="{{ asset('images/logo-daritani.png') }}" alt="DariTani" class="w-36 h-auto">
    </div>

    {{-- Card form --}}
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-lg px-4 py-10">

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="flex flex-col gap-6 items-center">
            @csrf

            {{-- Nama --}}
            <div class="w-full max-w-[300px]">
                <label for="name_user" class="block text-sm text-black mb-2">Nama</label>
                <input
                    type="text"
                    name="name_user"
                    id="name_user"
                    value="{{ old('name_user') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                    autofocus
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
                >
            </div>

            {{-- Email --}}
            <div class="w-full max-w-[300px]">
                <label for="email_user" class="block text-sm text-black mb-2">Email</label>
                <input
                    type="email"
                    name="email_user"
                    id="email_user"
                    value="{{ old('email_user') }}"
                    placeholder="Masukkan email"
                    required
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
                >
            </div>

            {{-- Password --}}
            <div class="w-full max-w-[300px]">
                <label for="password" class="block text-sm text-black mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Minimal 8 karakter"
                    required
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
                >
            </div>

            {{-- Konfirmasi Password --}}
            <div class="w-full max-w-[300px]">
                <label for="password_confirmation" class="block text-sm text-black mb-2">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Ulangi password"
                    required
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="bg-[#26e118] hover:bg-[#1fc713] transition-colors w-full max-w-[302px] h-[47px] rounded-lg text-white text-lg font-medium"
            >
                Daftar
            </button>

            {{-- Link ke login --}}
            <p class="text-sm text-[#5d5d5d]">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-[#26e118] font-medium underline">Login</a>
            </p>
        </form>
    </div>
</div>
@endsection
