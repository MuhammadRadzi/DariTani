<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DariTani.co.id — Katalog Hasil Tani Malino untuk Pelaku Usaha Makassar</title>
    <meta name="description" content="DariTani.co.id menghubungkan petani hortikultura Malino, Kabupaten Gowa langsung dengan pelaku usaha Horeka dan pedagang di Makassar melalui katalog digital dan pemesanan langsung via WhatsApp — tanpa perantara, gratis untuk petani.">
    <meta name="keywords" content="DariTani, DariTani.co.id, petani Malino, sayur Malino, kentang Malino, katalog hasil tani, Horeka Makassar, pedagang sayur Makassar">
    
    <!-- Font Awesome / CDN Icons -->
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
            background-clip: text;
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
        .pulse-subtle {
            animation: pulse-glow 3s infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.8; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.03); }
        }
        /* Custom scrollbar */
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
<body class="font-sans text-slate-800 bg-white antialiased selection:bg-brand-300 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-brand-500 text-white text-xs py-2 px-4 text-center font-medium flex items-center justify-center gap-2">
        <i class="fa-solid fa-leaf text-brand-300"></i>
        <span>Menghubungkan petani Malino, Kabupaten Gowa langsung dengan pelaku usaha Horeka & pedagang di Makassar — tanpa tengkulak, gratis untuk petani.</span>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-50 glass-nav border-b border-emerald-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-brand-400 via-brand-400 to-brand-300 flex items-center justify-center text-white shadow-lg shadow-brand-400/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-leaf text-xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight leading-none flex items-center gap-1">
                        Dari<span class="text-brand-400">Tani</span>
                        <span class="inline-block w-2 h-2 rounded-full bg-brand-300 animate-ping"></span>
                    </span>
                    <span class="text-[10px] font-semibold text-slate-500 tracking-wider uppercase mt-0.5">Katalog Hasil Tani Malino</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-600">
                <a href="#beranda" class="text-brand-400 font-semibold hover:text-brand-400 transition-colors">Beranda</a>
                <a href="#tentang" class="hover:text-brand-400 transition-colors">Tentang Kami</a>
                <a href="#fitur" class="hover:text-brand-400 transition-colors">Fitur Utama</a>
                <a href="#katalog" class="hover:text-brand-400 transition-colors">Katalog</a>
                <a href="#cara-kerja" class="hover:text-brand-400 transition-colors">Cara Kerja</a>
                <a href="#kemitraan" class="hover:text-brand-400 transition-colors">Kemitraan</a>
                <a href="#faq" class="hover:text-brand-400 transition-colors">FAQ</a>
            </nav>

            <!-- Right Action Buttons -->
            <div class="hidden md:flex items-center gap-4">
                <?php if (isset($user)): ?>
                    <a href="{{ route('user.index') }}" class="text-sm font-semibold text-white bg-brand-400 hover:bg-brand-500 px-5 py-2.5 rounded-xl shadow-md transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user text-xs"></i>
                        <span>Dashboard Saya</span>
                    </a>
                <?php else: ?>
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-brand-400 px-4 py-2 rounded-xl transition-colors">
                        Masuk
                    </a>
                <?php endif; ?>
                <a href="#katalog" class="text-sm font-semibold bg-gradient-to-r from-brand-400 to-brand-300 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-brand-400/25 hover:shadow-brand-400/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-basket-shopping text-xs"></i>
                    <span>Lihat Katalog</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" class="md:hidden text-slate-700 p-2 focus:outline-none" aria-label="Toggle Navigation">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-drawer" class="hidden md:hidden glass-card border-t border-emerald-100 px-6 py-6 space-y-4">
            <a href="#beranda" class="block font-semibold text-brand-400 text-base" onclick="toggleMobileMenu()">Beranda</a>
            <a href="#tentang" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Tentang Kami</a>
            <a href="#fitur" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Fitur Utama</a>
            <a href="#katalog" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Katalog</a>
            <a href="#cara-kerja" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Cara Kerja</a>
            <a href="#kemitraan" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">Kemitraan Petani</a>
            <a href="#faq" class="block text-slate-700 text-base" onclick="toggleMobileMenu()">FAQ</a>
            <div class="pt-4 border-t border-slate-200 flex flex-col gap-3">
                <?php if (isset($user)): ?>
                    <a href="{{ route('user.index') }}" class="text-center font-semibold text-white bg-brand-400 py-3 rounded-xl shadow-md">Dashboard Saya</a>
                <?php else: ?>
                    <a href="{{ route('login') }}" class="text-center font-semibold text-slate-800 bg-slate-100 py-3 rounded-xl">Masuk ke Akun</a>
                <?php endif; ?>
                <a href="#katalog" class="text-center font-semibold text-white bg-brand-400 py-3 rounded-xl shadow-md">Lihat Katalog Sekarang</a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="beranda" class="hero-gradient relative pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden">
        <!-- Abstract Background Glows -->
        <div class="absolute top-1/4 left-10 w-96 h-96 bg-brand-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-amber-200/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- Left Hero Content -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-100 border border-brand-200 text-brand-500 text-xs sm:text-sm font-semibold shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-300 animate-pulse"></span>
                        <span>🌱 Katalog Digital Hasil Tani Malino</span>
                        <i class="fa-solid fa-arrow-right text-xs text-brand-400"></i>
                    </div>

                    <!-- Headline -->
                    <h1 class="font-heading font-extrabold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.15] tracking-tight">
                        Menghubungkan Hasil Panen <span class="gradient-text">Petani Malino</span> Langsung ke Pelaku Usaha Makassar
                    </h1>

                    <!-- Paragraph -->
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        DariTani.co.id adalah katalog digital yang mempertemukan petani hortikultura di Malino, Kabupaten Gowa langsung dengan pelaku usaha Horeka, pedagang, dan penjual sayur di Makassar — memotong rantai tengkulak yang panjang, tanpa dipungut biaya dari petani.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#katalog" class="w-full sm:w-auto text-center font-bold text-white bg-gradient-to-r from-brand-400 via-brand-300 to-emerald-600 px-8 py-4 rounded-2xl shadow-xl shadow-brand-400/30 hover:shadow-brand-400/50 hover:scale-[1.02] transition-all flex items-center justify-center gap-3 group">
                            <span>Jelajahi Katalog Produk</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <button onclick="openVideoModal()" class="w-full sm:w-auto text-center font-semibold text-slate-700 bg-white border border-slate-200 hover:border-brand-200 px-7 py-4 rounded-2xl shadow-sm hover:bg-brand-100/50 transition-all flex items-center justify-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-brand-100 text-brand-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-play ml-0.5"></i>
                            </div>
                            <span>Lihat Cara Kerja</span>
                        </button>
                    </div>

                    <!-- Trust Stats Footprint -->
                    <div class="pt-6 border-t border-slate-200/80 grid grid-cols-3 gap-4 text-center lg:text-left">
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">70%+</p>
                            <p class="text-xs text-slate-500 font-medium">Produksi Kentang Gowa dari Malino</p>
                        </div>
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">Gratis</p>
                            <p class="text-xs text-slate-500 font-medium">Untuk Semua Petani Mitra</p>
                        </div>
                        <div>
                            <p class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">0</p>
                            <p class="text-xs text-slate-500 font-medium">Perantara Tengkulak</p>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Visual Showcase -->
                <div class="lg:col-span-5 relative">
                    <!-- Main Hero Image Container -->
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/15 border-4 border-white bg-slate-100 group">
                        <svg viewBox="0 0 500 560" class="w-full h-[420px] sm:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#dcfce7"/>
                                    <stop offset="100%" stop-color="#f0fdf4"/>
                                </linearGradient>
                            </defs>
                            <rect width="500" height="560" fill="url(#skyGrad)"/>
                            <circle cx="390" cy="110" r="55" fill="#fbbf24"/>
                            <path d="M0 330 Q125 260 250 320 T500 300 V560 H0 Z" fill="#86efac"/>
                            <path d="M0 390 Q140 330 280 380 T500 360 V560 H0 Z" fill="#4ade80"/>
                            <path d="M0 460 Q150 410 300 450 T500 430 V560 H0 Z" fill="#22c55e"/>
                            <g stroke="#15803d" stroke-width="4" stroke-linecap="round">
                                <path d="M40 560 V500 M40 500 q10 -14 0 -26 M40 500 q-10 -14 0 -26"/>
                                <path d="M110 560 V470 M110 470 q12 -16 0 -30 M110 470 q-12 -16 0 -30"/>
                                <path d="M190 560 V495 M190 495 q10 -14 0 -26 M190 495 q-10 -14 0 -26"/>
                                <path d="M300 560 V480 M300 480 q12 -16 0 -30 M300 480 q-12 -16 0 -30"/>
                                <path d="M380 560 V500 M380 500 q10 -14 0 -26 M380 500 q-10 -14 0 -26"/>
                                <path d="M450 560 V475 M450 475 q12 -16 0 -30 M450 475 q-12 -16 0 -30"/>
                            </g>
                            <ellipse cx="230" cy="555" rx="26" ry="14" fill="#d97706"/>
                            <ellipse cx="230" cy="548" rx="20" ry="10" fill="#f59e0b"/>
                        </svg>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>

                        <!-- Overlay Farm Badge -->
                        <div class="absolute bottom-6 left-6 right-6 text-white glass-dark p-4 rounded-2xl">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Profil Petani Aktif</span>
                                </div>
                                <span class="text-[11px] bg-emerald-500/30 border border-emerald-400/40 px-2.5 py-0.5 rounded-full font-mono">Malino, Kab. Gowa</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 text-center pt-1 border-t border-white/10">
                                <div>
                                    <p class="text-[10px] text-slate-300">Komoditas</p>
                                    <p class="font-bold text-sm text-emerald-400">Kentang</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-300">Update Stok</p>
                                    <p class="font-bold text-sm text-amber-300">Berkala</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-slate-300">Kontak</p>
                                    <p class="font-bold text-sm text-emerald-400">WhatsApp</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Badge Top Left -->
                    <div class="absolute -top-6 -left-6 z-20 glass-card p-4 rounded-2xl shadow-xl floating-anim hidden sm:flex items-center gap-3 max-w-[220px]">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <div>
                            <p class="font-bold text-xs text-slate-900">Langsung dari Petani</p>
                            <p class="text-[10px] text-slate-500">Tanpa perantara tengkulak</p>
                        </div>
                    </div>

                    <!-- Floating Badge Bottom Right -->
                    <div class="absolute -bottom-6 -right-6 z-20 glass-card p-4 rounded-2xl shadow-xl hidden sm:flex items-center gap-3 max-w-[230px]">
                        <div class="w-12 h-12 rounded-xl bg-brand-100 text-brand-400 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <p class="font-bold text-xs text-slate-900">Petani Mitra</p>
                            <p class="text-[10px] text-brand-400 font-semibold">Malino, Kab. Gowa</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STATS COUNTER BAR -->
    <section class="bg-brand-500 text-white py-10 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4 border-r border-brand-500 last:border-0">
                    <div class="text-brand-300 text-3xl font-extrabold font-heading mb-1">70%+</div>
                    <div class="text-xs sm:text-sm text-brand-200">Produksi Kentang Gowa dari Malino</div>
                </div>
                <div class="p-4 border-r border-brand-500 last:border-0">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1">5</div>
                    <div class="text-xs sm:text-sm text-brand-200">Komoditas Unggulan Malino</div>
                </div>
                <div class="p-4 border-r border-brand-500 last:border-0">
                    <div class="text-brand-300 text-3xl font-extrabold font-heading mb-1">Gratis</div>
                    <div class="text-xs sm:text-sm text-brand-200">Untuk Petani, Selamanya</div>
                </div>
                <div class="p-4">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1">WhatsApp</div>
                    <div class="text-xs sm:text-sm text-brand-200">Pemesanan Langsung ke Petani</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="tentang" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Image Collage -->
                <div class="lg:col-span-6 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-xl border-4 border-white">
                        <svg viewBox="0 0 400 380" class="w-full h-[380px] object-cover" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="380" fill="#f0fdf4"/>
                            <circle cx="120" cy="150" r="60" fill="#ef4444"/>
                            <path d="M120 90 q10 -18 26 -14" stroke="#16a34a" stroke-width="6" fill="none" stroke-linecap="round"/>
                            <ellipse cx="230" cy="160" rx="46" ry="58" fill="#f59e0b"/>
                            <path d="M230 102 q8 -16 -6 -24" stroke="#16a34a" stroke-width="6" fill="none" stroke-linecap="round"/>
                            <path d="M300 130 q30 -10 30 34 q0 44 -30 34 q-30 -10 -30 -34 q0 -44 30 -34 Z" fill="#f97316"/>
                            <path d="M300 128 v-26 M292 108 q8 -6 8 -18 M308 108 q-8 -6 -8 -18" stroke="#16a34a" stroke-width="5" fill="none" stroke-linecap="round"/>
                            <path d="M40 220 h320 l-26 130 q-2 12 -14 12 H80 q-12 0 -14 -12 Z" fill="#c9975b"/>
                            <path d="M52 250 h296 M46 280 h308 M42 310 h316" stroke="#a9773f" stroke-width="6" opacity="0.6"/>
                            <path d="M40 220 h320 l6 -22 h-332 Z" fill="#dba86b"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-8 -left-6 z-20 w-3/5 rounded-2xl overflow-hidden shadow-2xl border-4 border-white hidden sm:block">
                        <svg viewBox="0 0 300 192" class="w-full h-48 object-cover" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                            <rect width="300" height="192" fill="#16a34a"/>
                            <circle cx="150" cy="60" r="30" fill="#fbbf24" opacity="0.9"/>
                            <path d="M150 96 q-46 0 -50 70 h100 q-4 -70 -50 -70 Z" fill="#0B2B18"/>
                            <path d="M115 60 q35 -22 70 0 q0 -30 -35 -30 q-35 0 -35 30 Z" fill="#166534"/>
                            <path d="M170 150 q14 -20 30 -18" stroke="#4ade80" stroke-width="6" fill="none" stroke-linecap="round"/>
                            <circle cx="205" cy="128" r="9" fill="#f59e0b"/>
                        </svg>
                    </div>
                </div>

                <!-- Right Text -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-500 text-xs font-bold uppercase tracking-wider">
                        Tentang DariTani.co.id
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Solusi Rantai Pasok yang Adil untuk Petani Malino dan Pelaku Usaha Makassar
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Petani di kawasan Malino, Kabupaten Gowa seringkali dihadapkan pada tengkulak dan rantai distribusi yang panjang. Akibatnya, harga jual di tingkat petani tertekan, sementara pembeli sulit mendapat pasokan segar dengan harga yang kompetitif.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        <strong>DariTani.co.id hadir sebagai katalog digital</strong> yang mempertemukan petani Malino secara langsung dengan pelaku usaha Horeka dan pedagang di Makassar. Setelah memilih produk di katalog, pembeli akan diarahkan langsung ke WhatsApp petani terkait untuk menyepakati pesanan — tanpa perantara, dan tanpa biaya untuk petani.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white border border-slate-200">
                            <i class="fa-solid fa-route text-brand-400 text-xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-sm text-slate-900">Langsung ke Petani</h4>
                                <p class="text-xs text-slate-500">Tanpa perantara tengkulak yang memotong harga.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-white border border-slate-200">
                            <i class="fa-solid fa-calendar-days text-brand-400 text-xl mt-1"></i>
                            <div>
                                <h4 class="font-bold text-sm text-slate-900">Info Musiman Panen</h4>
                                <p class="text-xs text-slate-500">Ketahui jadwal panen sebelum memesan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="fitur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-500 text-xs font-bold uppercase tracking-wider">
                    Keunggulan Platform
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Mengapa Memilih DariTani.co.id?
                </h2>
                <p class="text-slate-600 text-base">
                    Empat fungsi utama yang saling terhubung untuk mendukung kelancaran ekosistem perdagangan digital petani Malino.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-brand-400 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-brand-400/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Katalog Produk Segar</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Menampilkan hasil panen petani Malino lengkap dengan harga dan lokasi kebun, diperbarui secara berkala.
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-amber-500/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Profil Petani Mitra</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Setiap petani punya halaman profil sendiri untuk menampilkan produk dan informasi kebun secara transparan.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-emerald-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Pesan Langsung via WhatsApp</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Pilih produk, klik "Pesan Sekarang", sistem otomatis mengarahkan Anda ke WhatsApp petani terkait.
                    </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-indigo-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Info Musiman & Jadwal Panen</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Bantu pelaku usaha merencanakan kebutuhan pasokan dengan info musim panen yang diperbarui berkala.
                    </p>
                </div>

                <!-- Feature Card 5 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-rose-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-rose-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Fokus Pasar Horeka Makassar</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Dirancang khusus menjangkau hotel, restoran, kafe, dan pedagang sayur di Makassar yang butuh pasokan segar rutin.
                    </p>
                </div>

                <!-- Feature Card 6 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-400/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-teal-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Gratis untuk Petani</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Petani dapat mendaftar dan menampilkan produknya di katalog tanpa dipungut biaya sama sekali.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA SECTION -->
    <section id="cara-kerja" class="py-20 bg-brand-300 text-white relative overflow-hidden">
        <!-- Ambient background particles -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-300/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-500 text-brand-200 border border-brand-400 text-xs font-bold uppercase tracking-wider">
                    🌱 Cara Kerja DariTani.co.id
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-white leading-tight">
                    Empat Langkah Sederhana Menuju Petani Malino
                </h2>
                <p class="text-brand-200/90 text-base leading-relaxed">
                    Tanpa akun rumit, tanpa checkout berlapis — cukup pilih produk dan Anda langsung terhubung dengan petani lewat WhatsApp.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="glass-dark rounded-3xl p-6 border border-white/15 relative">
                    <span class="absolute -top-4 -left-2 font-heading font-extrabold text-5xl text-white/10">1</span>
                    <div class="w-12 h-12 rounded-2xl bg-brand-400 text-white flex items-center justify-center text-xl mb-4 relative z-10">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="font-bold text-base text-white mb-2 relative z-10">Jelajahi Katalog</h3>
                    <p class="text-xs text-brand-200/90 leading-relaxed relative z-10">Lihat daftar produk segar dari petani Malino lengkap dengan harga dan informasi kebun.</p>
                </div>

                <!-- Step 2 -->
                <div class="glass-dark rounded-3xl p-6 border border-white/15 relative">
                    <span class="absolute -top-4 -left-2 font-heading font-extrabold text-5xl text-white/10">2</span>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl mb-4 relative z-10">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                    <h3 class="font-bold text-base text-white mb-2 relative z-10">Klik "Pesan Sekarang"</h3>
                    <p class="text-xs text-brand-200/90 leading-relaxed relative z-10">Tentukan produk dan catatan pesanan (jumlah, kebutuhan khusus) yang Anda inginkan.</p>
                </div>

                <!-- Step 3 -->
                <div class="glass-dark rounded-3xl p-6 border border-white/15 relative">
                    <span class="absolute -top-4 -left-2 font-heading font-extrabold text-5xl text-white/10">3</span>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-xl mb-4 relative z-10">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="font-bold text-base text-white mb-2 relative z-10">Diarahkan ke WhatsApp</h3>
                    <p class="text-xs text-brand-200/90 leading-relaxed relative z-10">Sistem otomatis membuka WhatsApp dengan catatan pesanan Anda, langsung ke nomor petani terkait.</p>
                </div>

                <!-- Step 4 -->
                <div class="glass-dark rounded-3xl p-6 border border-white/15 relative">
                    <span class="absolute -top-4 -left-2 font-heading font-extrabold text-5xl text-white/10">4</span>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl mb-4 relative z-10">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h3 class="font-bold text-base text-white mb-2 relative z-10">Sepakati Langsung</h3>
                    <p class="text-xs text-brand-200/90 leading-relaxed relative z-10">Diskusikan detail, harga akhir, dan pengiriman langsung dengan petani — cepat dan tanpa perantara.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCE CATALOG SECTION -->
    <section id="katalog" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-500 text-xs font-bold uppercase tracking-wider">
                    Katalog Hasil Tani Malino
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Produk Pilihan Langsung dari Petani Malino
                </h2>
                <p class="text-slate-600 text-base">
                    Pilih produk yang Anda butuhkan, lalu klik "Pesan" untuk terhubung langsung dengan petani terkait via WhatsApp.
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap justify-center items-center gap-3 mb-12" id="category-tabs">
                <button onclick="filterCatalog('all', this)" class="category-btn active px-5 py-2.5 rounded-2xl font-semibold text-sm bg-brand-400 text-white shadow-md shadow-brand-400/20 transition-all">
                    🌱 Semua Produk
                </button>
                <button onclick="filterCatalog('sayur', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-100 transition-all">
                    🥬 Sayuran
                </button>
                <button onclick="filterCatalog('umbi', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-100 transition-all">
                    🥔 Umbi-umbian
                </button>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="product-grid">
                <div class="product-item umbi bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <svg viewBox="0 0 300 300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="300" fill="#fef3c7"/><ellipse cx="150" cy="165" rx="95" ry="70" fill="#c98f4f"/><ellipse cx="150" cy="150" rx="95" ry="70" fill="#dba86b"/><circle cx="120" cy="140" r="6" fill="#8a5a2b"/><circle cx="175" cy="130" r="5" fill="#8a5a2b"/><circle cx="160" cy="175" r="5" fill="#8a5a2b"/><circle cx="115" cy="175" r="4" fill="#8a5a2b"/></svg>
                            <span class="absolute top-4 left-4 bg-brand-400 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Umbi-umbian</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-400"></i>
                                <span>Malino, Kab. Gowa</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Komoditas Unggulan</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Kentang Malino</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Kentang segar hasil panen petani Malino, kualitas unggul untuk kebutuhan dapur restoran maupun rumah tangga.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 12.000</span>
                        </div>
                        <button onclick="openOrderModal('Kentang Malino', '12000', 'Malino, Kab. Gowa', '6281234567890')" class="bg-brand-400 hover:bg-brand-400 text-white p-3 rounded-2xl shadow-md shadow-brand-400/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
                <div class="product-item sayur bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <svg viewBox="0 0 300 300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="300" fill="#dcfce7"/><circle cx="150" cy="160" r="95" fill="#166534"/><circle cx="150" cy="160" r="78" fill="#22c55e"/><circle cx="150" cy="160" r="58" fill="#4ade80"/><circle cx="150" cy="160" r="34" fill="#86efac"/><path d="M150 102 q30 30 0 58 M150 102 q-30 30 0 58" stroke="#15803d" stroke-width="3" fill="none" opacity="0.5"/></svg>
                            <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Sayuran</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-400"></i>
                                <span>Malino, Kab. Gowa</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Panen Berkala</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Kubis Malino</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Kubis segar langsung dari kebun Malino, renyah dan cocok untuk berbagai olahan dapur Horeka.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 8.000</span>
                        </div>
                        <button onclick="openOrderModal('Kubis Malino', '8000', 'Malino, Kab. Gowa', '6281234567890')" class="bg-brand-400 hover:bg-brand-400 text-white p-3 rounded-2xl shadow-md shadow-brand-400/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
                <div class="product-item sayur bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <svg viewBox="0 0 300 300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="300" fill="#ecfccb"/><path d="M150 230 Q150 120 90 70 Q140 130 150 230 Z" fill="#4ade80"/><path d="M150 230 Q150 110 150 60 Q160 130 150 230 Z" fill="#22c55e"/><path d="M150 230 Q150 120 210 70 Q160 130 150 230 Z" fill="#4ade80"/><path d="M150 230 Q120 150 70 120 Q125 155 150 230 Z" fill="#86efac"/><path d="M150 230 Q180 150 230 120 Q175 155 150 230 Z" fill="#86efac"/><ellipse cx="150" cy="240" rx="18" ry="10" fill="#65a30d"/></svg>
                            <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Sayuran</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-400"></i>
                                <span>Malino, Kab. Gowa</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Panen Berkala</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Sawi Malino</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Sawi hijau segar hasil panen petani Malino, cocok untuk kebutuhan restoran maupun rumah tangga.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 7.000</span>
                        </div>
                        <button onclick="openOrderModal('Sawi Malino', '7000', 'Malino, Kab. Gowa', '6281234567890')" class="bg-brand-400 hover:bg-brand-400 text-white p-3 rounded-2xl shadow-md shadow-brand-400/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
                <div class="product-item sayur bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <svg viewBox="0 0 300 300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="300" fill="#fee2e2"/><circle cx="150" cy="170" r="80" fill="#dc2626"/><circle cx="150" cy="165" r="80" fill="#ef4444"/><ellipse cx="125" cy="140" rx="18" ry="12" fill="#f87171" opacity="0.7"/><path d="M150 90 l8 20 l22 2 l-17 15 l6 21 l-19 -12 l-19 12 l6 -21 l-17 -15 l22 -2 Z" fill="#16a34a"/><rect x="145" y="70" width="10" height="24" rx="4" fill="#15803d"/></svg>
                            <span class="absolute top-4 left-4 bg-rose-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Sayuran</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-400"></i>
                                <span>Malino, Kab. Gowa</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Dataran Tinggi</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Tomat Malino</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Tomat segar berkualitas dari dataran tinggi Malino, cocok untuk kebutuhan dapur Horeka dan pedagang.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 15.000</span>
                        </div>
                        <button onclick="openOrderModal('Tomat Malino', '15000', 'Malino, Kab. Gowa', '6281234567890')" class="bg-brand-400 hover:bg-brand-400 text-white p-3 rounded-2xl shadow-md shadow-brand-400/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
                <div class="product-item umbi bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <svg viewBox="0 0 300 300" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="300" fill="#ffedd5"/><path d="M150 260 L110 110 Q150 90 190 110 Z" fill="#f97316"/><path d="M150 260 L128 110 Q150 100 172 110 Z" fill="#fb923c"/><path d="M150 115 q-6 -30 -26 -42 q10 26 20 44 Z" fill="#22c55e"/><path d="M150 115 q0 -34 0 -50 q8 28 6 50 Z" fill="#16a34a"/><path d="M150 115 q6 -30 26 -42 q-10 26 -20 44 Z" fill="#22c55e"/><path d="M130 160 h40 M126 190 h48 M134 220 h32" stroke="#c2410c" stroke-width="3" opacity="0.4"/></svg>
                            <span class="absolute top-4 left-4 bg-amber-500 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Umbi-umbian</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-400"></i>
                                <span>Malino, Kab. Gowa</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Komoditas Unggulan</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Wortel Malino</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Wortel segar dari kebun Malino dengan warna cerah dan tekstur renyah, siap kirim ke Makassar.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 10.000</span>
                        </div>
                        <button onclick="openOrderModal('Wortel Malino', '10000', 'Malino, Kab. Gowa', '6281234567890')" class="bg-brand-400 hover:bg-brand-400 text-white p-3 rounded-2xl shadow-md shadow-brand-400/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center gap-2 font-bold text-brand-400 bg-white border border-brand-200 hover:bg-brand-100 px-8 py-3.5 rounded-2xl shadow-sm transition-all">
                    <span>Lihat Semua Produk</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FARMER PARTNERSHIP SECTION -->
    <section id="kemitraan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Story Content -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider">
                        🌱 Program Kemitraan Petani
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Bergabung Jadi Mitra Petani DariTani.co.id
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Kami menghubungkan petani Malino langsung dengan pelaku usaha Horeka dan pedagang di Makassar melalui katalog digital. Setiap petani mitra dapat menampilkan produknya tanpa dipungut biaya, dan menerima pesanan langsung melalui WhatsApp.
                    </p>

                    <!-- Benefit Box -->
                    <div class="p-6 rounded-3xl bg-brand-100/60 border border-brand-200">
                        <h4 class="font-bold text-sm text-slate-900 mb-3">Kenapa Petani Perlu Bergabung?</h4>
                        <ul class="space-y-2 text-sm text-slate-700">
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-brand-400 mt-1"></i><span>Gratis — tidak ada biaya pendaftaran maupun biaya bulanan.</span></li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-brand-400 mt-1"></i><span>Petani sendiri yang menentukan harga dan berkomunikasi langsung dengan pembeli.</span></li>
                            <li class="flex items-start gap-2"><i class="fa-solid fa-check text-brand-400 mt-1"></i><span>Jangkauan lebih luas ke pelaku usaha Horeka dan pedagang di Makassar.</span></li>
                        </ul>
                    </div>

                    <div class="pt-2">
                        <a href="#" class="inline-flex items-center gap-3 font-bold text-white bg-slate-900 hover:bg-slate-800 px-7 py-3.5 rounded-2xl shadow-lg transition-all">
                            <i class="fa-solid fa-handshake"></i>
                            <span>Daftar Jadi Mitra Petani</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual Impact Cards -->
                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-400 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Gratis Tanpa Biaya</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Tidak ada biaya pendaftaran maupun biaya bulanan untuk petani mitra.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Kontak Langsung ke Pembeli</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Pesanan masuk langsung ke WhatsApp Anda, tanpa perantara.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Produk Tampil di Katalog</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Profil dan produk Anda ditampilkan ke pelaku usaha Horeka dan pedagang di Makassar.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Info Musiman Terpublikasi</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Bantu pembeli merencanakan pesanan lewat info musim panen Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-500 text-xs font-bold uppercase tracking-wider">
                    FAQ
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Pertanyaan Yang Sering Diajukan
                </h2>
                <p class="text-slate-600 text-sm">Temukan jawaban atas pertanyaan populer seputar cara pemesanan dan kemitraan di DariTani.co.id.</p>
            </div>

            <div class="space-y-4" id="faq-accordion">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-400 transition-colors">
                        <span>Bagaimana cara memesan produk di DariTani.co.id?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Pilih produk yang Anda inginkan di halaman Katalog, lalu klik tombol "Pesan Sekarang". Sistem akan otomatis mengarahkan Anda ke WhatsApp petani terkait, lengkap dengan catatan produk yang Anda pilih.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-400 transition-colors">
                        <span>Apakah DariTani.co.id yang mengurus pengiriman produk?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Tidak. DariTani.co.id berperan sebagai katalog dan penghubung kontak. Proses pengiriman dan kesepakatan lebih lanjut diatur langsung antara Anda dan petani melalui WhatsApp.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-400 transition-colors">
                        <span>Apakah ada biaya untuk petani yang ingin bergabung?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Tidak ada. Petani dapat mendaftar dan menampilkan produknya di katalog tanpa dipungut biaya sama sekali.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-400 transition-colors">
                        <span>Apakah bisa memesan pasokan rutin untuk Restoran atau Hotel?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Bisa. Anda dapat menghubungi petani mitra langsung melalui WhatsApp untuk mendiskusikan kebutuhan pasokan rutin sesuai kesepakatan bersama.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION BANNER -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-gradient-to-r from-brand-500 via-brand-500 to-emerald-900 p-8 sm:p-14 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-brand-300/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="space-y-4 text-center lg:text-left">
                        <span class="bg-amber-400 text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Mulai Sekarang</span>
                        <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-white leading-tight">
                            Siap Terhubung Langsung dengan Petani Malino?
                        </h2>
                        <p class="text-brand-100 text-sm sm:text-base max-w-xl">
                            Baik Anda pelaku usaha Horeka yang mencari pasokan segar, maupun petani yang ingin bergabung — DariTani.co.id menghubungkan Anda langsung, tanpa perantara.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                        <a href="#katalog" class="text-center font-bold text-brand-500 bg-white hover:bg-brand-100 px-7 py-3.5 rounded-2xl shadow-lg transition-all">
                            Lihat Katalog Produk
                        </a>
                        <a href="#" class="text-center font-bold text-white bg-brand-400 hover:bg-brand-300 px-7 py-3.5 rounded-2xl shadow-lg transition-all">
                            Daftar Jadi Mitra Petani
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-slate-400 pt-16 pb-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand Info -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="#" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-brand-400 flex items-center justify-center text-white font-bold text-lg">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <span class="font-heading font-extrabold text-2xl text-white tracking-tight">Dari<span class="text-brand-300">Tani</span></span>
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        DariTani.co.id menghubungkan petani hortikultura Malino, Kabupaten Gowa langsung dengan pelaku usaha Horeka dan pedagang di Makassar — tanpa perantara, gratis untuk petani.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-400 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-400 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-400 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#beranda" class="hover:text-brand-300 transition-colors">Beranda Utama</a></li>
                        <li><a href="#tentang" class="hover:text-brand-300 transition-colors">Tentang DariTani</a></li>
                        <li><a href="#fitur" class="hover:text-brand-300 transition-colors">Fitur Utama</a></li>
                        <li><a href="#katalog" class="hover:text-brand-300 transition-colors">Katalog Produk</a></li>
                        <li><a href="#cara-kerja" class="hover:text-brand-300 transition-colors">Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Col 3: For Farmers & Partners -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Layanan Kemitraan</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="hover:text-brand-300 transition-colors">Pendaftaran Mitra Petani</a></li>
                        <li><a href="#kemitraan" class="hover:text-brand-300 transition-colors">Pasokan Rutin Horeka</a></li>
                        <li><a href="#" class="hover:text-brand-300 transition-colors">Portal Login Petani</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Office -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Kontak & Wilayah</h4>
                    <ul class="space-y-2.5 text-xs">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-brand-300 mt-0.5"></i>
                            <span>Malino, Kabupaten Gowa – Sulawesi Selatan</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-brand-300"></i>
                            <span>support@daritani.co.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; 2026 DariTani.co.id. Program Produk Kreatif dan Kewirausahaan — SMKIT Ibnul Qayyim Makassar.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-slate-400">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-slate-400">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ORDER / CONTACT MODAL POPUP -->
    <div id="order-modal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative animate-in fade-in zoom-in duration-200">
            <button onclick="closeOrderModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-400 flex items-center justify-center text-lg">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-lg text-slate-900">Pesan via WhatsApp</h3>
                    <p class="text-xs text-slate-500">Anda akan diarahkan langsung ke WhatsApp petani</p>
                </div>
            </div>

            <form onsubmit="submitOrder(event)" class="space-y-4">
                <div class="p-4 rounded-2xl bg-brand-100 border border-brand-200">
                    <p class="text-xs text-brand-500 font-semibold" id="modal-product-name">Produk: Kentang Malino</p>
                    <p class="text-xs text-slate-500" id="modal-product-farm">Lokasi: Malino, Kab. Gowa</p>
                    <p class="text-sm font-extrabold text-brand-500 mt-1" id="modal-product-price">Rp 12.000 / kg</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="order-name" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-300">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Pesanan (jumlah, kebutuhan khusus)</label>
                    <textarea id="order-note" required rows="3" placeholder="Contoh: 10 kg, untuk kebutuhan mingguan restoran" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-300"></textarea>
                </div>

                <p class="text-[11px] text-slate-400 leading-relaxed">Harga dan detail pesanan akan dikonfirmasi langsung bersama petani melalui WhatsApp.</p>

                <button type="submit" class="w-full bg-brand-400 hover:bg-brand-400 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-brand-400/30 transition-all flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Lanjut ke WhatsApp Petani</span>
                </button>
            </form>
        </div>
    </div>

    <!-- VIDEO TRAILER MODAL -->
    <div id="video-modal" class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-md flex items-center justify-center p-4">
        <div class="bg-black rounded-3xl max-w-3xl w-full p-4 relative shadow-2xl">
            <button onclick="closeVideoModal()" class="absolute -top-4 -right-4 text-white bg-slate-800 hover:bg-slate-700 w-10 h-10 rounded-full flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-900 flex items-center justify-center text-white">
                <div class="text-center p-6 space-y-3">
                    <i class="fa-solid fa-circle-play text-5xl text-brand-300 animate-pulse"></i>
                    <h3 class="font-heading font-bold text-xl text-white">Video Perkenalan DariTani.co.id</h3>
                    <p class="text-xs text-slate-400 max-w-md mx-auto">Kenalan dengan DariTani.co.id — katalog digital yang menghubungkan petani Malino langsung dengan pelaku usaha Horeka di Makassar.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 hidden glass-card p-4 rounded-2xl shadow-2xl border-l-4 border-brand-300 max-w-sm items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-400 flex items-center justify-center text-lg shrink-0">
            <i class="fa-solid fa-check"></i>
        </div>
        <div>
            <h4 class="font-bold text-xs text-slate-900" id="toast-title">Berhasil</h4>
            <p class="text-[11px] text-slate-500" id="toast-msg">Aksi berhasil dilakukan.</p>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        let currentProductName = '';
        let currentProductPrice = 0;
        let currentProductFarm = '';
        let currentFarmerPhone = '';

        // Mobile drawer navigation toggle
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-drawer');
            drawer.classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-btn').addEventListener('click', toggleMobileMenu);

        // Category catalog filter
        function filterCatalog(category, btnElement) {
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(b => {
                b.classList.remove('bg-brand-400', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-slate-700', 'border');
            });
            btnElement.classList.remove('bg-white', 'text-slate-700', 'border');
            btnElement.classList.add('bg-brand-400', 'text-white', 'shadow-md');

            const items = document.querySelectorAll('.product-item');
            items.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // FAQ accordion toggle
        function toggleFaq(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('i');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Order Modal Functions
        // NOTE: currentFarmerPhone is a placeholder number for this demo page.
        // When connected to the backend, replace it with each farmer's real
        // WhatsApp number pulled from the database (per product/petani).
        function openOrderModal(name, price, farm, phone) {
            currentProductName = name;
            currentProductPrice = parseInt(price);
            currentProductFarm = farm;
            currentFarmerPhone = phone;

            document.getElementById('modal-product-name').innerText = 'Produk: ' + name;
            document.getElementById('modal-product-farm').innerText = 'Lokasi: ' + farm;
            document.getElementById('modal-product-price').innerText = 'Rp ' + currentProductPrice.toLocaleString('id-ID') + ' / kg';
            document.getElementById('order-name').value = '';
            document.getElementById('order-note').value = '';
            document.getElementById('order-modal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('order-modal').classList.add('hidden');
        }

        // Builds a WhatsApp deep link pre-filled with the order note and
        // redirects the buyer straight to the farmer's WhatsApp number.
        function submitOrder(e) {
            e.preventDefault();
            const name = document.getElementById('order-name').value;
            const note = document.getElementById('order-note').value;

            const message = 'Halo, saya ' + name + ' dari DariTani.co.id.\n' +
                'Saya ingin memesan: ' + currentProductName + ' (' + currentProductFarm + ')\n' +
                'Catatan pesanan: ' + note;

            const waUrl = 'https://wa.me/' + currentFarmerPhone + '?text=' + encodeURIComponent(message);

            closeOrderModal();
            showToast('Mengarahkan ke WhatsApp...', 'Anda akan terhubung langsung dengan petani.');
            window.open(waUrl, '_blank');
        }

        // Video Modal
        function openVideoModal() {
            document.getElementById('video-modal').classList.remove('hidden');
        }
        function closeVideoModal() {
            document.getElementById('video-modal').classList.add('hidden');
        }

        // Toast Popup Helper
        function showToast(title, msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-title').innerText = title;
            document.getElementById('toast-msg').innerText = msg;

            toast.classList.remove('hidden');
            toast.classList.add('flex');

            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 4000);
        }
    </script>
</body>
</body>
</html>
