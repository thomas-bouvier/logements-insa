<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Logements INSA') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootswatch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css?version=2') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?version=5178929') }}" rel="stylesheet">
    <link href="{{ asset('css/justifiedGallery.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <header>
      <nav class="navbar navbar-default navbar-static-top">
          <div class="container">
              <div class="navbar-header">

                  <!-- Collapsed Hamburger -->
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                      <span class="sr-only">Toggle Navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>

                  <!-- Branding Image -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                      {{ config('app.name', 'Logements INSA') }}
                  </a>
              </div>

              <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  <ul class="nav navbar-nav">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ cas()->user() }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                            @if (App\User::where('login', cas()->user())->first()->role == 'admin')
                              <li>
                                <a href="{{ url('/types') }}">Gérer les types de bien</a>
                              </li>

                              <li class="divider"></li>
                            @endif

                              <li>
                                <a href="{{ url('/bids') }}">Gérer mes annonces</a>
                              </li>

                              <li class="divider"></li>

                              <li>
                                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      Se déconnecter
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
    </header>

    <div class="content">
      @include('layouts.flash')

      @yield('content')
    </div>

    <footer class="footer">
      <div class="container">
        <p>Pour toute suggestion/rapport de bug n'hésite pas à m'envoyer un message à <a href="mailto:tbouvier@insa-rennes.fr">tbouvier@insa-rennes.fr</a> :)</p>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/laravel.js') }}"></script>
    <script src="{{ asset('js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.justifiedGallery.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
