<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIPALKOM | Laboratorium Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #020617;
        }
        
        .glass-nav {
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Gradient Latar Belakang yang Lebih Halus */
        .hero-bg {
            background: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(79, 70, 229, 0.1) 0%, transparent 50%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glow-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .glow-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.1);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            box-shadow: 0 10px 20px -10px rgba(37, 99, 235, 0.5);
        }
    </style>
</head>

<body class="text-slate-300 selection:bg-blue-500/30">

    <!-- ===== NAVBAR ===== -->
    <nav class="fixed w-full top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-900/40 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black text-white tracking-tight leading-none">SIPALKOM</span>
                    <span class="text-[9px] uppercase tracking-[0.3em] text-blue-400 font-bold mt-1">Digital Laboratory</span>
                </div>
            </div>
            
            <div class="hidden md:flex items-center gap-10">
                <div class="flex gap-8">
                    <a href="#hero" class="text-sm font-medium hover:text-blue-400 transition-colors">Beranda</a>
                    <a href="#fitur" class="text-sm font-medium hover:text-blue-400 transition-colors">Fitur</a>
                    <a href="#about" class="text-sm font-medium hover:text-blue-400 transition-colors">Tentang</a>
                </div>
                <a href="{{ route('login') }}" class="btn-primary text-white text-sm font-bold px-8 py-3 rounded-xl hover:brightness-110 transition-all active:scale-95">
                  Login
                </a>
            </div>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <section id="hero" class="hero-bg min-h-screen flex items-center pt-24">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8 text-center lg:text-left">
               
                
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.05]">
                    Kelola Aset Lab <br>
                    <span class="text-gradient">Secara Cerdas.</span>
                </h1>
                
                <p class="text-lg text-slate-400 max-w-lg leading-relaxed mx-auto lg:mx-0">
                    Solusi modern untuk manajemen inventaris dan peminjaman alat laboratorium dengan pelacakan real-time.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <button class="btn-primary px-10 py-4 rounded-2xl text-white font-bold text-lg hover:translate-y-[-2px] transition-all">
                        Mulai Sekarang
                    </button>
                    <button class="px-10 py-4 rounded-2xl bg-white/5 border border-white/10 font-bold text-white hover:bg-white/10 transition-all">
                        Lihat Panduan
                    </button>
                </div>
            </div>

            <div class="relative group">
                <div class="absolute -inset-4 bg-blue-500/20 rounded-[3rem] blur-2xl group-hover:bg-blue-500/30 transition-all"></div>
                <div class="relative animate-float">
                    <img src="{{ asset('images/land.png') }}" alt="Preview" class="rounded-[2.5rem] border border-white/10 shadow-2xl bg-slate-900/50 backdrop-blur-sm">
                    
                    <!-- Floating Card -->
                    <div class="absolute top-10 -left-10 bg-slate-900/90 border border-white/10 p-4 rounded-2xl shadow-2xl hidden xl:block">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            <span class="text-xs font-bold">System Online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FITUR ===== -->
    <section id="fitur" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="max-w-2xl mx-auto text-center mb-20">
                <h2 class="text-blue-500 font-bold tracking-[0.2em] text-xs uppercase mb-3">Keunggulan</h2>
                <h3 class="text-4xl font-extrabold text-white mb-6">Didesain untuk Efisiensi</h3>
                <p class="text-slate-400">Kami menghilangkan kerumitan administrasi manual agar Anda bisa fokus pada produktivitas laboratorium.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="glow-card p-8 rounded-[2.5rem] group">
                    <div class="w-14 h-14 bg-blue-500/10 text-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Akses Instan</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Pinjam barang secepat kilat dengan sistem scan barcode yang terintegrasi penuh.</p>
                </div>

                <!-- Card 2 -->
                <div class="glow-card p-8 rounded-[2.5rem] group">
                    <div class="w-14 h-14 bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Keamanan Tinggi</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Data riwayat tidak bisa dimanipulasi, menjamin akuntabilitas setiap pengguna laboratorium.</p>
                </div>

                <!-- Card 3 -->
                <div class="glow-card p-8 rounded-[2.5rem] group">
                    <div class="w-14 h-14 bg-purple-500/10 text-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Laporan Detail</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Pantau grafik penggunaan aset secara mingguan atau bulanan secara otomatis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-black/40 border-t border-white/5 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
            <div>
                <div class="flex items-center gap-3 justify-center md:justify-start mb-4">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold italic">S</div>
                    <span class="text-lg font-bold text-white uppercase tracking-wider">SIPALKOM</span>
                </div>
                <p class="text-xs text-slate-500 max-w-sm">
                    © 2026 SIPALKOM Management. Dioptimalkan untuk efisiensi tinggi dalam pengelolaan laboratorium digital.
                </p>
            </div>
            
            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 transition-all hover:scale-110">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 transition-all hover:scale-110">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>