@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Login</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-none ">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Signin') }} <i class="fa fa-user" aria-hidden="true"></i></h4>
                    <hr>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label"> <i class="fa fa-envelope-o text-primary" aria-hidden="true"></i> {{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input  placeholder="e.g( Peterparker@example.com )" id="email" type="email" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input onclick="passwordActionClick()"   oninput="passwordAction()" id="password" type="password" class="form-control @error('password') is-invalid text-danger border-danger @enderror" name="password" required autocomplete="current-password">
                                <i class="fa fa-eye text-primary" title="Show" onclick="showAction()"  id="show" style="cursor:pointer;display:block;"  aria-hidden="true"></i>
                                <i class="fa fa-eye-slash text-danger" title="Hide" onclick="hideAction()" id="hide" style="cursor:pointer;display:none;" aria-hidden="true"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn shadow btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link pl-0 ml-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <br>
                                <small class="text-dark">I don`t have an account</small> <a class="btn btn-link pl-0 ml-0" href="/register">
                                        <u>{{ __('signin?') }}</u>
                                    </a>
                            </div>
                            <div class="col-12">
                            <hr>
                                 <a href="/socialite/github" class="btn col-12 shadow  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __('Login with Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-2 shadow col-12 btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __('Login with Google') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile -->
<div class="container-fluid d-md-none d-block " id="hero">
<div id="overlay2" class="pt-4">
    <div class="row justify-content-center m-0">
        <div class="col-12 col-sm-10 pt-3 ">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-info  text-center ">{{ __('Signin') }} <i class="fa fa-user" aria-hidden="true"></i></h4>
                <hr class="bg-white">

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-info "> <i class="fa fa-envelope-o text-primary" aria-hidden="true"></i> {{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input  placeholder="e.g( Peterparker@example.com )" id="emailM" type="email" class="form-control @error('email') border-danger text-info  text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-info  "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input onclick="passwordActionClickM()"   oninput="passwordActionM()" id="passwordM" type="password" class="form-control @error('password') is-invalid text-danger border-danger @enderror" name="password" required autocomplete="current-password">
                                <i class="fa fa-eye text-primary" title="Show" onclick="showActionM()"  id="showM" style="cursor:pointer;display:block;"  aria-hidden="true"></i>
                                <i class="fa fa-eye-slash text-danger" title="Hide" onclick="hideActionM()" id="hideM" style="cursor:pointer;display:none;" aria-hidden="true"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-info  pl-0 ml-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <br>
                                <small class="text-white">I don`t have an account</small> <a class="btn btn-link text-info pl-0 ml-0" href="/register">
                                        <u>{{ __('signin?') }}</u>
                                    </a>
                            </div>
                            <div class="col-12">
                            <hr class="bg-white">
                                 <a href="/socialite/github" class="btn col-12  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __('Login with Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-2  col-12 btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __('Login with Google') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
