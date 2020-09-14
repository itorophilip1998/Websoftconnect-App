@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Register</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-none ">
<div class="row justify-content-center">
<div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">
                    <h4 class="text-primary  text-center mt-2">{{ __('Create a new Account') }} <i class="fa fa-pencil" aria-hidden="true"></i></h4>
                    <hr>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <!-- name -->
                        <div class="form-group row">
                           <label for="name" class="col-md-12 col-form-label "> <i class="fa fa-user-o text-primary" aria-hidden="true"></i> {{ __('Username') }}  </label>

                            <div class="col-md-12">
                                <input maxlength="20" oninput="nameAction()"  placeholder="e.g( Peterparker )" id="name" type="text" class="form-control @error('name') text-danger border-danger  is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input maxlength="50" oninput="emailAction()"  placeholder="e.g( Peterparker@example.com )" id="email" type="email" class="form-control @error('email') text-danger border-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input maxlength="20" onclick="passwordActionClick()"   oninput="passwordAction()" id="password"  type="password" class="form-control mb-0 @error('password')  border-danger border-danger is-invalid @enderror" name="password" required autocomplete="new-password">
                                <i class="fa fa-eye text-primary" title="Show" onclick="showAction()"  id="show" style="cursor:pointer;display:block;"  aria-hidden="true"></i>
                                <i class="fa fa-eye-slash text-danger" title="Hide" onclick="hideAction()" id="hide" style="cursor:pointer;display:none;" aria-hidden="true"></i>

                                <small style="font-size:12px;display:none" id='rules'  class="text-secondary mt-0" role="alert">
                                   <ul style="color:black" class="pl-0">
                                       <li id='rules1'> <i class="fa  text-danger">*</i> password should be maximuim of 8 characters</li>
                                       <li id='rules2'><i class="fa  text-danger">*</i> password must contain a number</li>
                                       <li id='rules3'><i class="fa text-danger">*</i> password must contain small/capital letters</li>
                                   </ul>

                                </small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                            <button title="Please fill all the required Information" type="button" id="submitBtn1" style="display: block;cursor:not-allowed" disabled   class="btn btn-primary shadow w-100">
                                    {{ __('Signup') }}
                                </button>
                                <button type="submit" id="submitBtn2" style="display: none;"   class="btn btn-primary  shadow w-100">
                                    {{ __('Signup') }}
                                </button>
                               <small> I have account arleady </small><a class="btn btn-link pl-0 ml-0" href="/login">
                                        {{ __('Login?') }}
                                    </a>
                                <hr>
                                 <a href="/socialite/github" class="btn shadow  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __(' Login with Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-3 shadow  btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __(' Login with Google') }}
                                </a>

                            </div>
                        </div>
                    </form>
    </div>
</div>
</div>
<!-- mobile -->
<div class="container-fluid d-md-none d-block p-0 pb-5  " id="hero">
<div id="overlay2" class="pt-4">
    <div class="row justify-content-center text-info m-0">

    <div class="col-10 col-sm-10 " >
                    <h5 class="text-info  text-center">{{ __('Create a new Account') }} <i class="fa fa-pencil" aria-hidden="true"></i></h5>
                    <hr class="border-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                         <!-- name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-12 col-form-label "><i class="fa fa-user text-primary" aria-hidden="true"></i> {{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input maxlength="20" oninput="nameActionM()"  placeholder="e.g( Peterparker )" id="nameM" type="text" class="form-control @error('name') text-danger border-danger is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input maxlength="50"  oninput="emailActionM()" placeholder="e.g( Peterparker@example.com )" id="emailM" type="email" class="form-control @error('email') text-danger border-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input maxlength="20" onchange="passwordActionM()"   oninput="passwordActionM()" id="passwordM"  type="password" class="form-control mb-0 @error('password')  border-danger border-danger is-invalid @enderror" name="password" required autocomplete="new-password">
                                <i class="fa fa-eye text-primary" title="Show" onclick="showActionM()"  id="showM" style="cursor:pointer;display:block;"  aria-hidden="true"></i>
                                <i class="fa fa-eye-slash text-danger" title="Hide" onclick="hideActionM()" id="hideM" style="cursor:pointer;display:none;" aria-hidden="true"></i>

                                <small style="font-size:12px;display:none" id='rulesM'  class="text-secondary mt-0" role="alert">
                                   <ul style="color:whitesmoke;" class="pl-0">
                                       <li id='rules1M'> <i class="fa  text-danger">*</i> password should be maximuim of 8 characters</li>
                                       <li id='rules2M'><i class="fa  text-danger">*</i> password must contain a number</li>
                                       <li id='rules3M'><i class="fa text-danger">*</i> password must contain small/capital letters</li>
                                   </ul>

                                </small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                            <button title="Please fill all the required Information" type="button" id="submitBtn1M" style="display: block;cursor:not-allowed" disabled   class="btn btn-primary w-100">
                                    {{ __('Signup') }}
                                </button>
                                <button type="submit" id="submitBtn2M" style="display: none;"   class="btn btn-primary w-100">
                                    {{ __('Signup') }}
                                </button>
                                <small class="text-white">I have an account already</small> <a class="btn btn-link text-info pl-0 ml-0" href="/login">
                                        {{ __('Login?') }}
                                    </a>
                                <hr class="bg-white">
                                 <a href="/socialite/github" class="btn  w-100 btn-secondary">
                                  <i class="fa fa-github" aria-hidden="true"></i>
                                   {{ __(' Login with Github') }}
                                </a>

                                <a href="/socialite/google" class="btn w-100 mt-3  btn-danger">
                                   <i class="fa fa-google" aria-hidden="true"></i>
                                   {{ __(' Login with Google') }}
                                </a>

                            </div>
                        </div>
                    </form>
    </div>
</div></div>

    </div>

@endsection
