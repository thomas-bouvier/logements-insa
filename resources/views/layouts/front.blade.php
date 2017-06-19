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
    <link href="{{ asset('css/style.css?version=11') }}" rel="stylesheet">

    @yield('head')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @if (App\User::where('login', cas()->user())->first()->role != 'admin')
    <script>
        if (window.location.hostname != 'localhost' && window.location.hostname != '127.0.0.1') {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-101248635-1', 'auto');
            ga('send', 'pageview');
        }
    </script>
    @endif
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
                      <div class="navbar-brand-name">
                          <img src="{{ asset('img/aeir.png') }}"/>
                          {{ config('app.name', 'Logements INSA') }}
                      </div>
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
                                <a href="{{ route('admin.bids.index') }}">Modérer les annonces</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.types.index') }}">Gérer les catégories</a>
                            </li>

                              <li class="divider"></li>
                            @endif

                              <li>
                                <a href="{{ url('home') }}">Consulter les annonces</a>
                              </li>

                              <li>
                                <a href="{{ route('bids.index') }}">Gérer mes annonces</a>
                              </li>

                              <li class="divider"></li>

                              <li>
                                <a href="{{ url('about') }}">À propos</a>
                              </li>

                              <li>
                                  <a href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      Se déconnecter
                                  </a>

                                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/laravel.js') }}"></script>

    @yield('js')
</body>
</html>
