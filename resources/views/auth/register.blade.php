@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Register</title>
<!-- desktop -->
<div class="container d-md-block d-none ">
<div class="row justify-content-center">
        <div class="col-md-10 col-lg-7" >
                    <h4 class="text-primary  text-center mt-2">{{ __('Create a new Account') }} <i class="fa fa-pencil" aria-hidden="true"></i></h4>
                    <hr>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <!-- name -->
                        <div class="form-group row">
                           <label for="name" class="col-md-12 col-form-label "> <i class="fa fa-user-o text-primary" aria-hidden="true"></i> {{ __('Username') }}  </label>

                            <div class="col-md-12">
                                <input placeholder="e.g( Peterparker )" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <!-- email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label "> <i class="fa fa-envelope-o text-primary" aria-hidden="true"></i> {{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input placeholder="e.g( Peterparker@example.com )" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small style="font-size:12px" class="text-secondary" role="alert">
                                   <ul>
                                       <li>password should be maximuim of 8 characters</li>
                                       <li>password must contain a number</li>
                                       <li>password must contain small/capital letters</li>
                                   </ul>

                                </small>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Signup') }}
                                </button>
                                <hr>
                             <span class="d-block text-center">Or Login with</span>
                                 <a href="/socialite/github" class="btn  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __('Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-3  btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __('Google') }}
                                </a>

                            </div>
                        </div>
                    </form>
    </div>
</div>
</div>
<!-- mobile -->
<div class="container d-md-none d-block p-0 pb-5  " id="hero">
<div id="overlay2" class="pt-4">
    <div class="row justify-content-center text-info m-0">

    <div class="col-10 col-sm-9" >
                    <h5 class="text-info  text-center">{{ __('Create a new Account') }} <i class="fa fa-pencil" aria-hidden="true"></i></h5>
                    <hr class="border-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <!-- name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label "><i class="fa fa-user text-primary" aria-hidden="true"></i> {{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input placeholder="e.g( Peterparker )" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <!-- email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label "><i class="fa fa-envelope text-primary" aria-hidden="true"></i> {{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input placeholder="e.g( Peterparker@example.com )" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" oninput="rulesAction" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small style="font-size:10px" id='rules' class="text-secondary" role="alert">
                                   <ul style="color:lightgrey">
                                       <li>password should be maximuim of 8 characters</li>
                                       <li>password must contain a number</li>
                                       <li>password must contain small/capital letters</li>
                                   </ul>

                                </small>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Signup') }}
                                </button>
                                <hr>
                             <span class="d-block text-center">Or Login with</span>
                                 <a href="/socialite/github" class="btn  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __('Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-3  btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __('Google') }}
                                </a>

                            </div>
                        </div>
                    </form>
    </div>
</div></div>

    </div>

@endsection
