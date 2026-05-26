<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPALKOM')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { syne: ['Syne', 'sans-serif'], mono: ['"DM Mono"', 'monospace'], sans: ['"DM Sans"', 'sans-serif'] }, colors: { ink: '#0a0a0a', ink2: '#1a1a2e', paper: '#fafaf7', cream: '#f5f0e8', blue: { DEFAULT: '#1640d4', dark: '#0d2fa8', light: '#dce8ff' }, yellow: { DEFAULT: '#f5c518', dark: '#c49b00' }, green: '#0ea95e' }, boxShadow: { hard: '5px 5px 0 #0a0a0a', 'hard-lg': '8px 8px 0 #0a0a0a', 'hard-sm': '3px 3px 0 #0a0a0a' } } } }
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
        .pulse-anim { animation: pulse-dot 2s infinite }
    </style>
    @stack('styles')
</head>

<body class="font-sans bg-paper text-ink overflow-x-hidden">

    @include('landingpage.navbar')

    @yield('content')

    @include('landingpage.footer')

    @stack('scripts')

</body>
</html>