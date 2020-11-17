<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

           <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" rel="stylesheet">

        <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/auth.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/css/mini.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <!-- navbar -->
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
                      <li class="nav-item mt-2">
                                <a class=" px-3  btn-link text-dark " href="/">Home</a>
                      </li>
                      <li class="nav-item mt-2">
                                <a class=" px-3  btn-link text-primary " href="#services">Services</a>
                      </li>
                      <li class="nav-item mt-2">
                                <a class=" px-3  btn-link text-primary " href="#about">About</a>
                      </li>
                      <li class="nav-item mt-2">
                                <a class=" px-3  btn-link text-primary " href="#contactus">Contact us</a>
                      </li>

                        <!-- Authentication Links -->
                        @guest
                        <hr class="d-block d-md-none ">
                            <li class="nav-item mx-1 my-1 ">
                                <a class="border px-3  border-primary rounded-lg btn-sm btn text-primary shadow " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item mx-1 my-1">
                                    <a class=" rounded-lg btn-sm btn btn-primary shadow" href="{{ route('register') }}">{{ __('Register') }}</a>
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

            <!--Main -->
            <main>
            <div class="overlay">
            <h1 class="text-white">
         <b>    Don't  <span class="text-muted"><</span>
                    <span class="code">/</span>
                    <span class="text-primary">code</span>
                    <span class="text-muted">></span> Alone AnyMore...</b>
            </h1> <br>
            <h3 >Share your problems and get solutions here</h3>
            <p >Communicate with proffesional and intermidate developers who knows better and also share your ideas to solve other people's problem.</p>

            <a href="/register" class="btn mt-3 p-2 px-4  btn-primary">Get started ></a>
            </div>
            </main>
            <!-- section how to start -->
            <section >
                <h2 class="text-center mt-5"><strong><u> HOW CAN I START? </u></strong></h2>
                <div class="row mt-1 container m-auto p-5   text-center justify-content-center">
                    <div class="col-lg-3 col-sm-6 p-3 m-auto">
                            <div class="card shadow ">
                                  <i class="fa fa-x text-primary  fa-edit    "></i>
                                  <!-- <hr> -->
                                <!-- <img class="card-img-top"  src="{{asset('images/coding3.jpg')}}" alt=""> -->
                                <div class="card-body">
                                    <h4 class="card-title text-primary"><b>Signup</b></h4>
                                    <p class="card-text text-secondary">
                                     As a new user, click getstarted to create an account and fill all the required information.
                                    </p>
                                </div>
                            </div>

                    </div>
                    <div class="col-lg-3 col-sm-6 p-3   m-auto ">
                    <div class="card shadow">
                    <i class="fa fa-x text-success  fa-code    "></i>
   <!-- <hr> -->
                                <!-- <img class="card-img-top"  src="{{asset('images/hero1.jpg')}}" alt=""> -->
                                <div class="card-body">
                                    <h4 class="card-title text-success"><b>Profile</b></h4>
                                    <p class="card-text text-secondary">
                                        After creating a new account, set up your profile and fill in all the required information.
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6  p-3  m-auto ">
                    <div class="card shadow">
                    <i class="fa fa-x text-danger  fa-newspaper-o    "></i>
   <!-- <hr> -->
                                <!-- <img class="card-img-top"  src="{{asset('images/coding3.jpg')}}" alt=""> -->
                                <div class="card-body">
                                    <h4 class="card-title text-danger"><b>Post</b></h4>
                                    <p class="card-text text-secondary">
                                        You can share your ideas with your fellow by posting videos,pictures and writeups.
                                    </p>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                    <div class="col-lg-3 col-sm-6  p-3  m-auto  ">
                    <div class="card shadow">
                    <i class="fa   fa-x text-secondary  fa-comments-o    "></i>
   <!-- <hr> -->
                                <!-- <img class="card-img-top"  src="{{asset('images/coding3.jpg')}}" alt=""> -->
                                <div class="card-body text-secondary">
                                    <h4 class="card-title"><b>Chat</b></h4>
                                    <p class="card-text text-secondary">
                                        You can also share ideas with your fellow by chatting with him/her privately.
                                    </p>
                                </div>
                            </div>
                        </div>
                </div>
            </section>
 <!-- services -->
 <section class="services text-center">
 <h2 id="services" class="text-center mt-5"><strong><u> Services </u></strong></h2>
     <!-- post -->

 <div class="row shadow container p-0  m-auto ">
     <div class="col-md-6  p-0 ">
         <img class="w-100 h-100 rounded-lg shadow" src="{{asset('images/share2.jpg')}}" alt="">
     </div>
     <div class="col-md-6  p-3">
  <h4 class=" text-center text-primary mb-3"><b>Share Ideas with just a Post</b> </h4>
        <span class="ttext">
      Websoft Connect is a plateform where you can share your ideas  or ask questions and get solution with just a post/comment.
        </span>
     </div>
 </div>  <br>
 <br>
     <!-- Chat -->
     <div class="row shadow container p-0  m-auto ">
     <div class="col-md-6    p-0 m-0">
         <img class="w-100 h-100 rounded-lg shadow" src="{{asset('images/chat1.jpg')}}" alt="">
     </div>
     <div class="col-md-6 order-md-first  p-3">
  <h4 class=" text-center text-primary mb-3"><b>Communicate with another developer</b></h4>
        <span class="ttext">
       Websoft Connect allows you to chat with your fellow developer if you have a problem you don't wanna share in the public.
        </span>
     </div>
 </div>

