@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Verify</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-none ">

    <div class="row justify-content-center">
    <div class="col-md-11 col-lg-10 col-11 col-xl-8 pt-3">
 
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Verify Your Email Address') }} <i class="fa fa-envelope-open" aria-hidden="true"></i></h4>
                    <hr>
                </div>
                <div class="card-body border rounded-lg">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <br>
                    <form class="d-inline mt-2" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn  btn-primary  align-baseline ">{{ __('Click here to request another') }}</button>
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

                
                <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h5 class="text-info  text-center ">{{ __('Verify Your Email Address') }} <i class="fa fa-user" aria-hidden="true"></i></h5>
                <hr class="bg-white"> 
                </div>
                <div class="card-body border-info text-white">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <br>
                    <form class="d-inline nt-2" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn text-info border-info  align-baseline ">{{ __('Click here to request another') }}</button>
                    </form>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection
