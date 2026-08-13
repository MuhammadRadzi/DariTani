@extends('layouts.guest')

@section('title', 'Verifikasi Email - DariTani.co.id')

@section('content')
<div class="min-h-screen bg-[#56ec4b] flex flex-col items-center justify-center px-4 py-10">

    {{-- Logo --}}
    <div class="mb-7">
        <img src="{{ asset('images/logo-daritani.png') }}" alt="DariTani" class="w-36 h-auto">
    </div>

    {{-- Card form --}}
    <div class="bg-white w-full max-w-sm rounded-2xl shadow-lg px-4 py-10">

        <div class="text-center mb-6 px-2">
            <h1 class="text-lg font-semibold text-black mb-2">Verifikasi Email Kamu</h1>
            <p class="text-sm text-[#5d5d5d]">
                Kami sudah kirim kode verifikasi 6 digit ke
                <span class="font-medium text-black">{{ $email }}</span>.
                Masukkan kodenya di bawah ini.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="mb-5 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify.submit') }}" class="flex flex-col gap-6 items-center">
            @csrf

            {{-- Kode OTP --}}
            <div class="w-full max-w-[300px]">
                <label for="verification_code" class="block text-sm text-black mb-2">Kode Verifikasi</label>
                <input
                    type="text"
                    name="verification_code"
                    id="verification_code"
                    inputmode="numeric"
                    maxlength="6"
                    placeholder="Masukkan 6 digit kode"
                    required
                    autofocus
                    class="w-full border border-[#878787] rounded-lg px-3 py-3 text-center text-2xl tracking-[0.5em] text-black placeholder-[#969696] placeholder:tracking-normal placeholder:text-sm focus:outline-none focus:ring-2 focus:ring-[#26e118] focus:border-transparent"
                >
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="bg-[#26e118] hover:bg-[#1fc713] transition-colors w-full max-w-[302px] h-[47px] rounded-lg text-white text-lg font-medium"
            >
                Verifikasi
            </button>

            {{-- Kirim ulang kode --}}
            <p class="text-sm text-[#5d5d5d]">
                Tidak menerima kode?
                <button type="submit" formaction="{{ route('verify.resend') }}" class="text-[#26e118] font-medium underline bg-transparent border-0 p-0 cursor-pointer">
                    Kirim ulang
                </button>
            </p>
        </form>
    </div>
</div>
@endsection
