@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Confirm</title>

<div class="container-fluid d-md-block d-none ">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">
            <div class="card border-0"> 
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Confirm Password') }} <i class="fa fa-key" aria-hidden="true"></i></h4>
                    <hr>
                </div>
                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                        <label for="password" class="col-md-12 col-form-label "><i class="fa fa-lock text-primary" aria-hidden="true"></i> {{ __('Password') }}</label>


                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid border-danger text-danger @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
