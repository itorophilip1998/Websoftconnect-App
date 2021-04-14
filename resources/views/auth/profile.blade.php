<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebsoftConnect | Create Profile</title>
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
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
<body >
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
    <!-- desktop -->

    <div class="container-fluid d-md-block d-none mt-5 p-5">
        <form  class="row justify-content-center"  method="POST" action="/blade-update" enctype="multipart/form-data">
            <div class="col-md-4 d-block border-right text-center" >
               @csrf
                <img src="{{ asset('/images/avater.png') }}" id="output" style="width: 220px;height: 220px; border-radius: 10px;"   class=" shadow" alt="">
                <div class="form-group row mt-2">
                    <div class="col-md-12 ">
                          <p class="p-3" style="border: 2px dashed #3490dc;">
                                <input id="my-input" accept="image/*" onchange="loadFile(event)" class="form-control-file border-0" type="file" name="photo" required>
                          </p>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-md-12 text-left col-form-label "><i class="fa fa-edit text-primary" aria-hidden="true"></i> {{ __('Status') }}</label>

                    <div class="col-md-12">
                        <textarea placeholder="e.g( +123 )"  rows="5"  id="status" type="text" class="form-control @error('status') is-invalid text-danger border-danger @enderror" name="status" required autocomplete="status"></textarea>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12  ">
                        <button type="submit" class="btn w-100 shadow btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 px-xl-4">
                <div class="card border-0">
                    <div class="card-header bg-transparent border-0 pb-0">
                    <h4 class="text-primary  text-center ">{{ __('Create Profile') }} <i class="fa fa-user" aria-hidden="true"></i> &emsp;     <a href="/"  class="btn btn-primary btn-sm">Skip</a> </h4>
                        <hr >
                    </div>
                    <div class="card-body py-0 ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    {{-- col1 --}}
                            <div class="form-group row">
                                <div class="col-6 ">
                                <label for="first_name" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('First Name') }}</label>
                                    <input maxlength="25"  placeholder="e.g( Peter )" id="email" type="text" class="form-control @error('first_name') border-danger text-danger is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6  ">
                                <label for="last_name" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('Last Name') }}</label>

                                    <input maxlength="25" placeholder="e.g( Parker )" id="last_name" type="text" class="form-control @error('last_name') border-danger text-danger is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



    {{-- col2 --}}

                            <div class="form-group row">
                                <label for="phone" class="col-md-12 col-form-label "><i class="fa fa-phone text-primary" aria-hidden="true"></i> {{ __('Phone') }}</label>

                                <div class="col-md-12  ">
                                    <input maxlength="11" placeholder="e.g( +123 )" id="password" type="text" class="form-control @error('phone') is-invalid text-danger border-danger @enderror" name="phone" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    {{-- col-3 --}}
                            <div class="form-group row">
                                <div class="col-6 ">
                                <label for="dob" class=" col-form-label"> <i class="fa fa-calendar text-primary" aria-hidden="true"></i> {{ __('Date Of Birth') }}</label>
                               <input   style="cursor: pointer !important;" placeholder="e.g( Peter )" id="email" type="date" class="form-control @error('dob') border-danger text-danger is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="email" autofocus>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6 ">
                                <label for="gender" class=" col-form-label"> <i class="fa fa-male text-primary" aria-hidden="true"></i><i class="fa fa-female text-primary" aria-hidden="true"></i> {{ __('Gender') }}</label>

                                    <select id="my-select"  class="custom-select border-primary @error('gender') border-danger text-danger is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                        <option selected value="">Select Gender</option>
                                        <option >Male</option>
                                        <option>Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


    {{-- col-4 --}}

                            <div class="form-group row">
                                <div class="col-6  ">
                                <label for="website" class=" col-form-label"> <i class="fa fa-globe text-primary" aria-hidden="true"></i> {{ __('Website') }}</label>
                                    <input  placeholder="http://www.example.com" id="website" type="url" class="form-control @error('website') border-danger text-danger is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website" autofocus>
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6  ">
                                <label for="field" class=" col-form-label"> <i class="fa fa-shopping-bag text-primary" aria-hidden="true"></i> {{ __('field') }}</label>

                                    <select id="my-select"  class="custom-select border-primary @error('field') border-danger text-danger is-invalid @enderror" name="field" value="{{ old('field') }}" required autocomplete="field" autofocus>
                                        <option selected value="">Select Field</option>
                                        <option>Android</option>
                                        <option>BackEnd</option>
                                        <option>FrontEnd</option>
                                        <option>UI/UX</option>
                                        <option>Others</option>
                                    </select>
                                    @error('field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

    {{-- col-5 --}}

                            <div class="form-group row">
                                <div class="col-6">
                                <label for="country" class=" col-form-label"> <i class="fa fa-flag text-primary" aria-hidden="true"></i> {{ __('Country') }}</label>
                                <select id="country" style="cursor: pointer;"  oninput="getCountries()" class="custom-select border-primary @error('country') border-danger text-danger is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
                                    <option selected value="">Select Field</option>
                                </select>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6">
                                <label for="city" class=" col-form-label"> <i class="fa fa-map-marker text-primary" aria-hidden="true"></i> {{ __('City') }}</label>
                         <select id="state"   style="cursor: pointer;" class="custom-select border-primary @error('city') border-danger text-danger is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                        <option selected value="">Select City</option>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- mobile -->
    <div class=" mt-4 d-md-none d-block " style="height: 180vh;" id="hero">
    <div id="overlay2" class="pt-5" style="height: 180vh !important;">
        <form  class="row  mx-0 justify-content-center"  method="POST" action="/blade-update" enctype="multipart/form-data">
            @csrf
            <div class="card-header bg-transparent border-0 pb-0">
                <h3 class="text-white  text-center ">{{ __('Create Profile') }} <i class="fa fa-user" aria-hidden="true"></i>&emsp;     <a href="/" >Skip</a> </h3>
                    <!-- <hr class="border-white"> -->
                </div>
            <div class="col-md-4  text-center">
                <img src="{{ asset('/images/avater.png') }}" id="outputM" style="width: 220px;height: 220px; border-radius: 120px;"   class=" shadow" alt="">
                <div class="form-group row mt-2">
                    <div class="col-md-12 px-5">
                          <p class="p-2  mx-5" style="border: 2px dashed #3490dc;">
                                <input id="my-input" accept="image/*" onchange="loadFileM(event)" class="form-control-file border-0" type="file" name="photo">
                          </p>
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="col-11 col-sm-10 p-0">
                <div class="card  border-0 bg-transparent text-info" >

                    <div class="card-body p-0 ">
    {{-- col1 --}}
                            <div class="form-group row">
                                <div class="col-6 px-1  ">
                                <label for="first_name" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('First Name') }}</label>
                                    <input maxlength="25"  placeholder="e.g( Peter )" id="first_name" type="text" class="form-control @error('first_name') border-danger text-danger is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6 px-1  ">
                                <label for="last_name" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('Last Name') }}</label>

                                    <input maxlength="25" placeholder="e.g( Parker )" id="email" type="text" class="form-control @error('last_name') border-danger text-danger is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



    {{-- col2 --}}

                            <div class="form-group row">
                                <label for="phone" class="col-md-12 col-form-label "><i class="fa fa-phone text-primary" aria-hidden="true"></i> {{ __('Phone') }}</label>

                                <div class="col-md-12 px-1  ">
                                    <input maxlength="11" placeholder="e.g( +123 )"    id="phone" type="text" class="form-control @error('phone') is-invalid text-danger border-danger @enderror" name="phone" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    {{-- col-3 --}}
                            <div class="form-group row">
                                <div class="col-6 px-1  ">
                                <label for="dob" class=" col-form-label"> <i class="fa fa-calendar text-primary" aria-hidden="true"></i> {{ __('Date Of Birth') }}</label>
                                    <input  placeholder="e.g( Peter )" id="dob" type="date" class="form-control @error('dob') border-danger text-danger is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6 px-1  ">
                                <label for="gender" class=" col-form-label"> <i class="fa fa-male text-primary" aria-hidden="true"></i><i class="fa fa-female text-primary" aria-hidden="true"></i> {{ __('Gender') }}</label>

                                    <select id="my-select"  class="custom-select border-primary @error('gender') border-danger text-danger is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                        <option selected value="">Select Gender</option>
                                        <option >Male</option>
                                        <option>Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


    {{-- col-4 --}}

                            <div class="form-group row">
                                <div class="col-6 px-1  ">
                                <label for="website" class=" col-form-label"> <i class="fa fa-globe text-primary" aria-hidden="true"></i> {{ __('Website') }}</label>
                                    <input  placeholder="http://www.example.com" id="website" type="url" class="form-control @error('website') border-danger text-danger is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website" autofocus>
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6  px-1  ">
                                <label for="field" class=" col-form-label"> <i class="fa fa-shopping-bag text-primary" aria-hidden="true"></i> {{ __('Field') }}</label>

                                    <select id="my-select"  class="custom-select border-primary @error('field') border-danger text-danger is-invalid @enderror" name="field" value="{{ old('field') }}" required autocomplete="field" autofocus>
                                        <option selected value="">Select Field</option>
                                        <option >Android</option>
                                        <option>BackEnd</option>
                                        <option>FrontEnd</option>
                                        <option>UI/UX</option>
                                        <option>Others</option>
                                    </select>
                                    @error('field')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

    {{-- col-5 --}}

                            <div class="form-group row">
                                <div class="col-6 px-1 ">
                                <label for="country" class=" col-form-label"> <i class="fa fa-flag text-primary" aria-hidden="true"></i> {{ __('Country') }}</label>
                                <select id="countryM" style="cursor: pointer;"  oninput="getCountriesM()" class="custom-select border-primary @error('country') border-danger text-danger is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Field</option>
                                </select>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6 px-1 ">
                                <label for="city" class=" col-form-label"> <i class="fa fa-map-marker text-primary" aria-hidden="true"></i> {{ __('City') }}</label>
                         <select id="stateM"   style="cursor: pointer;" class="custom-select border-primary @error('city') border-danger text-danger is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                        <option selected value="">Select City</option>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-12 text-left col-form-label "><i class="fa fa-edit text-primary" aria-hidden="true"></i> {{ __('Status') }}</label>

                                <div class="col-md-12 px-1 ">
                                    <textarea placeholder="e.g( +123 )"  rows="5"  id="status" type="text" class="form-control @error('status') is-invalid text-danger border-danger @enderror" name="status" required autocomplete="status"></textarea>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 px-1  ">
                                    <button type="submit" class="btn w-100 shadow btn-primary">
                                        {{ __('Create') }}
                                    </button>

                                </div>
                            </div>


                    </div>
                </div>
            </div>

        </form>
    </div>
    </div>
</body>
</html>
<!-- html -->
