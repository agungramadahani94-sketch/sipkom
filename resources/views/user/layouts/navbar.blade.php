<nav class="navbar navbar-expand-lg main-navbar">

  <!-- LEFT MENU -->
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">

      <!-- Sidebar Toggle -->
      <li>
        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
          <i class="fas fa-bars"></i>
        </a>
      </li>

     
  
</ul>
  </form>

  <!-- RIGHT USER -->
  <ul class="navbar-nav navbar-right ml-auto">

    <!-- USER DROPDOWN -->
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

        <img alt="user" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">

        <div class="d-sm-none d-lg-inline-block">
          Hi,
        </div>

      </a>

      <div class="dropdown-menu dropdown-menu-right">

        <div class="dropdown-title">
          Logged in
        </div>

        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>  
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form> 
        

       
      </div>
    </li>

  </ul>

</nav>