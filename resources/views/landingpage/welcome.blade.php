<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPALKOM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        syne: ['Syne', 'sans-serif'],
                        mono: ['"DM Mono"', 'monospace'],
                        sans: ['"DM Sans"', 'sans-serif']
                    },
                    colors: {
                        ink: '#0a0a0a',
                        ink2: '#1a1a2e',
                        paper: '#fafaf7',
                        cream: '#f5f0e8',
                        blue: {
                            DEFAULT: '#1640d4',
                            dark: '#0d2fa8',
                            light: '#dce8ff'
                        },
                        yellow: {
                            DEFAULT: '#f5c518',
                            dark: '#c49b00'
                        },
                        green: '#0ea95e'
                    },
                    boxShadow: {
                        hard: '5px 5px 0 #0a0a0a',
                        'hard-lg': '8px 8px 0 #0a0a0a',
                        'hard-sm': '3px 3px 0 #0a0a0a'
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth }
        ::-webkit-scrollbar { width: 8px }
        ::-webkit-scrollbar-track { background: #f5f0e8 }
        ::-webkit-scrollbar-thumb { background: #0a0a0a }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1) }
            50% { opacity: .6; transform: scale(.85) }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) }
            50% { transform: translateY(-12px) }
        }

        .pulse-anim { animation: pulse-dot 2s infinite }
        .float-anim { animation: float 4s ease-in-out infinite }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .5s ease, transform .5s ease;
        }
        .reveal.visible { opacity: 1; transform: none }

        .accent-underline { position: relative; display: inline-block }
        .accent-underline::after {
            content: '';
            position: absolute;
            bottom: 2px; left: 0; right: 0;
            height: 6px;
            background: #f5c518;
            z-index: -1;
        }

        .card { transition: all .15s ease }
        .card:hover { transform: translate(-2px,-2px); box-shadow: 8px 8px 0 #0a0a0a }
    </style>
</head>

<body class="font-sans bg-paper text-ink overflow-x-hidden">

    {{-- ======================== NAVBAR ======================== --}}
    <nav class="sticky top-0 z-[100] bg-blue border-b-[2.5px] border-ink">
        <div class="max-w-[1100px] mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#" class="bg-yellow border-2 border-ink shadow-hard-sm px-4 py-1.5 font-syne font-extrabold text-[13px] tracking-[.15em] text-ink no-underline">
                SIPALKOM
            </a>
            <div class="hidden md:flex gap-1">
                @foreach ([['#','Home'],['#about','About'],['#fitur','Fitur']] as [$href,$label])
                    <a href="{{ $href }}" class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">{{ $label }}</a>
                @endforeach
                <a href="{{ route('login') }}" class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Login</a>
            </div>
            <button class="md:hidden bg-yellow border-2 border-ink shadow-hard-sm p-[9px_11px] flex flex-col gap-[5px]" onclick="toggleMenu()" aria-label="Toggle menu">
                <span class="block w-5 h-[2.5px] bg-ink"></span>
                <span class="block w-5 h-[2.5px] bg-ink"></span>
                <span class="block w-5 h-[2.5px] bg-ink"></span>
            </button>
        </div>
        <div id="mob" class="hidden flex-col bg-blue border-t-2 border-ink px-4 pb-3.5 pt-2.5 gap-1.5">
            <a href="#" class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-yellow text-ink no-underline">Home</a>
            <a href="#about" onclick="toggleMenu()" class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">About</a>
            <a href="#fitur" onclick="toggleMenu()" class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">Fitur</a>
            <a href="{{ route('login') }}" class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-white/30 text-white no-underline">Login</a>
        </div>
    </nav>

    {{-- ======================== HERO ======================== --}}
    <section class="relative overflow-hidden" style="background-image:radial-gradient(rgba(22,64,212,.08) 1.5px,transparent 1.5px);background-size:28px 28px">
        <div class="max-w-[1100px] mx-auto px-6 py-16 flex flex-col lg:flex-row items-center gap-10">
            <div class="reveal flex-1">
                <div class="inline-flex items-center gap-2 font-mono text-[11px] uppercase tracking-[.12em] bg-blue-light border-2 border-ink px-3.5 py-1.5 mb-6">
                    <span class="w-[7px] h-[7px] rounded-full bg-green flex-shrink-0 pulse-anim"></span>
                    Sipalkom
                </div>
                <h1 class="font-syne font-extrabold text-[clamp(36px,5vw,64px)] leading-none tracking-tight text-ink2 mb-5">
                    Sistem Peminjaman<br>
                    <span class="text-blue accent-underline">Laboratorium Komputer</span>
                </h1>
                <div class="bg-yellow border-2 border-ink shadow-hard-sm font-syne font-bold text-[11px] uppercase tracking-[.1em] px-[18px] py-[7px] mb-5 inline-block">
                    Kelola · Pinjam · Pantau · Laporkan
                </div>
                <p class="text-base leading-[1.75] text-[#555] mb-8 max-w-[500px]">
                    Platform digital terintegrasi untuk pengelolaan aset lab komputer, peminjaman online, dan monitoring anggota.
                </p>
                <div class="flex flex-wrap gap-2 mb-8">
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-blue-light">Manajemen Aset</span>
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-[#fff8dc]">Peminjaman</span>
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-[#ffe8e8]">Data Anggota</span>
                    <span class="font-mono text-[11px] px-3.5 py-[5px] border-2 border-ink bg-white">Dashboard</span>
                </div>
            </div>
            <div class="reveal flex-1 flex justify-center lg:justify-end">
                <img src="{{ asset('images/komland.png') }}" alt="Ilustrasi SIPALKOM" class="w-full max-w-2xl float-anim p-2 lg:p-4">
            </div>
        </div>
    </section>

    {{-- ======================== STATS ======================== --}}
    <div style="border-top:2.5px solid #0a0a0a"></div>
    <section class="bg-paper py-14">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="reveal grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ([
                    ['bg-blue-light','bg-blue','ti-users',$activeMembers,'Anggota Aktif'],
                    ['bg-[#fff8dc]','bg-yellow-dark','ti-clipboard-list',$loanCount,'Paeminjaman'],
                    ['bg-[#e8f8f0]','bg-[#0d7a47]','ti-circle-check',$availableCount,'Aset Tersedia'],
                    ['bg-[#ffe8e8]','bg-[#c0392b]','ti-device-laptop',$assetCount,'Aset Tercatat'],
                ] as [$bg,$iconBg,$icon,$value,$label])
                    <div class="card {{ $bg }} border-[2.5px] border-ink shadow-hard p-7 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 {{ $iconBg }} border-2 border-ink flex items-center justify-center text-white text-2xl">
                            <i class="ti {{ $icon }}"></i>
                        </div>
                        <div class="font-syne font-extrabold text-[40px] text-ink2 leading-none">{{ $value }}</div>
                        <div class="font-mono text-[11px] uppercase tracking-[.08em] text-ink/60">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
         </div>
    </section>

    {{-- ======================== FITUR ======================== --}}
    <div style="border-top:2.5px solid #0a0a0a"></div>
    <section id="fitur" class="bg-paper py-20">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="font-mono text-[11px] uppercase text-blue mb-3 flex items-center gap-2">
                <span class="inline-block w-5 h-[2.5px] bg-blue"></span> Fitur Unggulan
            </div>
            <h2 class="reveal font-syne font-extrabold text-[clamp(28px,4vw,48px)] leading-[1.05] tracking-tight text-ink2 mb-10">
                Apa Yang Bisa Dilakukan?
            </h2>
            <div class="reveal grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ([
                    ['bg-blue-light','bg-blue','ti-device-laptop','Manajemen Aset','Catat dan pantau semua peralatan lab secara real-time.'],
                    ['bg-white','bg-blue','ti-clipboard-list','Peminjaman','Ajukan peminjaman online dan terima notifikasi persetujuan.'],
                    ['bg-[#fff8dc]','bg-yellow-dark','ti-users','Data Anggota','Kelola profil dan histori aktivitas anggota laboratorium.'],
                    ['bg-[#e8f8f0]','bg-[#0d7a47]','ti-chart-bar','Dashboard','Statistik dan laporan aktivitas lab dalam satu layar.'],
                ] as [$bg,$iconBg,$icon,$title,$desc])
                    <div class="card {{ $bg }} border-[2.5px] border-ink shadow-hard p-7">
                        <div class="w-11 h-11 {{ $iconBg }} border-2 border-ink flex items-center justify-center text-white text-xl mb-4">
                            <i class="ti {{ $icon }}"></i>
                        </div>
                        <div class="font-syne font-bold text-[13px] uppercase tracking-[.07em] mb-2">{{ $title }}</div>
                        <div class="text-[12.5px] leading-[1.65] text-[#555]">{{ $desc }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================== ABOUT ======================== --}}
    <div style="border-top:2.5px solid #0a0a0a"></div>
    <section id="about" class="bg-cream py-20">
        <div class="max-w-[1100px] mx-auto px-6">
            <div class="font-mono text-[11px] uppercase text-blue mb-3 flex items-center gap-2">
                <span class="inline-block w-5 h-[2.5px] bg-blue"></span> Tentang Kami
            </div>
            <h2 class="reveal font-syne font-extrabold text-[clamp(28px,4vw,48px)] leading-[1.05] tracking-tight text-ink2 mb-5">
                Apa Itu SIPALKOM?
            </h2>
            <p class="reveal text-[#555] text-[15px] leading-[1.8] mt-4 max-w-[680px]">
                SIPALKOM adalah sistem peminjaman alat laboratorium komputer berbasis web — mulai dari pencatatan aset, proses peminjaman, hingga manajemen data anggota secara terpusat.
            </p>
            <div class="reveal flex flex-col gap-5 mt-7 max-w-[680px]">
                @foreach ([
                    ['bg-yellow','ti-bolt','Cepat & Real-time','Data selalu diperbarui otomatis tanpa perlu refresh manual.'],
                    ['bg-blue-light','ti-shield-lock','Aman & Terpercaya','Autentikasi berlapis dengan role-based access control.'],
                    ['bg-[#ffe8e8]','ti-device-mobile','Responsif & Modern','Nyaman diakses dari laptop, tablet, maupun smartphone.'],
                ] as [$bg,$icon,$title,$desc])
                    <div class="flex gap-4 items-start">
                        <div class="w-11 h-11 flex-shrink-0 {{ $bg }} border-[2.5px] border-ink flex items-center justify-center text-xl shadow-hard-sm">
                            <i class="ti {{ $icon }}"></i>
                        </div>
                        <div>
                            <div class="font-syne font-bold text-[14px] mb-1">{{ $title }}</div>
                            <div class="text-[13px] text-[#555] leading-[1.7]">{{ $desc }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ======================== FOOTER ======================== --}}
    <footer class="bg-ink border-t-[3px] border-yellow">
        <div class="border-b border-white/[.07]">
            <div class="max-w-[1100px] mx-auto px-6 py-[18px]">
                <span class="font-mono text-[10px] uppercase text-white/25">© {{ date('Y') }} — Sistem Informasi Laboratorium Komputer</span>
            </div>
        </div>
        <div class="max-w-[1100px] mx-auto px-6 py-8 flex flex-wrap items-center justify-between gap-5">
            <div class="flex items-center gap-2 bg-yellow border-2 border-white/15 px-3 py-[5px]">
                <div class="w-2 h-2 rounded-full bg-ink"></div>
                <span class="font-syne font-extrabold text-[12px] tracking-[.15em] text-ink">SIPALKOM</span>
            </div>
            <span class="font-mono text-[11px] text-white/35">Laboratorium Komputer</span>
            <div class="flex items-center gap-1 flex-wrap">
                <a href="#" class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline"><i class="ti ti-home mr-1"></i>Home</a>
                <a href="#about" class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">About</a>
                <a href="#fitur" class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">Fitur</a>
                <a href="{{ route('login') }}" class="font-syne font-bold text-[11px] uppercase px-3.5 py-[7px] border border-white/12 text-white/50 hover:bg-yellow hover:text-ink transition-all no-underline">Login</a>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const m = document.getElementById('mob');
            m.classList.toggle('hidden');
            m.classList.toggle('flex');
        }
        document.addEventListener('click', e => {
            const m = document.getElementById('mob');
            const btn = document.querySelector('[aria-label="Toggle menu"]');
            if (!m.contains(e.target) && !btn.contains(e.target)) {
                m.classList.add('hidden');
                m.classList.remove('flex');
            }
        });
        const obs = new IntersectionObserver(
            entries => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible') }),
            { threshold: .1 }
        );
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>

</body>
</html>