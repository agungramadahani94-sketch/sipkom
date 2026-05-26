<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPALKOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { syne: ['Syne', 'sans-serif'], mono: ['"DM Mono"', 'monospace'], sans: ['"DM Sans"', 'sans-serif'] }, colors: { ink: '#0a0a0a', ink2: '#1a1a2e', paper: '#fafaf7', cream: '#f5f0e8', blue: { DEFAULT: '#1640d4', dark: '#0d2fa8', light: '#dce8ff' }, yellow: { DEFAULT: '#f5c518', dark: '#c49b00' }, green: '#0ea95e' }, boxShadow: { hard: '5px 5px 0 #0a0a0a', 'hard-lg': '8px 8px 0 #0a0a0a', 'hard-sm': '3px 3px 0 #0a0a0a' } } } }
    </script>
    <style>
        html {
            scroll-behavior: smooth
        }

        ::-webkit-scrollbar {
            width: 8px
        }

        ::-webkit-scrollbar-track {
            background: #f5f0e8
        }

        ::-webkit-scrollbar-thumb {
            background: #0a0a0a
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
                transform: scale(1)
            }

            50% {
                opacity: .6;
                transform: scale(.85)
            }
        }

        @keyframes ticker {
            from {
                transform: translateX(0)
            }

            to {
                transform: translateX(-50%)
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-12px)
            }
        }

        .pulse-anim {
            animation: pulse-dot 2s infinite
        }

        .ticker-anim {
            animation: ticker 24s linear infinite
        }

        .ticker-anim:hover {
            animation-play-state: paused
        }

        .float-anim {
            animation: float 4s ease-in-out infinite
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .5s ease, transform .5s ease
        }

        .reveal.visible {
            opacity: 1;
            transform: none
        }

        .accent-underline {
            position: relative;
            display: inline-block
        }

        .accent-underline::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 6px;
            background: #f5c518;
            z-index: -1
        }

        .card {
            transition: all .15s ease
        }

        .card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0 #0a0a0a
        }

        .stat::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #f5c518;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease
        }

        .stat:hover::before {
            transform: scaleX(1)
        }
    </style>
</head>

