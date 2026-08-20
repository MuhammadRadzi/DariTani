<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DariTani — Platform Pertanian Digital & Hasil Panen Segar Indonesia</title>
    <meta name="description" content="DariTani me-revolusi rantai pasok pertanian Indonesia. Menghubungkan petani lokal langsung dengan konsumen, didukung teknologi Smart Farming IoT dan jaminan 100% segar.">
    <meta name="keywords" content="DariTani, pertanian digital, smart farming indonesia, sayur organik, buah segar, hasil panen langsung petani, marketplace pertanian">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome / CDN Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            dark: '#0B2B18',
                        },
                        amber: {
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
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
            background: rgba(11, 43, 24, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #15803d 0%, #22c55e 50%, #16a34a 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-gradient {
            background: radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.15) 0%, rgba(255, 255, 255, 0) 60%),
                        linear-gradient(180deg, #F4FBF7 0%, #FFFFFF 100%);
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
            background: #22c55e;
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
                @endauth
                <a href="#katalog" class="text-sm font-semibold bg-gradient-to-r from-brand-600 to-brand-500 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-brand-600/25 hover:shadow-brand-600/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-basket-shopping text-xs"></i>
                    <span>Belanja Panen</span>
                </a>
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
                @endauth
                <a href="#katalog" class="text-center font-semibold text-white bg-brand-600 py-3 rounded-xl shadow-md">Belanja Panen Sekarang</a>
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
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-200 text-brand-800 text-xs sm:text-sm font-semibold shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-pulse"></span>
                        <span>🌱 Revolusi Pertanian Digital #1 di Indonesia</span>
                        <i class="fa-solid fa-arrow-right text-xs text-brand-600"></i>
                    </div>

                    <!-- Headline -->
                    <h1 class="font-heading font-extrabold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.15] tracking-tight">
                        Menghubungkan Hasil Panen <span class="gradient-text">Segar & Organik</span> Langsung dari Petani
                    </h1>

                    <!-- Paragraph -->
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        DariTani memberdayakan ribuan petani lokal dengan teknologi Smart Farming IoT. Kami menjamin distribusi panen 100% alami, tanpa bahan pengawet, dan tiba di meja makan Anda dalam 24 jam.
                    </p>

                    <!-- CTAs -->
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

                    <!-- Trust Stats Footprint -->
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

                <!-- Right Hero Visual Showcase -->
                <div class="lg:col-span-5 relative">
                    <!-- Main Hero Image Container -->
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/15 border-4 border-white bg-slate-100 group">
                        <img src="{{ asset('images/hero_farmer_field.png') }}" alt="Sawah Pertanian Smart Farming DariTani" class="w-full h-[420px] sm:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent"></div>
                        
                        <!-- Overlay Farm Badge -->
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

                    <!-- Floating Badge Top Left -->
                    <div class="absolute -top-6 -left-6 z-20 glass-card p-4 rounded-2xl shadow-xl floating-anim hidden sm:flex items-center gap-3 max-w-[220px]">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div>
                            <p class="font-bold text-xs text-slate-900">100% Organik</p>
                            <p class="text-[10px] text-slate-500">Tersertifikasi Bebas Pestisida Kimia</p>
                        </div>
                    </div>

                    <!-- Floating Badge Bottom Right -->
                    <div class="absolute -bottom-6 -right-6 z-20 glass-card p-4 rounded-2xl shadow-xl hidden sm:flex items-center gap-3 max-w-[230px]">
                        <img src="{{ asset('images/happy_indonesian_farmer.png') }}" alt="Petani DariTani" class="w-12 h-12 rounded-xl object-cover border border-brand-300">
                        <div>
                            <p class="font-bold text-xs text-slate-900">Pak Suwandi</p>
                            <p class="text-[10px] text-brand-700 font-semibold">Mitra Kebun Bandung</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STATS COUNTER BAR -->
    <section class="bg-brand-900 text-white py-10 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-brand-400 text-3xl font-extrabold font-heading mb-1" id="count1">50.000+</div>
                    <div class="text-xs sm:text-sm text-brand-200">Ton Hasil Panen Terdistribusi</div>
                </div>
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1" id="count2">120+</div>
                    <div class="text-xs sm:text-sm text-brand-200">Desa Binaan Pertanian Digital</div>
                </div>
                <div class="p-4 border-r border-brand-800 last:border-0">
                    <div class="text-brand-400 text-3xl font-extrabold font-heading mb-1" id="count3">+45%</div>
                    <div class="text-xs sm:text-sm text-brand-200">Peningkatan Pendapatan Petani</div>
                </div>
                <div class="p-4">
                    <div class="text-amber-400 text-3xl font-extrabold font-heading mb-1" id="count4">99.4%</div>
                    <div class="text-xs sm:text-sm text-brand-200">Rating Kepuasan Konsumen</div>
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
                        <img src="{{ asset('images/fresh_produce_basket.png') }}" alt="Sayuran Organik Segar" class="w-full h-[380px] object-cover">
                    </div>
                    <div class="absolute -bottom-8 -left-6 z-20 w-3/5 rounded-2xl overflow-hidden shadow-2xl border-4 border-white hidden sm:block">
                        <img src="{{ asset('images/happy_indonesian_farmer.png') }}" alt="Petani Lokal Indonesia" class="w-full h-48 object-cover">
                    </div>
                </div>

                <!-- Right Text -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-800 text-xs font-bold uppercase tracking-wider">
                        Tentang DariTani
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Mengubah Masa Depan Pertanian Indonesia Melalui Teknologi & Keadilan Harga
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Di banyak daerah di Indonesia, petani lokal seringkali dihadapkan pada tengkulak dan rantai distribusi yang sangat panjang. Akibatnya, pendapatan petani tertekan sementara konsumen membayar harga mahal untuk produk yang sudah kurang segar.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        <strong>DariTani hadir sebagai solusi total.</strong> Melalui integrasi sensor IoT pertanian, transparansi harga pasar, serta platform langsung (direct-to-consumer), kami memangkas waktu distribusi sehingga Anda mendapatkan bahan pangan paling segar sekaligus memberikan kesejahteraan layak bagi pahlawan pangan nasional.
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
                                <h4 class="font-bold text-sm text-slate-900">Lacak Asal Kebun</h4>
                                <p class="text-xs text-slate-500">Ketahui siapa petani dan kapan dipanen.</p>
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
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-800 text-xs font-bold uppercase tracking-wider">
                    Keunggulan Ekosistem
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Mengapa Memilih DariTani?
                </h2>
                <p class="text-slate-600 text-base">
                    Inovasi teknologi yang kami hadirkan memberikan manfaat maksimal baik bagi konsumen rumah tangga, mitra bisnis, maupun komunitas petani lokal.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-brand-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-brand-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Langsung dari Kebun</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Dipetik langsung oleh petani setelah Anda memesan. Tanpa mengendap di gudang distributor berhari-hari.
                    </p>
                </div>

                <!-- Feature Card 2 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-amber-500/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Smart Farming IoT</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Kebun mitra kami dipantau dengan sensor tanah, cuaca presisi, & AI untuk menghasilkan panen berkualitas unggul.
                    </p>
                </div>

                <!-- Feature Card 3 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-emerald-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">100% Organik & Garansi</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Bebas Pestisida kimia berbahaya. Jika sayur tiba dalam kondisi tidak segar, kami ganti 100% tanpa ribet.
                    </p>
                </div>

                <!-- Feature Card 4 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-indigo-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Cold-Chain Express</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Armada distribusi terkontrol suhu menjaga kesegaran selada, tomat, dan buah sampai di pintu rumah Anda.
                    </p>
                </div>

                <!-- Feature Card 5 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-rose-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-rose-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Supply Horeca & Grosir</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Layanan pasokan rutin skala besar untuk Hotel, Restoran, & Katering dengan kontrak fleksibel dan harga khusus.
                    </p>
                </div>

                <!-- Feature Card 6 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:shadow-brand-600/10 hover:-translate-y-1 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-2xl mb-6 shadow-md shadow-teal-600/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-slate-900 mb-3">Pemberdayaan Desa</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Setiap transaksi mendanai pelatihan smart farming & fasilitas alat pertanian modern bagi kelompok tani lokal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SMART FARMING INTERACTIVE DEMO -->
    <section id="smart-tech" class="py-20 bg-brand-dark text-white relative overflow-hidden">
        <!-- Ambient background particles -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Description -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-800 text-brand-300 border border-brand-700 text-xs font-bold uppercase tracking-wider">
                        🛰️ Smart Agriculture Platform
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-white leading-tight">
                        Dashboard Pantau Kebun Real-Time
                    </h2>
                    <p class="text-brand-200/90 text-base leading-relaxed">
                        Setiap kebun mitra DariTani terhubung dengan sensor IoT presisi tinggi. Petani dan tim QC dapat memantau indikator vital tanaman langsung dari smartphone secara otomatis.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/5 border border-white/10">
                            <span class="text-sm font-semibold text-slate-200"><i class="fa-solid fa-droplet text-blue-400 mr-2"></i>Kelembaban Tanah Optimum</span>
                            <span class="text-xs bg-emerald-500/20 text-emerald-400 font-mono px-2.5 py-1 rounded-lg">75% - 85%</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/5 border border-white/10">
                            <span class="text-sm font-semibold text-slate-200"><i class="fa-solid fa-flask text-amber-400 mr-2"></i>Kandungan pH Tanah</span>
                            <span class="text-xs bg-amber-500/20 text-amber-400 font-mono px-2.5 py-1 rounded-lg">6.5 (Netral)</span>
                        </div>
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-white/5 border border-white/10">
                            <span class="text-sm font-semibold text-slate-200"><i class="fa-solid fa-sun text-yellow-400 mr-2"></i>Intensitas Cahaya Matahari</span>
                            <span class="text-xs bg-blue-500/20 text-blue-400 font-mono px-2.5 py-1 rounded-lg">Optimal 45.000 Lux</span>
                        </div>
                    </div>
                </div>

                <!-- Right Interactive Simulation Dashboard Widget -->
                <div class="lg:col-span-7">
                    <div class="glass-dark rounded-3xl p-6 sm:p-8 shadow-2xl border border-white/15">
                        <!-- Top Header Bar -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-white/10">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></div>
                                <div>
                                    <h3 class="font-bold text-base text-white">Stasiun Kebun Hidroponik #08</h3>
                                    <p class="text-xs text-brand-300">Lembang, Jawa Barat — Aktif Terhubung</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button onclick="toggleIrrigation()" id="irrigation-btn" class="text-xs font-semibold bg-emerald-600 hover:bg-emerald-500 text-white px-3.5 py-2 rounded-xl transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-faucet-drip"></i>
                                    <span id="irrigation-status">Irigasi: Otomatis</span>
                                </button>
                            </div>
                        </div>

                        <!-- Main Image & Sensor Metrics Grid -->
                        <div class="my-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Metric 1 -->
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors">
                                <p class="text-xs text-slate-400 mb-1">Kelembaban Saat Ini</p>
                                <p class="font-heading font-extrabold text-3xl text-emerald-400" id="live-humidity">78%</p>
                                <div class="w-full bg-slate-700 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-emerald-400 h-full rounded-full transition-all duration-500" style="width: 78%" id="bar-humidity"></div>
                                </div>
                            </div>
                            <!-- Metric 2 -->
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors">
                                <p class="text-xs text-slate-400 mb-1">Suhu Udara Kebun</p>
                                <p class="font-heading font-extrabold text-3xl text-amber-400" id="live-temp">24.5°C</p>
                                <div class="w-full bg-slate-700 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-amber-400 h-full rounded-full transition-all duration-500" style="width: 62%" id="bar-temp"></div>
                                </div>
                            </div>
                            <!-- Metric 3 -->
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition-colors">
                                <p class="text-xs text-slate-400 mb-1">Kualitas Nutrisi (EC)</p>
                                <p class="font-heading font-extrabold text-3xl text-blue-400">1.8 mS</p>
                                <div class="w-full bg-slate-700 h-1.5 rounded-full mt-3 overflow-hidden">
                                    <div class="bg-blue-400 h-full rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Tech Image Banner -->
                        <div class="relative rounded-2xl overflow-hidden border border-white/10 h-44">
                            <img src="{{ asset('images/smart_farming_tech.png') }}" alt="Smart Farming Greenhouse" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-brand-900/90 via-brand-900/40 to-transparent p-4 flex flex-col justify-end">
                                <span class="text-xs text-brand-300 font-mono">Prediksi AI Harvest</span>
                                <p class="text-white font-bold text-sm sm:text-base">Tomat Cherry Organik Siap Dipetik Dalam 48 Jam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCE CATALOG SECTION -->
    <section id="katalog" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-800 text-xs font-bold uppercase tracking-wider">
                    Katalog Segar Panen Hari Ini
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Produk Pilihan Terbaik Dari Kebun Mitra
                </h2>
                <p class="text-slate-600 text-base">
                    Pilih sayuran segar, buah-buahan organik, dan beras kualitas terbaik yang langsung dipetik setelah pesanan Anda terkonfirmasi.
                </p>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap justify-center items-center gap-3 mb-12" id="category-tabs">
                <button onclick="filterCatalog('all', this)" class="category-btn active px-5 py-2.5 rounded-2xl font-semibold text-sm bg-brand-600 text-white shadow-md shadow-brand-600/20 transition-all">
                    🌱 Semua Produk
                </button>
                <button onclick="filterCatalog('sayur', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-50 transition-all">
                    🥬 Sayur Organik
                </button>
                <button onclick="filterCatalog('buah', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-50 transition-all">
                    🍎 Buah Segar
                </button>
                <button onclick="filterCatalog('beras', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-50 transition-all">
                    🌾 Beras & Biji-bijian
                </button>
                <button onclick="filterCatalog('rempah', this)" class="category-btn px-5 py-2.5 rounded-2xl font-semibold text-sm bg-white text-slate-700 border border-slate-200 hover:bg-brand-50 transition-all">
                    🌶️ Rempah Nusantara
                </button>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="product-grid">
                <!-- Product Card 1 -->
                <div class="product-item sayur bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/fresh_produce_basket.png') }}" alt="Tomat Red Ruby Organik" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-brand-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">100% Organik</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>4.9</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Kebun Ciwidey, Bandung</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Panen Tadi Pagi</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Tomat Red Ruby Organik</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Tomat segar kaya likopen dipetik saat tingkat kematangan optimal tanpa bahan pestisida.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 18.500</span>
                        </div>
                        <button onclick="openOrderModal('Tomat Red Ruby Organik', '18500', 'Kebun Ciwidey, Bandung')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-item sayur bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/hero_farmer_field.png') }}" alt="Selada Romaine Hydroponic" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Crispy Fresh</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>5.0</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Kebun Lembang, Barat</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Bebas Pestisida</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Selada Romaine Hydroponic</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Renyah manis alami dari instalasi hydroponic berbasis IoT terstandar ekspor.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 500g</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 14.000</span>
                        </div>
                        <button onclick="openOrderModal('Selada Romaine Hydroponic', '14000', 'Kebun Lembang, Jawa Barat')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-item buah bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/fresh_produce_basket.png') }}" alt="Melon Golden Super Sweet" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-amber-500 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Super Sweet</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>4.8</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Kebun Malang, Jawa Timur</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Tingkat Manis 14 Brix</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Melon Golden Apollo</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Melon berkulit kuning keemasan dengan daging buah renyah dan kadar gula tinggi alami.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per buah (1.5kg)</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 35.000</span>
                        </div>
                        <button onclick="openOrderModal('Melon Golden Apollo', '35000', 'Kebun Malang, Jawa Timur')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-item beras bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/smart_farming_tech.png') }}" alt="Beras Pandan Wangi Premium" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-brand-800 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Beras Asli Cianjur</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>4.9</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Cianjur, Jawa Barat</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Pandan Alami</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Beras Pandan Wangi Organik</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Beras lokal asli Cianjur dengan aroma pandan alami tanpa pemutih maupun pengawet.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 5 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 82.000</span>
                        </div>
                        <button onclick="openOrderModal('Beras Pandan Wangi Organik', '82000', 'Cianjur, Jawa Barat')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>

                <!-- Product Card 5 -->
                <div class="product-item rempah bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/fresh_produce_basket.png') }}" alt="Jahe Merah Super" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-rose-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Rempah Herbal</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>4.9</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Wonogiri, Jawa Tengah</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Tinggi Essential Oil</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Jahe Merah Super Organik</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Rimpang jahe merah segar dengan kandungan atsiri pekat untuk menjaga imunitas tubuh.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 28.000</span>
                        </div>
                        <button onclick="openOrderModal('Jahe Merah Super Organik', '28000', 'Wonogiri, Jawa Tengah')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>

                <!-- Product Card 6 -->
                <div class="product-item buah bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 bg-slate-100 overflow-hidden group">
                            <img src="{{ asset('images/happy_indonesian_farmer.png') }}" alt="Alpukat Mentega Super" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <span class="absolute top-4 left-4 bg-brand-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">Lokal Grade A</span>
                            <span class="absolute top-4 right-4 bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow"><i class="fa-solid fa-star text-xs mr-1"></i>5.0</span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-2">
                                <i class="fa-solid fa-location-dot text-brand-600"></i>
                                <span>Kebun Garut, Jawa Barat</span>
                                <span class="mx-1">•</span>
                                <span class="text-emerald-700 font-semibold">Daging Tebal Pulen</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-slate-900 mb-1">Alpukat Mentega Garut</h3>
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2">Alpukat tekstur creamy tanpa serat hitam, dipetik tua pohon untuk pematangan sempurna.</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 block">Harga per 1 kg</span>
                            <span class="font-heading font-extrabold text-xl text-slate-900">Rp 32.500</span>
                        </div>
                        <button onclick="openOrderModal('Alpukat Mentega Garut', '32500', 'Kebun Garut, Jawa Barat')" class="bg-brand-600 hover:bg-brand-700 text-white p-3 rounded-2xl shadow-md shadow-brand-600/20 transition-all">
                            <i class="fa-solid fa-plus"></i> Pesan
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('user.index') }}" class="inline-flex items-center gap-2 font-bold text-brand-700 bg-white border border-brand-200 hover:bg-brand-50 px-8 py-3.5 rounded-2xl shadow-sm transition-all">
                    <span>Lihat Semua 150+ Hasil Panen</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FARMER PARTNERSHIP / IMPACT STORIES -->
    <section id="kemitraan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Story Content -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider">
                        🌱 Program Kemitraan Petani
                    </div>
                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Tumbuh Bersama 15.000+ Pahlawan Pangan Indonesia
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Kami tidak hanya menjual hasil panen, tetapi juga membangun ekosistem keberlanjutan. Setiap petani yang bergabung dengan DariTani mendapatkan akses edukasi pertanian modern, peralatan IoT gratis, dan jaminan pembelian hasil panen (*offtaker*).
                    </p>

                    <!-- Quote Box -->
                    <div class="p-6 rounded-3xl bg-brand-50/60 border border-brand-200 relative">
                        <i class="fa-solid fa-quote-left text-3xl text-brand-300 absolute top-4 left-4 pointer-events-none"></i>
                        <p class="text-sm text-slate-700 italic relative z-10 pl-6 mb-4">
                            "Sebelum bergabung dengan DariTani, hasil cabai dan selada saya sering dibeli murah oleh tengkulak. Sekarang harga transparan, ada sensor cuaca di sawah, dan pendapatan kelompok tani kami naik lebih dari 40%."
                        </p>
                        <div class="flex items-center gap-3 pl-6">
                            <img src="{{ asset('images/happy_indonesian_farmer.png') }}" alt="Pak Suwandi" class="w-10 h-10 rounded-full object-cover border border-brand-400">
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">Pak Suwandi Rahardjo</h4>
                                <p class="text-[11px] text-brand-700">Ketua Kelompok Tani Ciwidey Sejahtera</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-3 font-bold text-white bg-slate-900 hover:bg-slate-800 px-7 py-3.5 rounded-2xl shadow-lg transition-all">
                            <i class="fa-solid fa-handshake"></i>
                            <span>Daftar Jadi Mitra Petani</span>
                        </a>
                    </div>
                </div>

                <!-- Right Visual Impact Cards -->
                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-brand-100 text-brand-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Penghasilan Stabil</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Kepastian harga beli awal musim membuat petani dapat merencanakan modal tanpa takut fluktuasi ekstrem.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-seedling"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Bibit & Pupuk Organik</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Bantuan sarana produksi pertanian ramah lingkungan untuk meningkatkan kualitas hasil panen.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Akademi Smart Farming</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Pelatihan berkala penggunaan teknologi sensor, irigasi tetes, dan manajemen lahan digital.</p>
                    </div>

                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200">
                        <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl mb-4">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <h3 class="font-bold text-base text-slate-900 mb-2">Aplikasi Khusus Petani</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Aplikasi simpel ramah pengguna untuk mencatat tanggal tanam, meminta bantuan tim ahli, & mencairkan hasil penjualan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100 text-brand-800 text-xs font-bold uppercase tracking-wider">
                    FAQ
                </div>
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Pertanyaan Yang Sering Diajukan
                </h2>
                <p class="text-slate-600 text-sm">Temukan jawaban atas pertanyaan populer seputar pengiriman, kesegaran, dan kemitraan DariTani.</p>
            </div>

            <div class="space-y-4" id="faq-accordion">
                <!-- FAQ Item 1 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-600 transition-colors">
                        <span>Bagaimana DariTani menjamin produk tiba dalam kondisi segar?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Produk hanya dipetik dari kebun mitra setelah Anda mengonfirmasi pesanan. Kami menggunakan armada logistik pendingin terkontrol (*Cold-Chain Express*) sehingga suhu tetap terjaga dari kebun hingga ke pintu rumah Anda dalam kurun waktu kurang dari 24 jam.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-600 transition-colors">
                        <span>Apakah sayur dan buah di DariTani 100% Organik?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Ya, seluruh produk berkategori Organik diproduksi tanpa menggunakan pestisida sintetis maupun pupuk kimia berbahaya. Lahan mitra kami diverifikasi berkala dan dilengkapi sertifikasi resmi serta fitur QR Code pelacakan kebun.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-600 transition-colors">
                        <span>Bagaimana jika ada sayuran yang rusak saat pengiriman?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Kami memiliki Garansi Kesegaran 100%. Cukup foto produk yang rusak dan kirimkan ke WhatsApp layanan pelanggan kami dalam 12 jam setelah penerimaan. Kami akan mengganti uang Anda atau mengirimkan ulang tanpa biaya tambahan.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <button onclick="toggleFaq(this)" class="w-full p-5 text-left font-bold text-slate-900 flex justify-between items-center gap-4 hover:text-brand-600 transition-colors">
                        <span>Apakah bisa memesan pasokan rutin untuk Restoran atau Hotel?</span>
                        <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Sangat bisa! Kami memiliki divisi B2B Horeca yang siap melayani kontrak pengiriman harian/mingguan dengan kuantitas besar, invoice fleksibel, dan potongan harga khusus mitra usaha katering & restoran.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION BANNER -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-gradient-to-r from-brand-900 via-brand-800 to-emerald-900 p-8 sm:p-14 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="bg-amber-400 text-slate-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Voucher Panen Pertama</span>
                        <h2 class="font-heading font-extrabold text-3xl sm:text-4xl text-white leading-tight">
                            Nikmati Diskonto 20% & Gratis Ongkir Sekarang!
                        </h2>
                        <p class="text-brand-100 text-sm sm:text-base max-w-xl">
                            Daftarkan email Anda untuk mendapatkan buletin mingguan rekomendasi resep masakan sehat dan promo panen raya segar dari petani lokal.
                        </p>
                        
                        <!-- Newsletter Form -->
                        <form onsubmit="handleSubscribe(event)" class="flex flex-col sm:flex-row gap-3 pt-2 max-w-md">
                            <input type="email" id="newsletter-email" required placeholder="Masukkan alamat email Anda..." class="px-5 py-3.5 rounded-2xl bg-white/10 border border-white/20 text-white placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-brand-400 flex-1">
                            <button type="submit" class="bg-brand-500 hover:bg-brand-400 text-slate-950 font-bold px-6 py-3.5 rounded-2xl transition-colors shadow-lg">
                                Dapatkan Promo
                            </button>
                        </form>
                    </div>

                    <div class="lg:col-span-4 flex flex-col items-center justify-center text-center space-y-4 border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-8">
                        <p class="text-xs font-semibold text-brand-200 uppercase tracking-wider">Unduh Aplikasi Mobile</p>
                        <div class="flex flex-row lg:flex-col gap-3 w-full max-w-[200px]">
                            <button onclick="showAppToast('Google Play')" class="w-full bg-slate-950 border border-white/20 hover:bg-slate-900 text-white p-3 rounded-xl flex items-center justify-center gap-3 text-left">
                                <i class="fa-brands fa-google-play text-xl text-emerald-400"></i>
                                <div>
                                    <span class="text-[9px] text-slate-400 uppercase block">GET IT ON</span>
                                    <span class="text-xs font-bold text-white block leading-none">Google Play</span>
                                </div>
                            </button>
                            <button onclick="showAppToast('App Store')" class="w-full bg-slate-950 border border-white/20 hover:bg-slate-900 text-white p-3 rounded-xl flex items-center justify-center gap-3 text-left">
                                <i class="fa-brands fa-apple text-xl text-white"></i>
                                <div>
                                    <span class="text-[9px] text-slate-400 uppercase block">DOWNLOAD ON THE</span>
                                    <span class="text-xs font-bold text-white block leading-none">App Store</span>
                                </div>
                            </button>
                        </div>
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
                        <div class="w-10 h-10 rounded-2xl bg-brand-600 flex items-center justify-center text-white font-bold text-lg">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <span class="font-heading font-extrabold text-2xl text-white tracking-tight">Dari<span class="text-brand-500">Tani</span></span>
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        DariTani adalah pionir ekosistem pertanian digital terpadu di Indonesia. Menghubungkan petani lokal dengan konsumen secara transparan, adil, dan didukung teknologi Smart Farming IoT.
                    </p>
                    <div class="flex items-center gap-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-900 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#beranda" class="hover:text-brand-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="#tentang" class="hover:text-brand-400 transition-colors">Tentang DariTani</a></li>
                        <li><a href="#fitur" class="hover:text-brand-400 transition-colors">Ekosistem & Fitur</a></li>
                        <li><a href="#katalog" class="hover:text-brand-400 transition-colors">Katalog Sayur & Buah</a></li>
                        <li><a href="#smart-tech" class="hover:text-brand-400 transition-colors">Smart Agriculture IoT</a></li>
                    </ul>
                </div>

                <!-- Col 3: For Farmers & Partners -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Layanan Kemitraan</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('register') }}" class="hover:text-brand-400 transition-colors">Pendaftaran Mitra Petani</a></li>
                        <li><a href="#kemitraan" class="hover:text-brand-400 transition-colors">Pasokan Restoran & Horeca</a></li>
                        <li><a href="#kemitraan" class="hover:text-brand-400 transition-colors">Investasi Alat Pertanian</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-brand-400 transition-colors">Portal Login Petani</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Office -->
                <div class="space-y-3">
                    <h4 class="font-heading font-bold text-sm text-white uppercase tracking-wider">Kontak & Operasional</h4>
                    <ul class="space-y-2.5 text-xs">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-brand-500 mt-0.5"></i>
                            <span>Gedung Agrotech Tower Lt. 5, Jl. Ir. H. Juanda No. 120, Bandung</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-brand-500"></i>
                            <span>(022) 8765-4321</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-brand-500"></i>
                            <span>support@daritani.co.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; 2026 DariTani Indonesia. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-slate-400">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-slate-400">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-slate-400">Peta Situs</a>
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
                <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-lg text-slate-900">Form Pemesanan Panen</h3>
                    <p class="text-xs text-slate-500">Langsung dikonfirmasi ke Petani Mitra</p>
                </div>
            </div>

            <form onsubmit="submitOrder(event)" class="space-y-4">
                <div class="p-4 rounded-2xl bg-brand-50 border border-brand-200">
                    <p class="text-xs text-brand-800 font-semibold" id="modal-product-name">Produk: Tomat Red Ruby Organik</p>
                    <p class="text-xs text-slate-500" id="modal-product-farm">Lokasi: Kebun Ciwidey, Bandung</p>
                    <p class="text-sm font-extrabold text-brand-900 mt-1" id="modal-product-price">Rp 18.500 / kg</p>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp</label>
                    <input type="tel" required placeholder="0812xxxxxxx" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jumlah Pesanan (kg/pack)</label>
                        <input type="number" id="order-qty" value="2" min="1" oninput="calculateTotal()" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Total Biaya (Estimasi)</label>
                        <input type="text" id="order-total" readonly value="Rp 37.000" class="w-full px-4 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-sm font-bold text-slate-900">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Pengiriman</label>
                    <textarea required rows="2" placeholder="Jalan, No. Rumah, Kecamatan, Kota..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-brand-500"></textarea>
                </div>

                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-brand-600/30 transition-all flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Kirim Pesanan via WhatsApp</span>
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
                    <i class="fa-solid fa-circle-play text-5xl text-brand-500 animate-pulse"></i>
                    <h3 class="font-heading font-bold text-xl text-white">Dokumenter Smart Farming DariTani</h3>
                    <p class="text-xs text-slate-400 max-w-md mx-auto">Menyaksikan bagaimana sensor IoT dan distribusi dingin membantu puluhan ribu petani lokal di Bandung & Malang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION CONTAINER -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 hidden glass-card p-4 rounded-2xl shadow-2xl border-l-4 border-brand-500 max-w-sm items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-brand-100 text-brand-600 flex items-center justify-center text-lg shrink-0">
            <i class="fa-solid fa-check"></i>
        </div>
        <div>
            <h4 class="font-bold text-xs text-slate-900" id="toast-title">Berhasil</h4>
            <p class="text-[11px] text-slate-500" id="toast-msg">Kode promo berhasil disalin!</p>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        let currentPriceUnit = 18500;

        // Mobile drawer navigation toggle
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-drawer');
            drawer.classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-btn').addEventListener('click', toggleMobileMenu);

        // Copy Promo Code
        function copyPromo() {
            navigator.clipboard.writeText('DARITANISEGAR');
            showToast('Kode Voucher Disalin!', 'Gunakan DARITANISEGAR saat checkout untuk diskon 20%.');
        }

        // Category catalog filter
        function filterCatalog(category, btnElement) {
            const buttons = document.querySelectorAll('.category-btn');
            buttons.forEach(b => {
                b.classList.remove('bg-brand-600', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'text-slate-700', 'border');
            });
            btnElement.classList.remove('bg-white', 'text-slate-700', 'border');
            btnElement.classList.add('bg-brand-600', 'text-white', 'shadow-md');

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

        // Smart Farming Live Simulation
        let isIrrigating = true;
        function toggleIrrigation() {
            isIrrigating = !isIrrigating;
            const btn = document.getElementById('irrigation-btn');
            const statusText = document.getElementById('irrigation-status');
            const humidityText = document.getElementById('live-humidity');
            const humidityBar = document.getElementById('bar-humidity');

            if (isIrrigating) {
                btn.className = 'text-xs font-semibold bg-emerald-600 hover:bg-emerald-500 text-white px-3.5 py-2 rounded-xl transition-all flex items-center gap-2';
                statusText.innerText = 'Irigasi: Otomatis (Menyiram)';
                humidityText.innerText = '82%';
                humidityBar.style.width = '82%';
                showToast('Sensor Irigasi Aktif', 'Penyiraman presisi otomatis sedang menyemprotkan nutrisi.');
            } else {
                btn.className = 'text-xs font-semibold bg-slate-700 hover:bg-slate-600 text-slate-200 px-3.5 py-2 rounded-xl transition-all flex items-center gap-2';
                statusText.innerText = 'Irigasi: Dimatikan (Manual)';
                humidityText.innerText = '65%';
                humidityBar.style.width = '65%';
                showToast('Sensor Irigasi Nonaktif', 'Mode penyiraman manual diaktifkan.');
            }
        }

        // Order Modal Functions
        function openOrderModal(name, price, farm) {
            currentPriceUnit = parseInt(price);
            document.getElementById('modal-product-name').innerText = 'Produk: ' + name;
            document.getElementById('modal-product-farm').innerText = 'Lokasi: ' + farm;
            document.getElementById('modal-product-price').innerText = 'Rp ' + currentPriceUnit.toLocaleString('id-ID');
            document.getElementById('order-qty').value = 1;
            calculateTotal();
            document.getElementById('order-modal').classList.remove('hidden');
        }

        function closeOrderModal() {
            document.getElementById('order-modal').classList.add('hidden');
        }

        function calculateTotal() {
            const qty = parseInt(document.getElementById('order-qty').value) || 1;
            const total = qty * currentPriceUnit;
            document.getElementById('order-total').value = 'Rp ' + total.toLocaleString('id-ID');
        }

        function submitOrder(e) {
            e.preventDefault();
            closeOrderModal();
            showToast('Pesanan Terkirim!', 'Tim DariTani akan menghubungi Anda via WhatsApp untuk konfirmasi pengiriman.');
        }

        // Video Modal
        function openVideoModal() {
            document.getElementById('video-modal').classList.remove('hidden');
        }
        function closeVideoModal() {
            document.getElementById('video-modal').classList.add('hidden');
        }

        // Newsletter Subscription
        function handleSubscribe(e) {
            e.preventDefault();
            const email = document.getElementById('newsletter-email').value;
            showToast('Terima Kasih!', 'Voucher 20% telah dikirim ke ' + email);
            document.getElementById('newsletter-email').value = '';
        }

        function showAppToast(store) {
            showToast('Aplikasi ' + store, 'Versi mobile app sedang diproses untuk peluncuran resmi.');
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
</html>
