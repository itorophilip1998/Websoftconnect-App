@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Email</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-none">
    <div class="row justify-content-center ">
    <div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">

            <div class="card border-0 ">
            <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Send Reset Notification') }} <i class="fa fa-envelope" aria-hidden="true"></i></h4>
                    <hr>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('errro') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100 shadow">
                                    {{ __('Send Password Reset Link') }}
                                </button> <br>
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
<div class="container-fluid d-md-none d-block" id="hero">
<div id="overlay2" class="pt-4">

    <div class="row justify-content-center ">
    <div class="col-12 col-sm-10 pt-3 ">

            <div class="card bg-transparent border-0 ">
            <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Send Reset Notification') }} <i class="fa fa-envelope" aria-hidden="true"></i></h4>
                    <hr class="bg-white">
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('errro') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

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

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100 shadow">
                                    {{ __('Send Password Reset Link') }}
                                </button> <br>
                                <a href="/login" class="btn mt-3 btn-default border-info text-info w-100 shadow">
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
