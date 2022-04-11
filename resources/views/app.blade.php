<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <title>@isset($title){{$title}} -@endisset Pemrograman Simulasi: Montecarlo</title>    

    <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome/all.min.css') }}">

    @yield('csslib')
    
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="index.html" class="navbar-brand sidebar-gone-hide">El-Monte</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">        
          @auth
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item has-icon text-danger"  onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
          </li>
          @else
          <li>
            <a href="{{ route('login') }}" class="nav-link">LOGIN</a>
          </li>
          @endauth           
        </ul>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item @if(url()->current()==route('home')) active @endif">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
              </li>
            <li class="nav-item  @if(url()->current()==route('input')) active @endif">
              <a href="{{ route('input') }}" class="nav-link"><i class="fas fa-table"></i><span>Manual Input</span></a>
            </li>
            <li class="nav-item  @if(url()->current()==route('import')) active @endif">
                <a href="{{ route('import') }}" class="nav-link"><i class="fas fa-file-csv"></i><span>CSV Import</span></a>
            </li>
            <li class="nav-item  @if(url()->current()==route('history')) active @endif">
              <a href="{{ route('history') }}" class="nav-link"><i class="fas fa-history"></i><span>History</span></a>
          </li>
          </ul>
        </div>
      </nav>

      @yield('maincontent')

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2021 
        </div>
        <div class="footer-right">
          1.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/modules/popper.js') }}"></script> --}}
  <script src="{{ asset('assets/modules/popper.min.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script> 

  @yield('scriptlib')

  
  <script src="{{ asset('assets/js/scripts.js') }}"></script>

  @yield('scriptpage')
  
  @yield('scriptline')
</body>
</html>