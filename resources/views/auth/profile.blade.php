@extends('layouts.app')

@section('content')
<title>WebsoftConnect | Create Profile</title>
<!-- desktop -->
<div class="container-fluid d-md-block d-block ">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10 col-12 col-xl-8 pt-3 pr-0">
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 pb-0">
                <h4 class="text-primary  text-center ">{{ __('Create Profile') }} <i class="fa fa-user" aria-hidden="true"></i></h4>
                    <hr >
                </div>
                <div class="card-body py-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
{{-- col1 --}}
                        <div class="form-group row">
                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('First Name') }}</label>
                                <input  placeholder="e.g( Peter )" id="email" type="email" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('Last Name') }}</label>

                                <input  placeholder="e.g( Parker )" id="email" type="text" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



{{-- col2 --}}

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-phone text-primary" aria-hidden="true"></i> {{ __('Phone') }}</label>

                            <div class="col-md-12 p-1">
                                <input placeholder="e.g( +123 )"    id="password" type="text" class="form-control @error('password') is-invalid text-danger border-danger @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{-- col-3 --}}
                        <div class="form-group row">
                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-calendar text-primary" aria-hidden="true"></i> {{ __('Dob') }}</label>
                                <input  placeholder="e.g( Peter )" id="email" type="date" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-male text-primary" aria-hidden="true"></i><i class="fa fa-female text-primary" aria-hidden="true"></i> {{ __('Gender') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Gender</option>
                                    <option >Male</option>
                                    <option>Female</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


{{-- col-4 --}}

                        <div class="form-group row">
                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-globe text-primary" aria-hidden="true"></i> {{ __('Website') }}</label>
                                <input  placeholder="http://www.example.com" id="email" type="url" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-shopping-bag text-primary" aria-hidden="true"></i> {{ __('Field') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Field</option>
                                    <option >Android</option>
                                    <option>BackEnd</option>
                                    <option>FrontEnd</option>
                                    <option>UI/UX</option>
                                    <option>Others</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{-- col-5 --}}

                        <div class="form-group row">
                            <div class="col-6 p-1">
                            <label for="email" class=" col-form-label"> <i class="fa fa-flag text-primary" aria-hidden="true"></i> {{ __('Country') }}</label>
                            <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <option selected value="">Select Field</option>
                                <option >Android</option>
                                <option>BackEnd</option>
                                <option>FrontEnd</option>
                                <option>UI/UX</option>
                                <option>Others</option>
                            </select>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-6 p-1   ">
                            <label for="email" class=" col-form-label"> <i class="fa fa-map-marker text-primary" aria-hidden="true"></i> {{ __('City') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Field</option>
                                    <option >Android</option>
                                    <option>BackEnd</option>
                                    <option>FrontEnd</option>
                                    <option>UI/UX</option>
                                    <option>Others</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-edit text-primary" aria-hidden="true"></i> {{ __('Status') }}</label>

                            <div class="col-md-12 p-1">
                                <textarea placeholder="e.g( +123 )"    id="password" type="text" class="form-control @error('password') is-invalid text-danger border-danger @enderror" name="password" required autocomplete="current-password"></textarea>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-phone text-primary" aria-hidden="true"></i> {{ __('Profile Picture') }}</label>

                            <div class="col-md-12 p-1">
                                  <p class="p-3" style="border: 2px dashed royalblue;">
                                        <input id="my-input" class="form-control-file border-0" type="file" name="">
                                  </p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12  p-1">
                                <button type="submit" class="btn w-100 shadow btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile -->
<div class="container-fluid d-md-none d-none " style="height: 180vh;" id="hero">
<div id="overlay2" class="pt-4" style="height: 180vh !important;">
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
{{-- col1 --}}
                        <div class="form-group row">
                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('First Name') }}</label>
                                <input  placeholder="e.g( Peter )" id="email" type="email" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-pencil text-primary" aria-hidden="true"></i> {{ __('Last Name') }}</label>

                                <input  placeholder="e.g( Parker )" id="email" type="text" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



{{-- col2 --}}

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label "><i class="fa fa-phone text-primary" aria-hidden="true"></i> {{ __('Phone') }}</label>

                            <div class="col-md-12">
                                <input placeholder="e.g( +123 )"    id="password" type="text" class="form-control @error('password') is-invalid text-danger border-danger @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{-- col-3 --}}
                        <div class="form-group row">
                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-calendar text-primary" aria-hidden="true"></i> {{ __('Dob') }}</label>
                                <input  placeholder="e.g( Peter )" id="email" type="date" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-male text-primary" aria-hidden="true"></i><i class="fa fa-female text-primary" aria-hidden="true"></i> {{ __('Gender') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Gender</option>
                                    <option >Male</option>
                                    <option>Female</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


{{-- col-4 --}}

                        <div class="form-group row">
                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-globe text-primary" aria-hidden="true"></i> {{ __('Website') }}</label>
                                <input  placeholder="http://www.example.com" id="email" type="url" class="form-control @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-shopping-bag text-primary" aria-hidden="true"></i> {{ __('Field') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Field</option>
                                    <option >Android</option>
                                    <option>BackEnd</option>
                                    <option>FrontEnd</option>
                                    <option>UI/UX</option>
                                    <option>Others</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{-- col-5 --}}

                        <div class="form-group row">
                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-globe text-primary" aria-hidden="true"></i> {{ __('Website') }}</label>
                            <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <option selected value="">Select Field</option>
                                <option >Android</option>
                                <option>BackEnd</option>
                                <option>FrontEnd</option>
                                <option>UI/UX</option>
                                <option>Others</option>
                            </select>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6">
                            <label for="email" class=" col-form-label"> <i class="fa fa-shopping-bag text-primary" aria-hidden="true"></i> {{ __('Field') }}</label>

                                <select id="my-select"  class="form-control border-primary @error('email') border-danger text-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <option selected value="">Select Field</option>
                                    <option >Android</option>
                                    <option>BackEnd</option>
                                    <option>FrontEnd</option>
                                    <option>UI/UX</option>
                                    <option>Others</option>
                                </select>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
