<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DariTani — Platform Pertanian Digital & Hasil Panen Segar Indonesia</title>
    <meta name="description" content="DariTani me-revolusi rantai pasok pertanian Indonesia. Menghubungkan petani lokal langsung dengan konsumen, didukung teknologi Smart Farming IoT dan jaminan 100% segar.">
    <meta name="keywords" content="DariTani, pertanian digital, smart farming indonesia, sayur organik, buah segar, hasil panen langsung petani, marketplace pertanian">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .glass-dark {
            background: rgba(35, 51, 14, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #527820 0%, #6EA12B 50%, #8AC936 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-gradient {
            background: radial-gradient(circle at 80% 20%, rgba(110, 161, 43, 0.15) 0%, rgba(255, 255, 255, 0) 60%),
                        linear-gradient(180deg, #F5FAEE 0%, #FFFFFF 100%);
        }
        .floating-anim {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #6EA12B;
            border-radius: 4px;
        }
    </style>
</head>
<body class="font-sans text-slate-800 bg-white antialiased selection:bg-brand-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-brand-900 text-white text-xs py-2 px-4 text-center font-medium flex items-center justify-center gap-2">
        <span class="bg-brand-500 text-brand-900 font-bold px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wider">Promo Hari Ini</span>
        <span>Gunakan kode voucher <strong class="text-amber-400">DARITANISEGAR</strong> untuk Gratis Ongkir Panen Pertama!</span>
        <button onclick="copyPromo()" class="underline hover:text-brand-300 ml-2 transition-colors cursor-pointer"><i class="fa-regular fa-copy mr-1"></i>Salin Kode</button>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-50 glass-nav border-b border-emerald-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-brand-700 via-brand-600 to-brand-400 flex items-center justify-center text-white shadow-lg shadow-brand-600/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-leaf text-xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight leading-none flex items-center gap-1">
                        Dari<span class="text-brand-600">Tani</span>
                        <span class="inline-block w-2 h-2 rounded-full bg-brand-500 animate-ping"></span>
                    </span>
                    <span class="text-[10px] font-semibold text-slate-500 tracking-wider uppercase mt-0.5">Smart Agriculture</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                <a href="#beranda" class="text-brand-700 font-semibold hover:text-brand-600 transition-colors">Beranda</a>
                <a href="#tentang" class="hover:text-brand-600 transition-colors">Tentang Kami</a>
                <a href="#fitur" class="hover:text-brand-600 transition-colors">Fitur Utama</a>
                <a href="#katalog" class="hover:text-brand-600 transition-colors">Katalog Panen</a>
                <a href="#smart-tech" class="hover:text-brand-600 transition-colors">Smart Farming</a>
                <a href="#kemitraan" class="hover:text-brand-600 transition-colors">Kemitraan</a>
                <a href="#faq" class="hover:text-brand-600 transition-colors">FAQ</a>
            </nav>

            <!-- Right Action Buttons -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('user.index') }}" class="text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user text-xs"></i>
                        <span>Dashboard Saya</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-brand-600 px-4 py-2 rounded-xl transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-gradient-to-r from-brand-600 to-brand-500 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Daftar Akun</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 p-2 focus:outline-none" aria-label="Toggle Navigation">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-drawer" class="hidden md:hidden glass-card border-t border-emerald-100 px-6 py-6 space-y-4">
            <a href="#beranda" class="block font-semibold text-brand-700 text-base" onclick="toggleMobileMenu()">Beranda</a>
            <a href="#tentang" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Tentang Kami</a>
            <a href="#fitur" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Fitur Utama</a>
            <a href="#katalog" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Katalog Panen</a>
            <a href="#smart-tech" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Smart Farming</a>
            <a href="#kemitraan" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Kemitraan Petani</a>
            <a href="#faq" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">FAQ</a>
            <div class="pt-4 border-t border-slate-200 flex flex-col gap-3">
                @auth
                    <a href="{{ route('user.index') }}" class="text-center font-semibold text-white bg-brand-600 py-3 rounded-xl shadow-md">Dashboard Saya</a>
                @else
                    <a href="{{ route('login') }}" class="text-center font-semibold text-slate-800 bg-slate-100 py-3 rounded-xl">Masuk ke Akun</a>
                    <a href="{{ route('register') }}" class="text-center font-semibold text-white bg-brand-600 py-3 rounded-xl shadow-md">Daftar Akun Baru</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="hero-gradient relative pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-200 text-brand-800 text-xs sm:text-sm font-semibold shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-pulse"></span>
                        <span>🌱 Revolusi Pertanian Digital #1 di Indonesia</span>
                        <i class="fa-solid fa-arrow-right text-xs text-brand-600"></i>
                    </div>

                    <h1 class="font-heading font-extrabold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.15] tracking-tight">
                        Menghubungkan Hasil Panen <span class="gradient-text">Segar & Organik</span> Langsung dari Petani
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        DariTani memberdayakan ribuan petani lokal dengan teknologi Smart Farming IoT. Kami menjamin distribusi panen 100% alami, tanpa bahan pengawet, dan tiba di meja makan Anda dalam 24 jam.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#katalog" class="w-full sm:w-auto text-center font-bold text-white bg-gradient-to-r from-brand-600 via-brand-500 to-emerald-600 px-8 py-4 rounded-2xl shadow-xl shadow-brand-600/30 hover:shadow-brand-600/50 hover:scale-[1.02] transition-all flex items-center justify-center gap-3 group">
                            <span>Jelajahi Hasil Panen</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <button onclick="openVideoModal()" class="w-full sm:w-auto text-center font-semibold text-slate-700 bg-white border border-slate-200 hover:border-brand-300 px-7 py-4 rounded-2xl shadow-sm hover:bg-brand-50/50 transition-all flex items-center justify-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-play ml-0.5"></i>
                            </div>
                            <span>Lihat Cara Kerja</span>
                        </button>
                    </div>

                    <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-4 text-center lg:text-left">
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">15.000+</p>
                            <p class="text-xs text-slate-500 font-medium">Petani Terverifikasi</p>
                        </div>
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">99.8%</p>
                            <p class="text-xs text-slate-500 font-medium">Kesegaran Terjamin</p>
                        </div>
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">120+</p>
                            <p class="text-xs text-slate-500 font-medium">Mitra Kebun Lokal</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/15 border-4 border-white bg-slate-100 group">
                        <img src="{{ asset('images/hero_farmer_field.png') }}" alt="Smart Farming DariTani" class="w-full h-[420px] sm:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>
                        
                        <div class="absolute bottom-6 left-6 right-6 text-white glass-dark p-4 rounded-2xl">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Live IoT Monitor</span>
                                </div>
                                <span class="text-[11px] bg-emerald-500/30 border border-emerald-400/40 px-2.5 py-0.5 rounded-full font-mono">Kebun Ciwidey #4</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 text-center pt-1 border-t border-white/10">
                                <div>
                                    <p class="text-[10px] text-slate-300">Kelembaban</p>
                                    <p class="font-bold text-sm text-emerald-400">78.4%</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-300">Suhu Udara</p>
                                    <p class="font-bold text-sm text-amber-300">24.2°C</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-300">Estimasi Panen</p>
                                    <p class="font-bold text-sm text-emerald-400">3 Hari</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -top-6 -left-6 z-20 glass-card p-4 rounded-2xl shadow-xl floating-anim hidden sm:flex items-center gap-3 max-w-[220px]">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div>
                            <p class="font-bold text-xs text-slate-900">100% Organik</p>
                            <p class="text-[10px] text-slate-500">Bebas Pestisida Kimia</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STATS BAR -->
    <section class="bg-brand-900 text-white py-10 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-brand-400 text-3xl font-extrabold font-heading mb-1">50.000+</div>
                    <div class="text-xs sm:text-sm text-brand-200">Ton Hasil Panen Terdistribusi</div>
                </div>
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1">120+</div>
                    <div class="text-xs sm:text-sm text-brand-200">Desa Binaan Pertanian Digital</div>
                </div>
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-brand-400 text-3xl font-extrabold font-heading mb-1">+45%</div>
                    <div class="text-xs sm:text-sm text-brand-200">Peningkatan Pendapatan Petani</div>
                </div>
                <div class="p-4">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1">99.4%</div>
                    <div class="text-xs sm:text-sm text-brand-200">Rating Kepuasan Konsumen</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="tentang" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-xl border-4 border-white">
                        <img src="{{ asset('images/fresh_produce_basket.png') }}" alt="Sayuran Organik" class="w-full h-[380px] object-cover">
                    </div>
                </div>

                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-800 text-xs font-bold uppercase tracking-wider">
                        Tentang DariTani
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Mengubah Masa Depan Pertanian Indonesia Melalui Teknologi & Keadilan Harga
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        DariTani hadir memangkas rantai distribusi panjang agar konsumen mendapatkan bahan pangan segar dalam waktu kurang dari 24 jam sekaligus memberikan keuntungan yang lebih layak bagi petani lokal.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white border border-slate-200">
                            <i class="fa-solid fa-hand-holding-heart text-brand-600 text-xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-sm text-slate-900">Perdagangan Adil</h4>
                                <p class="text-xs text-slate-500">Harga beli 30% di atas rata-rata tengkulak.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white border border-slate-200">
                            <i class="fa-solid fa-qrcode text-brand-600 text-xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-sm text-slate-900">Lacak Kebun</h4>
                                <p class="text-xs text-slate-500">Ketahui nama petani dan lokasi panen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SMART FARMING DEMO -->
    <section id="smart-tech" class="py-20 bg-brand-dark text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-800 text-brand-300 border border-brand-700 text-xs font-bold uppercase tracking-wider">
                        🛰️ Smart Agriculture IoT
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-white leading-tight">
                        Dashboard Pantau Kebun Real-Time
                    </h2>
                    <p class="text-brand-200/90 text-base leading-relaxed">
                        Sensor IoT cerdas memantau kondisi tanah, nutrisi, dan iklim mikro secara real-time untuk memastikan hasil panen unggul.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="glass-dark rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/15">
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-white/10">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></div>
                                <div>
                                    <h3 class="font-bold text-base text-white">Stasiun Kebun Hidroponik #08</h3>
                                    <p class="text-xs text-brand-300">Lembang, Jawa Barat — Aktif</p>
                                </div>
                            </div>
                        </div>

                        <div class="my-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                                <p class="text-xs text-slate-400 mb-1">Kelembaban Tanah</p>
                                <p class="font-heading font-extrabold text-3xl text-emerald-400">78%</p>
                            </div>
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                                <p class="text-xs text-slate-400 mb-1">Suhu Udara</p>
                                <p class="font-heading font-extrabold text-3xl text-amber-400">24.5°C</p>
                            </div>
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center">
                                <p class="text-xs text-slate-400 mb-1">Nutrisi EC</p>
                                <p class="font-heading font-extrabold text-3xl text-blue-400">1.8 mS</p>
                            </div>
                        </div>

                        <div class="relative rounded-2xl overflow-hidden border border-white/10 h-44">
                            <img src="{{ asset('images/smart_farming_tech.png') }}" alt="Greenhouse" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs">
            <p>&copy; 2026 DariTani Indonesia. Platform Pertanian Digital Terintegrasi.</p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobile-drawer').classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-btn').addEventListener('click', toggleMobileMenu);
        function copyPromo() {
            navigator.clipboard.writeText('DARITANISEGAR');
            alert('Kode voucher DARITANISEGAR berhasil disalin!');
        }
    </script>
</body>
</html>
