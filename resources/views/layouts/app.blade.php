<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.css">

   <style type="text/css">
      body{
        margin: 0;
        padding: 0;
      }
      
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ogłoszenia Reklamowe') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .thumb-post img {
            object-fit: cover;
            object-position: center;
            width: 400px;
            height: 300px;
            max-height: 250px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .edit-gallery img{
            object-fit: contain;
            object-position: center;
            height: auto;
            overflow: hidden;
        }

        .edit-gallery {
            overflow: hidden;
            width: 400px;
            max-height: 300px;
        }

        .carousel-mini {
            height:50vh;
            overflow: hidden;
        }

        .carousel-mini img{
            object-fit: cover;
            width: 100%;
            height: auto;
        }

        .carousel-max {
            object-fit: cover;
            object-position: center; 
            overflow: hidden;
        }

        .carousel-max img{
            height: 90vh;
            object-fit: cover;
        }

        .carousel-hud {
            opacity: 1;
        }

        .carousel:hover .carousel-hud {
            background: rgb(255, 255, 255);
            opacity: 0.7;
        }
        
        .listText {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4; /* ilość wyświetlanych linii */
                line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .cardList .date {
            position: absolute;
            bottom: 0;
            left: 250;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/ogloszenia') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Logowanie</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Rejestracja</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Wyloguj
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                    <h6 class="dropdown-header">Ogłoszenia</h6>
                                    <a class="dropdown-item" href="{{ route('listing_item.create') }}">Dodaj Ogłoszenie
                                    </a>
                                    <h6 class="dropdown-header">Profil</h6>
                                    <a class="dropdown-item" href="{{ route('userpanel.view') }}">
                                    Panel Użytkownika
                                    </a>
                                    @if(Auth::user()->role=='admin')
                                    <a class="dropdown-item" href="{{ route('adminpanel') }}">
                                    Panel Administratora
                                    </a>
                                    @endif
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
