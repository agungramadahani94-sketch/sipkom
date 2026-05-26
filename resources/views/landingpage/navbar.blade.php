<!-- NAV -->
<nav class="sticky top-0 z-[100] bg-blue border-b-[2.5px] border-ink">
    <div class="max-w-[1100px] mx-auto px-6 h-16 flex items-center justify-between">
        <a href="#"
            class="bg-yellow border-2 border-ink shadow-hard-sm px-4 py-1.5 font-syne font-extrabold text-[13px] tracking-[.15em] text-ink no-underline">SIPALKOM</a>

        {{-- Desktop --}}
        <div class="hidden md:flex gap-1 items-center">
            <a href="#"
                class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Home</a>
            <a href="#about"
                class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">About</a>
            <a href="#fitur"
                class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-3.5 py-2 text-white no-underline border-2 border-transparent hover:bg-yellow hover:border-ink hover:text-ink hover:shadow-hard-sm transition-all">Fitur</a>
            {{-- Login dibedakan: tombol kuning solid --}}
            <a href="{{ route('login') }}"
                class="font-syne font-bold text-[12px] tracking-[.08em] uppercase px-4 py-2 text-ink no-underline bg-yellow border-2 border-ink shadow-hard-sm hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all ml-2">Login →</a>
        </div>

        {{-- Hamburger --}}
        <button class="md:hidden bg-yellow border-2 border-ink shadow-hard-sm p-[9px_11px] flex flex-col gap-[5px]"
            onclick="toggleMenu()">
            <span class="block w-5 h-[2.5px] bg-ink"></span>
            <span class="block w-5 h-[2.5px] bg-ink"></span>
            <span class="block w-5 h-[2.5px] bg-ink"></span>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div id="mob" class="hidden flex-col bg-blue border-t-2 border-ink px-4 pb-3.5 pt-2.5 gap-1.5">
        <a href="#"
            class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-yellow text-ink no-underline">Home</a>
        <a href="#about" onclick="toggleMenu()"
            class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">About</a>
        <a href="#fitur" onclick="toggleMenu()"
            class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink bg-white text-ink no-underline">Fitur</a>
        {{-- Login dibedakan: kuning solid di mobile juga --}}
        <a href="{{ route('login') }}"
            class="font-syne font-bold text-[13px] uppercase py-3 px-4 text-center border-2 border-ink shadow-hard-sm bg-yellow text-ink no-underline">Login →</a>
    </div>
</nav>

<script>
    function toggleMenu() {
        const m = document.getElementById('mob');
        m.classList.toggle('hidden');
        m.classList.toggle('flex');
    }
    document.addEventListener('click', e => {
        const m = document.getElementById('mob');
        const b = document.querySelector('button');
        if (!m.contains(e.target) && !b.contains(e.target)) {
            m.classList.add('hidden');
            m.classList.remove('flex');
        }
    });
</script>