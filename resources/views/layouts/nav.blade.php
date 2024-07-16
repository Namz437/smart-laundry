<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Laundry Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('style')
  </head>
  <body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="#"><h3>Smart-Laundry</h3></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}"><h6>Dashboard</h6></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('table') }}"><h6>Perusahaan</h6></a>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Device
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('device')}}">Data Device</a></li>
              <li><a class="dropdown-item" href="{{ route('typecuci')}}">Type Cuci</a></li>
              <li><a class="dropdown-item" href="{{ route('addition')}}">Addition</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Users
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('user')}}">Data User</a></li>
              <li><a class="dropdown-item" href="{{ route('role')}}">Roles</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Settings
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('settingroles')}}">Setting Roles</a></li>
              <li><a class="dropdown-item" href="{{ route('settingharga')}}">Setting Harga</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Transaksi
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{ route('trxbooking')}}">Transaksi Cucian Booking</a></li>
              <li><a class="dropdown-item" href="{{ route('trxcuciadd')}}">Transaksi Cucian Additional</a></li>
              <li><a class="dropdown-item" href="{{ route('trxcucireal')}}">Transaksi Cucian Realtime</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          @if(!empty(Auth::user()))
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('logout')}}" onclick="return confirm('Apakah Anda yakin ingin Log Out?');"><h6>Logout</h6></a>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->name}}
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item">{{Auth::user()->email}}</a></li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('login')}}"><h6>Login</h6></a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!-- Content -->
  <div class="container">
    <main class="my-4">
      @yield('content')
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  @stack('script')
  </body>
</html>
