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

      <li class="{{ request()->routeIs('peminjam.*') ? 'active' : '' }}">
        <a href="{{ route('peminjam.index') }}" class="nav-link">
          <i class="fas fa-hand-holding"></i>
          <span>Peminjaman</span>
        </a>
      </li>

      <li class="{{ request()->routeIs('pengembalian') ? 'active' : '' }}">
        <a href="{{ route('pengembalian') }}" class="nav-link">
          <i class="fas fa-box"></i>
          <span>Pengembalian</span>
        </a>
      </li>

      <hr class="bg-white">

      <li>
        <a href="#" class="nav-link"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>

    </ul>
  </aside>
</div>