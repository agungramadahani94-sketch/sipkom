<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('user.dashboard') }}">SIPALKOM</a>
    </div>

    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('user.dashboard') }}">SK</a>
    </div>

    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>

      <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}" class="nav-link">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Manajemen Data</li>

      <li class="{{ request()->routeIs('user.alat') ? 'active' : '' }}">
        <a href="{{ route('user.alat') }}" class="nav-link">
          <i class="fas fa-laptop"></i>
          <span>Alat Laboratorium</span>
        </a>
      </li>

      <li class="{{ request()->routeIs('user.peminjaman') ? 'active' : '' }}">
        <a href="{{ route('user.peminjaman') }}" class="nav-link">
          <i class="fas fa-hand-holding"></i>
          <span>Peminjaman Saya</span>
        </a>
      </li>

      <hr class="bg-white">

      <li>
        <a href="" class="nav-link" onclick="event.preventDefault(); Swal.fire({
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
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>

    </ul>
  </aside>
</div>