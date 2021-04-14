
 @extends('layout')
@section('content')
    <!-- Main content -->
    <section class="slice py-7">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                    <!-- Image -->
                    <figure class="w-100">
                        <img alt="Image placeholder" src="assets/img/svg/illustrations/illustration-3.svg" class="img-fluid mw-md-120">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                    <!-- Heading -->
                    <h1 class="display-4 text-center text-md-left mb-3">
                            Developers Co<span class="text-danger">m</span><span class="text-primary">m</span>unity...
                    </h1>
                    <p class="lead text-center text-md-left text-muted" >Communicate with proffesional and intermidate developers who knows better and also share your ideas to solve other people's problem.</p>


                    <!-- Buttons -->
                    <div class="text-center text-md-left mt-5">
                        <a href="/register" class="btn btn-primary btn-icon">
                            <span class="btn-inner--text">Get started</span>
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice slice-lg pt-lg-6 pb-0 pb-lg-6 bg-section-secondary">
        <div class="container">

            <!-- Title -->
            <div class="row mb-5 justify-content-center text-center" id="start">
                <div class="col-lg-6">

                    <h2 class=" mt-4">HOW CAN I START?</h2>
                    <div class="mt-2">
                        <p class="lead lh-180">Share your problems and get solutions here, so let go -></p>
                    </div>
                </div>
            </div>
            <!-- Card -->
            <div class="row mt-5 ">
                <div class="col-md-4 zoom">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="assets/img/svg/illustrations/illustration-5.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">Create a new Account</h5>
                            <p class="text-muted mb-0">  As a new user, click getstarted to create an account and fill all the required information.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 zoom">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="assets/img/svg/illustrations/illustration-6.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3 ">Set up your Profile &emsp; &emsp; </h5>
                            <p class="text-muted mb-0"> After creating a new account, set up your profile and fill in all the required information.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 zoom">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="assets/img/svg/illustrations/illustration-7.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">Share ideas by Chat/Post</h5>
                            <p class="text-muted mb-0"> You can share your ideas with your fellow by posting videos, pictures and chats.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="slice slice-lg pb-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <span class="badge badge-primary badge-pill">Key features</span>
                    <h5 class="lh-180 mt-4 mb-6">Websoft Connect is a plateform where you can share your ideas  or ask questions and get solution with just a post, comment or chats .
                    </h5>
                </div>
            </div>
            <!-- Features -->
            <div class="row mx-lg-n4">
                <!-- Features - Col 1 -->
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-warning text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Chats</span>
                                <p class="text-sm text-muted mb-0">
                                   Private communication
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-primary text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Video Calls</span>
                                <p class="text-sm text-muted mb-0">
                                   Video Communication
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-danger text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Voice Note</span>
                                <p class="text-sm text-muted mb-0">
                                    Voice Message
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-success text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Video Tutorials</span>
                                <p class="text-sm text-muted mb-0">
                                   Video Upload/download
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-info text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Realtime Notification</span>
                                <p class="text-sm text-muted mb-0">
                                    Get Realtime Alert
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 px-lg-4">
                    <div class="card shadow">
                        <div class="p-3 d-flex">
                            <div>
                                <div class="icon icon-shape rounded-circle bg-warning text-white mr-4">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <div>
                                <span class="h6">Oath Login</span>
                                <p class="text-sm text-muted mb-0">
                                   Login with Oath
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

     <!-- section testimonials -->
     <section class="testimonials p-3" id="testimonials">
        <h2 class="text-center mt-5"> TESTIMONIALS </h2>
        <div class="mt-2 text-center">
            <p class="lead lh-180">Client Messages with testimonies</p>
        </div>
                 <div class="testimonails">
                     <div class="row content-justify-center">
                         <div class="col-md-4 col-sm-6 zoom  m-auto">
                             <div class="card shadow my-4">
                                 <div class="card-body">
                                     <h5 class="card-title">
                                     <a href="{{asset('images/testimonial2.jpg')}}"> <img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial2.jpg')}}" alt=""></a> Sylvester Udoh</h5>
                                     <p class="card-text text-dark text-justify">
                                         I will start by thanking websoft very much for giving intermediate developer a change to communicate with other developers dispite the level of proffesion.
                                         I have almost all my  bugs  solve here, because they give solutions to my problems quickly.
                                         <br>
                                         <b>Back-End Developer </b>
                                     </p>


                                 </div>
                             </div>

                         </div>
                         <div class="col-md-4 col-sm-6 zoom m-auto">
                         <div class="card shadow my-4">
                                 <div class="card-body">
                                     <h5 class="card-title">
                                        <a href="{{asset('images/testimonial3.jpg')}}"><img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial3.jpg')}}" alt=""></a> Ubong Keyzz</h5>
                                     <p class="card-text text-dark text-justify">
                                         I was tired at first when i tried searching for a solution that i did`nt see on google and other platform, i now realise that not all physical problem can be seen on google, websoft has really help my career alot, they give me solutions to my problem with immediate effect.
                                    <br> <b>UI-UX Designer </b>

                                     </p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4 col-sm-6 zoom m-auto">
                         <div class="card shadow my-4">
                                 <div class="card-body">
                                     <h5 class="card-title ">
                                     <a href="{{asset('images/testimonial4.jpg')}}"><img class="testimonailsImg rounded-circle" src="{{asset('images/testimonial4.jpg')}}" alt=""></a> Idorenyin Smart</h5>
                                     <p class="card-text text-dark">I always waste my data watching videos that most times never given me solution to what i needed,   i watse my time talking to proffesional developers who never given me time but when i started using websoft i figured out that they solved my problem the most.
                                     <br> <b>Front-End Engineer </b>
                                     </p>

                                   </div>
                             </div>
                         </div>
                     </div>
                 </div>
        </section>
   @endsection