<body class="font-sans bg-paper text-ink overflow-x-hidden">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-[100] bg-blue border-b-[2.5px] border-ink">
        <div class="max-w-[1100px] mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#"
                class="bg-yellow border-2 border-ink shadow-hard-sm px-4 py-1.5 font-syne font-extrabold text-[13px] tracking-[.15em] text-ink no-underline">SIPALKOM</a>
            <div class="hidden md:flex gap-1">
                <a href="#"
                    class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Home</a>
                <a href="#about"
                    class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">About</a>
                <a href="#fitur"
                    class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Fitur</a>
                <a href="{{ route('login') }}"
                    class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Login</a>
            </div>
            <button class="md:hidden bg-yellow border-2 border-ink shadow-hard-sm p-[9px_11px] flex flex-col gap-[5px]"
                onclick="toggleMenu()">
                <span class="block w-5 h-[2.5px] bg-ink"></span>
                <span class="block w-5 h-[2.5px] bg-ink"></span>
                <span class="block w-5 h-[2.5px] bg-ink"></span>
            </button>
        </div>
        <div id="mob" class="hidden flex-col bg-blue border-t-2 border-ink px-4 pb-3.5 pt-2.5 gap-1.5">
            <a href="#"
                class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-yellow text-ink no-underline">Home</a>
            <a href="#about" onclick="toggleMenu()"
                class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">About</a>
            <a href="#fitur" onclick="toggleMenu()"
                class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">Fitur</a>
            <a href="{{ route('login') }}"
                class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-white/30 text-white no-underline">Login</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="relative overflow-hidden"
        style="background-image:radial-gradient(rgba(22,64,212,.08) 1.5px,transparent 1.5px);background-size:28px 28px">
        <div class="max-w-[1100px] mx-auto px-6 py-16 flex flex-col lg:flex-row items-center gap-10">

            <!-- Teks kiri -->
            <div class="reveal flex-1">
                <div
                    class="inline-flex items-center gap-2 font-mono text-[11px] uppercase tracking-[.12em] bg-blue-light border-2 border-ink px-3.5 py-1.5 mb-6">
                    <span class="w-[7px] h-[7px] rounded-full bg-green flex-shrink-0 pulse-anim"></span>
                    Sipalkom
                </div>
                <h1
                    class="font-syne font-extrabold text-[clamp(36px,5vw,64px)] leading-none tracking-tight text-ink2 mb-5">
                    Sistem Peminjaman<br>
                    <span class="text-blue accent-underline">Laboratorium Komputer</span>
                </h1>
                <div
                    class="bg-yellow border-2 border-ink shadow-hard-sm font-syne font-bold text-[11px] uppercase tracking-[.1em] px-[18px] py-[7px] mb-5 inline-block">
                    Kelola · Pinjam · Pantau · Laporkan
                </div>
                <p class="text-base leading-[1.75] text-[#555] mb-8 max-w-[500px]">
                    Platform digital terintegrasi untuk pengelolaan aset lab komputer, peminjaman online, dan monitoring
                    anggota.
                </p>
                <div class="flex flex-wrap gap-2 mb-8">
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-blue-light">Manajemen
                        Aset</span>
                    <span
                        class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-[#fff8dc]">Peminjaman</span>
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-[#ffe8e8]">Data
                        Anggota</span>
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-white">Dashboard</span>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="#about"
                        class="font-syne font-bold text-[13px] uppercase tracking-[.08em] px-7 py-3.5 border-[2.5px] border-ink shadow-hard bg-yellow text-ink no-underline inline-flex items-center gap-2 hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-hard-sm transition-all">
                        <i class="ti ti-info-circle"></i>Tentang Kami
                    </a>
                    <a href="#fitur"
                        class="font-syne font-bold text-[13px] uppercase tracking-[.08em] px-7 py-3.5 border-[2.5px] border-ink shadow-hard bg-white text-ink no-underline inline-flex items-center gap-2 hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-hard-sm transition-all">
                        <i class="ti ti-layout-grid"></i>Lihat Fitur
                    </a>
                </div>
            </div>

            <!-- Gambar kanan -->
            <div class="reveal flex-1 flex justify-center lg:justify-end">
                <img src="images/komland.png" alt="Ilustrasi SIPALKOM" class="w-full max-w-2xl float-anim p-2 lg:p-4">
            </div>

        </div>
    </section>

    <!-- TICKER -->
    <div class="bg-ink border-y-[2.5px] border-ink overflow-hidden py-[11px]">
        <div class="ticker-anim flex w-max">
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Manajemen Aset
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Peminjaman Online
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Dashboard Real-time
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Data Anggota
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Laporan Aktivitas
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Autentikasi Aman
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Manajemen Aset
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Peminjaman Online
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Dashboard Real-time
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Data User
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Laporan Aktivitas
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Notifikasi Otomatis
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Autentikasi Aman
            </div>
            <div class="flex items-center gap-2.5 px-7 text-white font-mono text-[11px] uppercase whitespace-nowrap">
                <div class="w-[5px] h-[5px] rounded-full bg-yellow"></div>Multi Divisi
            </div>
        </div>
    </div>

    <!-- FITUR -->
    <section id="fitur" class="bg-paper py-20">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="font-mono text-[11px] uppercase text-blue mb-3 flex items-center gap-2">
                <span class="inline-block w-5 h-[2.5px] bg-blue"></span>Fitur Unggulan
            </div>
            <h2
                class="reveal font-syne font-extrabold text-[clamp(28px,4vw,48px)] leading-[1.05] tracking-tight text-ink2 mb-10">
                Apa Yang Bisa Dilakukan?</h2>
            <div class="reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="card bg-blue-light border-[2.5px] border-ink shadow-hard p-7">
                    <div
                        class="w-11 h-11 bg-blue border-2 border-ink flex items-center justify-center text-white text-xl mb-4">
                        <i class="ti ti-device-laptop"></i></div>
                    <div class="font-syne font-bold text-[13px] uppercase tracking-[.07em] mb-2">Manajemen Aset</div>
                    <div class="text-[12.5px] leading-[1.65] text-[#555]">Catat dan pantau semua peralatan lab secara
                        real-time.</div>
                </div>
                <div class="card bg-white border-[2.5px] border-ink shadow-hard p-7">
                    <div
                        class="w-11 h-11 bg-blue border-2 border-ink flex items-center justify-center text-white text-xl mb-4">
                        <i class="ti ti-clipboard-list"></i></div>
                    <div class="font-syne font-bold text-[13px] uppercase tracking-[.07em] mb-2">Peminjaman</div>
                    <div class="text-[12.5px] leading-[1.65] text-[#555]">Ajukan peminjaman online dan terima notifikasi
                        persetujuan.</div>
                </div>
                <div class="card bg-[#fff8dc] border-[2.5px] border-ink shadow-hard p-7">
                    <div
                        class="w-11 h-11 bg-yellow-dark border-2 border-ink flex items-center justify-center text-white text-xl mb-4">
                        <i class="ti ti-users"></i></div>
                    <div class="font-syne font-bold text-[13px] uppercase tracking-[.07em] mb-2">Data Anggota</div>
                    <div class="text-[12.5px] leading-[1.65] text-[#555]">Kelola profil dan histori aktivitas anggota
                        laboratorium.</div>
                </div>
                <div class="card bg-[#e8f8f0] border-[2.5px] border-ink shadow-hard p-7">
                    <div
                        class="w-11 h-11 bg-[#0d7a47] border-2 border-ink flex items-center justify-center text-white text-xl mb-4">
                        <i class="ti ti-chart-bar"></i></div>
                    <div class="font-syne font-bold text-[13px] uppercase tracking-[.07em] mb-2">Dashboard</div>
                    <div class="text-[12.5px] leading-[1.65] text-[#555]">Statistik dan laporan aktivitas lab dalam satu
                        layar.</div>
                </div>
            </div>
        </div>
    </section>

    <div style="border-top:2.5px solid #0a0a0a"></div>

    <!-- ABOUT -->
    <section id="about" class="bg-cream py-20">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="font-mono text-[11px] uppercase text-blue mb-3 flex items-center gap-2">
                <span class="inline-block w-5 h-[2.5px] bg-blue"></span>Tentang Kami
            </div>
            <h2
                class="reveal font-syne font-extrabold text-[clamp(28px,4vw,48px)] leading-[1.05] tracking-tight text-ink2 mb-5">
                Apa Itu SIPALKOM?</h2>
            <p class="reveal text-[#555] text-[15px] leading-[1.8] mt-4 max-w-[680px]">
                SIPALKOM adalah sistem peminjaman alat laboratorium komputer berbasis web — mulai dari pencatatan aset,
                proses peminjaman, hingga manajemen data anggota secara terpusat.
            </p>
            <div class="reveal flex flex-col gap-5 mt-7 max-w-[680px]">
                <div class="flex gap-4 items-start">
                    <div
                        class="w-11 h-11 flex-shrink-0 border-[2.5px] border-ink flex items-center justify-center text-xl shadow-hard-sm bg-yellow">
                        <i class="ti ti-bolt"></i></div>
                    <div>
                        <div class="font-syne font-bold text-[14px] mb-1">Cepat &amp; Real-time</div>
                        <div class="text-[13px] text-[#555] leading-[1.7]">Data selalu diperbarui otomatis tanpa perlu
                            refresh manual.</div>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div
                        class="w-11 h-11 flex-shrink-0 border-[2.5px] border-ink flex items-center justify-center text-xl shadow-hard-sm bg-blue-light">
                        <i class="ti ti-shield-lock"></i></div>
                    <div>
                        <div class="font-syne font-bold text-[14px] mb-1">Aman &amp; Terpercaya</div>
                        <div class="text-[13px] text-[#555] leading-[1.7]">Autentikasi berlapis dengan role-based access
                            control.</div>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div
                        class="w-11 h-11 flex-shrink-0 border-[2.5px] border-ink flex items-center justify-center text-xl shadow-hard-sm bg-[#ffe8e8]">
                        <i class="ti ti-device-mobile"></i></div>
                    <div>
                        <div class="font-syne font-bold text-[14px] mb-1">Responsif &amp; Modern</div>
                        <div class="text-[13px] text-[#555] leading-[1.7]">Nyaman diakses dari laptop, tablet, maupun
                            smartphone.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div style="border-top:2.5px solid #0a0a0a"></div>

    <!-- STATS -->
    <section class="bg-ink2">
        <div class="reveal max-w-[1100px] mx-auto grid grid-cols-2 lg:grid-cols-4">
            <div
                class="stat relative overflow-hidden px-5 py-11 flex flex-col items-center gap-2.5 border-r border-white/10">
                <div class="w-11 h-11 border border-white/25 flex items-center justify-center text-yellow text-xl"><i
                        class="ti ti-users"></i></div>
                <div class="font-syne font-extrabold text-[34px] text-white leading-none">{{ $activeMembers }}</div>
                <div class="font-mono text-[10px] uppercase text-white/50 text-center">Anggota Aktif</div>
            </div>
            <div
                class="stat relative overflow-hidden px-5 py-11 flex flex-col items-center gap-2.5 lg:border-r border-white/10">
                <div class="w-11 h-11 border border-white/25 flex items-center justify-center text-yellow text-xl"><i
                        class="ti ti-clipboard-list"></i></div>
                <div class="font-syne font-extrabold text-[34px] text-white leading-none">{{ $loanCount }}</div>
                <div class="font-mono text-[10px] uppercase text-white/50 text-center">Peminjaman</div>
            </div>
            <div
                class="stat relative overflow-hidden px-5 py-11 flex flex-col items-center gap-2.5 border-r border-white/10">
                <div class="w-11 h-11 border border-white/25 flex items-center justify-center text-yellow text-xl"><i
                        class="ti ti-check"></i></div>
                <div class="font-syne font-extrabold text-[34px] text-white leading-none">{{ $availableCount }}</div>
                <div class="font-mono text-[10px] uppercase text-white/50 text-center">Aset Tersedia</div>
            </div>
            <div class="stat relative overflow-hidden px-5 py-11 flex flex-col items-center gap-2.5">
                <div class="w-11 h-11 border border-white/25 flex items-center justify-center text-yellow text-xl"><i
                        class="ti ti-laptop"></i></div>
                <div class="font-syne font-extrabold text-[34px] text-white leading-none">{{ $assetCount }}</div>
                <div class="font-mono text-[10px] uppercase text-white/50 text-center">Aset Tercatat</div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-ink border-t-[3px] border-yellow">
        <div class="border-b border-white/[.07]">
            <div class="max-w-[1100px] mx-auto px-6 py-[18px] flex flex-wrap items-center justify-between gap-4">
                <span class="font-mono text-[10px] uppercase text-white/25">© 2026 — Sistem Informasi Laboratorium
                    Komputer</span>
               
            </div>
        </div>
        <div class="max-w-[1100px] mx-auto px-6 py-8 flex flex-wrap items-center justify-between gap-5">
            <div class="flex items-center gap-2 bg-yellow border-2 border-white/15 px-3 py-[5px]">
                <div class="w-2 h-2 rounded-full bg-ink"></div>
                <span class="font-syne font-extrabold text-[12px] tracking-[.15em] text-ink">SIPALKOM</span>
            </div>
            <span class="font-mono text-[11px] text-white/35">Laboratorium Komputer</span>
            <div class="flex items-center gap-1 flex-wrap">
                <a href="#"
                    class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline"><i
                        class="ti ti-home mr-1"></i>Home</a>
                <a href="#about"
                    class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">About</a>
                <a href="#fitur"
                    class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">Fitur</a>
                <a href="{{ route('login') }}"
                    class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">Login</a>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() { const m = document.getElementById('mob'); m.classList.toggle('hidden'); m.classList.toggle('flex') }
        document.addEventListener('click', e => { const m = document.getElementById('mob'), b = document.querySelector('button'); if (!m.contains(e.target) && !b.contains(e.target)) { m.classList.add('hidden'); m.classList.remove('flex') } });
        const obs = new IntersectionObserver(entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible') }), { threshold: .1 });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
</body>

</html>