</section>
     <!-- section testimonials -->
     <section class="testimonials p-3">
     <h2 class="text-center mt-5"><strong><u> TESTIMONIALS </u></strong></h2>
              <div class="testimonails">
                  <div class="row content-justify-center">
                      <div class="col-md-4 col-sm-6   m-auto">
                          <div class="card shadow my-4">
                              <div class="card-body">
                                  <h5 class="card-title">
                                  <a href="{{asset('images/testimonial2.jpg')}}"> <img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial2.jpg')}}" alt=""></a> Sylvester Udoh</h5>
                                  <p class="card-text text-dark text-justify">
                                      I will start by thanking websoft very much for giving intermediate developer a change to communicate with other developers dispite the level of proffesion.
                                      I have almost all my  bugs  solve here, because they give solutions to my problems quickly.
                                      <br>
                                      <b>Back-end Developer </b>
                                  </p>


                              </div>
                          </div>

                      </div>
                      <div class="col-md-4 col-sm-6  m-auto">
                      <div class="card shadow my-4">
                              <div class="card-body">
                                  <h5 class="card-title">
                                     <a href="{{asset('images/testimonial3.jpg')}}"><img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial3.jpg')}}" alt=""></a> Ubong Keyzz</h5>
                                  <p class="card-text text-dark text-justify">
                                      I was tired at first when i tried searching for a solution that i did`nt see on google and other platform, i now realise that not all physical problem can be seen on google, websoft has really help my career alot, they give me solutions to my problem with immediate effet.
                                 <br> <b>UIUX Designer </b>

                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-4 col-sm-6  m-auto">
                      <div class="card shadow my-4">
                              <div class="card-body">
                                  <h5 class="card-title ">
                                  <a href="{{asset('images/testimonial4.jpg')}}"><img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial4.jpg')}}" alt=""></a> Idorenyin Smart</h5>
                                  <p class="card-text text-dark">I always waste my data watching videos that most times never given me solution to what i needed,   i watse my time talking to profeesional developers who never given me time but when i started using websoft i figured out that they solved my problem the most.
                                  <br> <b>Front-End Engineer </b>
                                  </p>

                                </div>
                          </div>
                      </div>
                  </div>
              </div>
     </section>
     <!-- contact us -->
      <section id="contactus" class="contact ">
             <div class="main">
             <div id="overlay3" class="m-0 text-center">
                   @if (Session::has('message'))
                       <div class="alert alert-primary alert-dismissible fade show" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                               <span class="sr-only">Close</span>
                           </button>

                          <strong>Hello  {{ Session::get('user')}}!</strong><br>
                        {{ Session::get('message')}}
                       </div>
                   @endif
                 <form action="/contactus" class="container px-lg-5 pt-md-5 pt-2" method="POST">
                 @csrf

                 <h2 class="text-center "><strong><u> Contact Us</u></strong></h2>
                     <!-- names -->
                     <div class="row p-2">
                        <div class="col-6">
                        <input maxlength="20" type="text" name="first_name" class="form-control" placeholder="First Name" >
                        </div>
                        <div class="col-6">
                        <input maxlength="20" type="text" name="last_name" class="form-control" placeholder="Last Name" >
                        </div>
                     </div>
                    <!-- email -->
                    <div class="row p-2">
                    <div class="col-12">
                        <input type="email" maxlength="50" name="email" class="form-control" placeholder="Email Address" >
                     </div>
                    </div>
                    <!-- Phone -->
                    <div class="row p-2">
                    <div class="col-12">
                        <input type="text" maxlength="15" name="phone" class="form-control" placeholder="Phone" >
                     </div>
                    </div>
                    <!-- Phone -->
                    <div class="row p-2">
                    <div class="col-12">
                        <!-- desktop -->
                       <textarea name="message" class="form-control d-md-block d-none" placeholder="Message" id="" cols="30" rows="8"></textarea>
                       <!-- mobile -->
                       <textarea name="message" class="form-control d-md-none d-block" placeholder="Message" id="" cols="30" rows="4"></textarea>
                       <br>
                       <button class="btn btn-primary w-50">Send</button>
                     </div>
                    </div>

                 </form>
             </div>
             </div>
      </section>
       <!-- about-->
    <section id="about" class="about bg-white p-5">
       <h2 class="text-center"><strong><u> About </u></strong></h2>
   <span class="text-center d-block">
Our mission is to connect  intermediate developers with senior developers and professional developers to share ideas and experience in tech and also solve problems by responding to post and chat  as well as comments.
WebsoftConnect was Design and developed by
Itoro Emmanuel Philip,
A Fullstack Developer Working @ Stathub Innovation hub uyo.
   </span>
    </section>

     <!-- subscribe -->
     <section class="bg-primary p-4 ">
     <h3 class="text-center text-white my-5 cap"><strong> Subscribe our newletter
 </strong> <br><i style="font-family: consolas;text-transform:capitalize !important">To get new updates</i></h3>

        <form action="/contactus" class="container" method="post">
            @csrf
        <div class="row">
             <div class="col-md-9">
          <i style="position: absolute;top:15px;left:20px;color:silver" class="fa fa-envelope fa fa-3x " aria-hidden="true"></i>   <input type="email" class="form-control my-2 sub px-5 p-1  " placeholder="Email Address">
             </div>
             <div class="col-md-3">
                 <button class="btn btn-dark  sub my-2 p-0 w-100">Subscribe</button>
             </div>
         </div>
        </form>

     </section>



            <!-- footer -->
            <footer class="bg-dark p-5">
                <div class="row text-white">
                    <div class="col-md-6">

                  <div class="text-center">
                      <ul style="display:inline-flex !important ">
                            <!-- Authentication Links -->
                        @guest

                            <li class="nav-item mx-1 my-1 ">
                            <h3>
                  <img class="logo rounded-circle" style="width: 40px;" src="{{asset('images/logo.png')}}"/>
                 <span class="text-dark">|</span>  <span class="text-primary">WebSoft</span> <span class="text-secondary">Connect</span>
                  </h3>
                                    <a class=" rounded-lg btn-sm btn btn-primary shadow" href="{{ route('register') }}">{{ __('Register') }}</a>

                                <a class="border px-3  border-primary rounded-lg btn-sm btn text-primary shadow " href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                        @else
                            <li class="nav-item dropdown">

                            <form   action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                        <h2>
                  <img class="logo rounded-circle " style="width: 40px;border:2px solid grey;"  src='{{Auth::user()->profiles["photo"]}}'/>
                 <span class="text-info">{{Auth::user()->name}}  </span>

                  </h2>
                                    <button class=" rounded-lg btn-sm btn btn-primary shadow" type="submit">{{ __('Logout') }} <i class="fa fa-sign-out" aria-hidden="true"></i></button>

                             </form>
                            </li>
                        @endguest
                      </ul>
                  </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mt-3 mt-md-0">
                        <h4>Company</h4>
                        <ul style="font-size: 23px !important">
                            <li><a href="#contactus">Contact Us</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#services">Services</a></li>
                               <li>
                            <div class="copy pt-4">
                           <a href="" class="fa rounded-circle p-2 bg-white text-primary fa-facebook-official   " aria-hidden="true"></a>
                           <a href="" class="fa rounded-circle p-2 bg-white text-danger  fa-envelope" aria-hidden="true"></a>
                         </div>
                            </li>

                        </ul>
                    </div>
                        <div class="col-md-3 col-sm-6 mt-3 mt-md-0">
                        <h4>Developer</h4>
                        <ul style="font-size: 23px !important">
                            <li><a href="">Facebook</a></li>
                            <li><a href="">Twitter</a></li>
                            <li><a href="">Instagram</a></li>
                            <li><a href="">linkedin</a></li>

                        </ul>
                        </div>

                </div>
                <hr>

                <div class="copy pt-2 text-center text-secondary">
                    <h6>© 2020 WebsoftConnect. All rights reserved.</h6>
                </div>

            </footer>
        </div>
    </body>
</html>
