@extends('layouts.guest')

@section('title', 'Login - DariTani.co.id')

@section('content')
<div class="min-h-screen bg-[#8AC936] flex flex-col items-center justify-center px-4 py-10">

    {{-- Logo --}}
    <div class="mb-7">
        <img src="{{ asset('images/logo-daritani.png') }}" alt="DariTani" class="w-36 h-auto">
    </div>

    {{-- Card form --}}
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-lg px-4 py-10">

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="flex flex-col gap-6 items-center">
            @csrf

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
                    autofocus
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#6EA12B] focus:border-transparent"
                >
            </div>

            {{-- Password --}}
            <div class="w-full max-w-[300px]">
                <label for="password" class="block text-sm text-black mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-sm text-black placeholder-[#969696] focus:outline-none focus:ring-2 focus:ring-[#6EA12B] focus:border-transparent"
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="bg-[#6EA12B] hover:bg-[#527820] transition-colors w-full max-w-[302px] h-[47px] rounded-lg text-white text-lg font-medium"
            >
                Submit
            </button>

            {{-- Link ke register --}}
            <p class="text-sm text-[#5d5d5d]">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[#6EA12B] font-medium underline">Daftar</a>
            </p>
        </form>
    </div>
</div>
@endsection