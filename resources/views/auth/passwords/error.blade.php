@extends('layouts.app')

@section('content')
<title>Error</title>

<div class="container-fluid pl-1">
    <div class="row justify-content-center">
        <div class="col-md-11 mt-5">
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <a href="/password/reset" class="close" >
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
                 </a>
                 <strong><i class="fa fa-bell" aria-hidden="true"></i> Error Notification</strong> <br>
                  Please user, there was and error while trying to reset password, please check your internet connection... <br>
                  <a href="/password/reset" class="btn text-white bg-danger btn-sm">Try Again</a>
             </div>
        </div>
    </div>
</div>
@endsection
