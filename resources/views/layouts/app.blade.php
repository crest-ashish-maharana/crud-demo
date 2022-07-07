<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper --> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- BootStrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Custom styles for this template -->
    <link href="navbar-static-top.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        ul{
        overflow:hidden;
        }
        li{
        display:block;
        }
        .dropdown {
            position: static;
        }
        .dropdown-menu{
            margin-top: 17px;
        }
        .dropdown-toggle::after {
            margin-top: 17px;
            margin-left: 15px;
        }
    </style>
  </head>
<body>
    <!-- Static navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ url('/home') }}">DEMO CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Home</a>
              </li>
              @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
              @else
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Manage-Users</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Manage-Role</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('attributes.index') }}">Manage-Product-Attribute</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Manage-Product</a></li>
                
                <li  class="nav-item">
                    <span class="nav-link" href="{{ route('users.show', Auth::id()) }}"><strong>Welcome: {{ Auth::user()->name }}</strong></span>
                </li>  
                
                <li class="nav-item"><a class="nav-link" href="{{ route('users.show', Auth::id()) }}">Profile</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                    
                        {{ __('Logout') }}                                
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
              @endguest
            </ul>
          </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')    
    </div>
    <!-- Scripts -->
</body>
</html>