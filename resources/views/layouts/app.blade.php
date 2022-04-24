<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/cdf017c9a3.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nadvar-side.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalView.css') }}" rel="stylesheet">

    <!-- mapbox  -->
    @yield('links')


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="https://lh3.googleusercontent.com/fife/AAWUweWOYjNjPnp9VhUaTKuqAGuG4bGXcjbLZaaDgjBfJnS25RpMZSkcHIW7SootjEsda48ELCBIOEm05lNvEmw12Esg2ersGP9q3uGD0CLkZkmYQO7jA70nCNhCav23dIVcShlBDgFMD4M8c4LOyjPW5bMzLocH1rwYks2PNafzDOj81RpY6KGcIft1jp9BoKEoZHHhl45NFk1PAODayKe2llAu1wRFfq_-1hxaDc_8doJ1oRN5NqRmMzGp8CNA7a3ugs67pEP947mi_8cN6ugAwq6pKhciaVKuIQcoLVCymvfisFKaSTfTPrTXf_VKMrc1kHR4DCTQeTAhA2gevjaXdfHL0Ri-qcs4UYK9DfxGdffkGbTWFoSZb-iuyZGaFYuGCogRNeh2YOkAs-qWHMiGD-H694oZEDuDcaFZQznZaIdbnbsm5M6yMYHaDIRyaO30aoI1CezJGT0jNYz3nRH-dekmYQuYLL23F5occn8q6xhGC5EeUV1QqvB-RckHAKQQDo1xpwIh4OZKlXkepC-ptZJdYoJTyaujNn9yEPYghip0v8elsYQ5RKKf6_MU4euV0c1ITJT3zDUCjeqBF4W0ckbyRgLXUbvSU76tX_T83_N6oE-YfL51uCSYZOPN_fwezPLsrLV9JfCW8asWujCsn5aGGwvZC7JWExfzv3fnmyW5XGtoy2eMYwX5BJmLT5Zx4ekU08tb5K3qdWYNWn--ndMaLsIDP1RaNiXdY0oT-eIAN0u8kyHC6i0R1AIZr3tjbhK-Uz6FK0AbyuaNBDuZBfTky7JrHU6efXaqoYvOcoGgCtJMqBHo9wcI4uYnm3XfoqLGJU7LeaeGtuTkTAl4Q_U33Lu7HSa9DZ8NA3obsex-CR_b7PVitzfpjcVenUBS=w1122-h883"
                    alt="" width="60px">
                    uam-bnb
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth()->user()->status == 'admin')
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Características
                                    </a>
                                    <div class=" boderMenu dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('characteristics.create') }}">
                                            Añadir característica
                                        </a>
                                        <a class="dropdown-item" href="{{ route('characteristics.index') }}">
                                            Ver características
                                        </a>
                                    </div>
                                </li>
                            @endif


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Propiedades
                                </a>
                                <div class="boderMenu dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('properties.create') }}">
                                        Añadir Propiedad
                                    </a>
                                    <a class="dropdown-item" href="{{ route('properties.index') }}">
                                        Ver Propiedades
                                    </a>


                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="boderMenu dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('propertiesUser.index', Auth::user()) }}">
                                        Mis Propiedades
                                    </a>
                                    <a class="dropdown-item" href="{{ route('bills.index') }}">
                                        {{ __('Recibos') }}
                                    </a>

                                    <div class="BottonBlackNav"></div>
                                    <a class="dropdown-item" href="{{ route('qualifications.index') }}">
                                        {{ __('Calificaciones') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('comments.index') }}">
                                        {{ __('Comentarios') }}
                                    </a>

                                    <div class="BottonBlackNav"></div>
                                    <a class="dropdown-item" href="{{ route('users.show', Auth()->user()) }}">
                                        {{ __('Perfíl') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- sweet alert -->

    @yield('js')

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</html>

<style>

.BottonBlackNav{
    padding: 2px 4px;
    padding-bottom: 2%;
    border-bottom: rgb(132, 132, 132) 1px solid;

}
.boderMenu{
border: rgb(156, 156, 156) solid 1px;


}





</style>
