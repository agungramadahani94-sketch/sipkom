<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIPALKOM</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/modules/fontawesome/css/all.min.css">

  <!-- Sweet Alert -->
  <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('') }}assets/css/components.css">

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">

      <div class="navbar-bg"></div>

      {{-- Navbar --}}
      @include('admin.layouts.navbar')

      {{-- Sidebar --}}
      @include('admin.layouts.sidebar')

      {{-- Main Content --}}
      @yield('content')

      {{-- Footer --}}
      @include('admin.layouts.footer')

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('') }}assets/modules/jquery.min.js"></script>
  <script src="{{ asset('') }}assets/modules/popper.js"></script>
  <script src="{{ asset('') }}assets/modules/tooltip.js"></script>
  <script src="{{ asset('') }}assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('') }}assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('') }}assets/modules/moment.min.js"></script>
  <script src="{{ asset('') }}assets/js/stisla.js"></script>

  @stack('js')

  <!-- Template JS -->
  <script src="{{ asset('') }}assets/js/scripts.js"></script>
  <script src="{{ asset('') }}assets/js/custom.js"></script>

  {{-- Sweet Alert Success --}}
  @if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 2000
    });
  </script>
  @endif

  {{-- Sweet Alert Error --}}
  @if(session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '{{ session('error') }}',
      confirmButtonColor: '#6777ef'
    });
  </script>
  @endif

</body>

</html>