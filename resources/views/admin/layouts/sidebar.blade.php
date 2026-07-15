<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('beranda') }}">SIPALKOM</a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('beranda') }}">SK</a>
    </div>

    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>

      <li class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
        <a href="{{ route('beranda') }}" class="nav-link">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Manajemen Data</li>

      <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
        <a href="{{ route('user.index') }}" class="nav-link">
          <i class="far fa-user"></i>
          <span>User</span>
        </a>
      </li>

      <li class="{{ request()->routeIs('alatlab.*') ? 'active' : '' }}">
        <a href="{{ route('alatlab.index') }}" class="nav-link">
          <i class="fas fa-laptop"></i>
          <span>Alat Laboratorium</span>
        </a>
      </li>

      <li class="menu-header">Peminjaman</li>

      {{-- Menunggu Approval --}}
      <li class="{{ request()->routeIs('peminjam.index') ? 'active' : '' }}">
        <a href="{{ route('peminjam.index') }}" class="nav-link">
          <i class="fas fa-clock"></i>
          <span>Permohonan</span>
          @php
            $menunggu = \App\Models\Peminjam::where('status', 'menunggu')->count();
          @endphp
          @if($menunggu > 0)
            <span class="badge badge-warning ml-1">{{ $menunggu }}</span>
          @endif
        </a>
      </li>

      {{-- Peminjaman Aktif --}}
      <li class="{{ request()->routeIs('peminjam.aktif') ? 'active' : '' }}">
        <a href="{{ route('peminjam.aktif') }}" class="nav-link">
          <i class="fas fa-hand-holding"></i>
          <span>Peminjaman Aktif</span>
        </a>
      </li>

      {{-- Pengembalian --}}
      <li class="{{ request()->routeIs('pengembalian') ? 'active' : '' }}">
        <a href="{{ route('pengembalian') }}" class="nav-link">
          <i class="fas fa-box"></i>
          <span>Pengembalian</span>
        </a>
      </li>

      <hr class="bg-white">

      <li>
        <a href="#" class="nav-link" onclick="event.preventDefault(); Swal.fire({
             title: 'Yakin ingin logout?',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya, Logout!'
           }).then((result) => {
             if (result.isConfirmed) {
               document.getElementById('logout-form-sidebar').submit();
             }
           });">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display:none;">
          @csrf
        </form>
      </li>

    </ul>
  </aside>
</div>