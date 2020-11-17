
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <title>WebsoftConnect | Welcome</title>
    <!-- Preloader -->
    <style>
        /* .testimonials,.fill-section-white{
            background:whitesmoke
        } */
        @keyframes hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }
        li{
            /* list-style: none; */
            /* list-style-type: armenian; */
        }
        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
        .testimonailsImg
 {
     width: 50px;
     height: 50px;
     border: 2px solid grey !important;
 }
        /* // Zoom effect */
    .zoom {
        transition: transform .2s;
    }

  .zoom:hover {
    -ms-transform: scale(1.1); /* IE 9 */
    -webkit-transform: scale(1.1); /* Safari 3-8 */
    transform: scale(1.1);
    z-index: 2 !important;
  }

    </style>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <!-- Quick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/quick-website.css')}}" id="stylesheet">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-cookies" data-backdrop="false" aria-labelledby="modal-cookies" aria-hidden="true">
        <div class="modal-dialog modal-dialog-aside left-4 right-4 bottom-4">
            <div class="modal-content bg-dark-dark">
                <div class="modal-body">
                    <!-- Text -->
                    <p class="text-sm text-white mb-3">
                        We use cookies so that our themes work for you. By using our website, you agree to our use of cookies.
                    </p>
                    <!-- Buttons -->
                    <a href="pages/utility/terms.html" class="btn btn-sm btn-white" target="_blank">Learn more</a>
                    <button type="button" class="btn btn-sm btn-primary mr-2" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light  bg-white">
        <div class="container ">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ url('/welcome') }}">
                <img class="logo rounded-circle" style="width: 30px;height:30px" src="{{asset('images/logo.png')}}"/>
                <span class="text-dark">|</span> <b><span class="text-info">WebSoft</span><span class="text-dark">Connect</span></b>
               </a>
            <!-- Toggler -->
            <button class="navbar-toggler p-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                        <div class="dropdown-menu dropdown-menu-single">
                            <a href="/about_us" class="dropdown-item">About us</a>
                            <a href="/contact_us" class="dropdown-item">Contact</a>
                            <a href="/about_us#terms" class="dropdown-item">Terms and Conditions</a>
                            <div class="dropdown-divider"></div>
                            <a href="/support" class="dropdown-item">Support / Help Center</a>
                        </div>
                    </li>

                </ul>
                <!-- Button -->
                @guest

                <a href="/register" class=" text-white btn btn-sm py-1 bg-primary  ml-3">
                    Signup
                </a>
                <a href="/login" class=" text-primary border py-1   border-primary btn btn-sm btn-white ml-3">
                    Login
                </a>
               @else
               <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item pl-2" href="{{ route('logout') }}"
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
            </div>
        </div>
    </nav>


<Main>
   @yield('content')

</Main>






  <footer class="position-relative" id="footer-main">
    <div class="footer pt-lg-7 footer-dark bg-dark">
        <!-- SVG shape -->
        <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
            <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class=" fill-section-secondary">
                <polygon points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <!-- Footer -->
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <!-- Theme's logo -->
                    <h3>
                        <img class="logo rounded-circle" style="width: 40px;" src="{{asset('images/logo.png')}}"/>
                       <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
                        </h3>
                    <!-- Webpixels' mission -->
                    <p class="mt-4 text-sm opacity-8 pr-lg-4">
                        Websoft Connect attempts to bring the best development experience to designers and developers by offering ideas needed for having a quick and solid start in most web projects.</p>
                    <!-- Social -->
                    <ul class="nav mt-4">
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="https://dribbble.com/webpixels" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/webpixels" target="_blank">
                                <i class="fab fa-github"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.instagram.com/webpxs" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/webpixels" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pt-sm-0" id="feedback">
                           @if (Session::has('message2'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                 {{ Session::get('message2')}}
                                 </div>
                               @endif
                            <form  action="/feedback" class="" method="post">
                                @csrf
                                  <input required  type="email" name="email" class="form-control  bg-transparent text-white" placeholder="Email Address">
                                   <button   type="submit" data-title="send" class="btn fa  fa-paper-plane d-block text-white" style="opacity: 0.9;position: absolute;margin:-47px 0 0 170px ;"></button>
                            </form>
                        </li>
                    </ul>

                </div>
                <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
                    <h6 class="heading mb-3">Account</h6>
                    <ul class="list-unstyled">
                        <li><a href="/#/profile">Profile</a></li>
                        <li><a href="/#/settings">Settings</a></li>
                        <li><a href="/">Post</a></li>
                        <li><a href="/#/notifications">Notifications</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                    <h6 class="heading mb-3">App</h6>
                    <ul class="list-unstyled">
                        <li><a href="/welcome#start">How To Start</a></li>
                        <li><a href="/about_us#services">Services</a></li>
                        <li><a href="/welcome#features">Features</a></li>
                        <li><a href="/welcome#testimonials">Testimonails</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
                    <h6 class="heading mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li><a href="/about_us">About Us</a></li>
                        <li><a href="/contact_us">Contact Us</a></li>
                        <li><a href="/about_us#terms">Terms</a></li>
                    </ul>
                </div>
            </div>
            <hr class="divider divider-fade divider-dark my-4">
            <div class="row align-items-center justify-content-md-between pb-4">
                <div class="col-md-6">
                    <div class="copyright text-sm font-weight-bold text-center text-md-left">
                        &copy; 2020 <a href="https://webpixels.io" class="font-weight-bold" target="_blank">Websoft</a>. All rights reserved
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/about_us#terms">
                                Terms and Conditions
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Core JS  -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/libs/svg-injector/dist/svg-injector.min.js')}}"></script>
<script src="{{ asset('assets/libs/feather-icons/dist/feather.min.js')}}"></script>
<!-- Quick JS -->
<script src="assets/js/quick-website.js"></script>
<!-- Feather Icons -->
<script>
    feather.replace({
        'width': '1em',
        'height': '1em'
    })
</script>
</body>

</html>
