@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Reset</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-none ">
    <div class="row justify-content-center">
    <div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">

    <div class="card border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Reset Password') }} <i class="fa fa-unlock" aria-hidden="true"></i></h4>
                    <hr>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                      
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
                                <input onclick="passwordActionClick()"   oninput="passwordAction()" id="password" type="password" class="form-control @error('password')border-danger text-danger is-invalid @enderror" name="password" required autocomplete="current-password">
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
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Confirm') }}</label>

                            <div class="col-md-12">
                                <input  id="password-confirm" type="password" class="form-control"  name="password_confirmation" required autocomplete="current-password">
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary shadow w-100">
                                    {{ __('Reset Password') }}
                                </button>
                                <br>
                                <a href="/login" class="btn mt-3 btn-default border-primary text-primary w-100 shadow">
                                    {{ __('Not my account') }}
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

    <div class="row justify-content-center">
    <div class="col-12 col-sm-10 pt-3 ">

    <div class="card  bg-transparent border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Reset Password') }} <i class="fa fa-unlock" aria-hidden="true"></i></h4>
                <hr class="bg-white">

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                      
                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-info"> <i class="fa fa-envelope-o text-primary" aria-hidden="true"></i> {{ __('Email') }}</label>

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
                            <label for="password" class="col-md-12  text-info col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input onclick="passwordActionClickM()"   oninput="passwordActionM()" id="passwordM" type="password" class="form-control @error('password')border-danger text-danger is-invalid @enderror" name="password" required autocomplete="current-password">
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
                            <label for="password" class="col-md-12 text-info col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Confirm') }}</label>

                            <div class="col-md-12">
                                <input  id="password-confirm" type="password" class="form-control"  name="password_confirmation" required autocomplete="current-password">
                               
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary shadow w-100">
                                    {{ __('Reset Password') }}
                                </button> 
                                <br>
                                <a href="/login" class="btn mt-3 btn-default border-primary text-primary w-100 shadow">
                                    {{ __('Not my account') }}
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
