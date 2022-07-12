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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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