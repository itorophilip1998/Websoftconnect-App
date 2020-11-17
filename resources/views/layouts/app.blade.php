<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/auth.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/css/mini.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
       <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"> -->

</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow fixed-top ">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/welcome') }}">
                 <img class="logo rounded-circle" style="width: 30px;" src="{{asset('images/logo.png')}}"/>
                 <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
                </a>

                <button id='toggleOut' onclick='toggleOutAction()'  class="navbar-toggler   d-md-none border-0 btn text-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span  style="font-size:20px;" class="fa fa-bars text-dark"></span>
                </button>
                <button id='toggleIn' onclick='toggleInAction()' style="display: none;"  class="navbar-toggler  d-md-none  border-0 btn text-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span  style="font-size:27px;font-family:'consolas'" class="fa   text-dark">x</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <hr class="d-block d-md-none ">
                            <li class="nav-item mx-1 my-1 ">
                                <a class="border px-3  border-primary rounded-lg btn-sm btn text-primary shadow " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item mx-1 my-1">
                                    <a class=" rounded-lg btn-sm btn btn-primary shadow " href="{{ route('register') }}">{{ __('Signup') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                             </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

       <div class="row">
       <div class="col-md-6  p-0 ">
        <main class="pt-5 mt-md-3 p-0">
            @yield('content')
        </main>
        </div>
        <div class="col-md-6 p-0 d-md-block d-none" id="hero">
          <div id="overlay" class="m-0 text-center ">
          <h3 class="p-3 welcomtxt" id="message">

            </h3>
          </div>


        </div>
       </div>

    </div>
</body>
</html>
