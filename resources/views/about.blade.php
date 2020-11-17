@extends('layout')

@section('content')
    <!-- Main content -->
    <section class="slice py-8 bg-dark">
        <div class="container py-5">
            <div class="row row-grid align-items-center">
                <div class="col-lg-8 text-center text-lg-left">
                    <!-- Heading -->
                    <h1 class="text-white mb-4">
                        We Connect, We Develop, We Create Opportuinities and ideas
                    </h1>
                    <!-- Text -->
                    <p class="lead text-white opacity-8">
                       Eazy coding and fast solution in every problem, youtube might not always be the best solution but WebsoftConnect might be.
                    </p>
                    <!-- Buttons -->
                    <div class="mt-5">
                        <a href="/contact_us" class="btn btn-warning btn-lg btn-icon">
                            <span class="btn-inner--icon">
                                <i data-feather="edit-3"></i>
                            </span>
                            <span class="btn-inner--text">Contact us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG separator -->
        <div class="shape-container shape-line shape-position-bottom">
            <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
                <polygon points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="slice slice-lg" id="services">
        <div class="container">
            <span class="badge badge-primary badge-pill">Our Mission</span>
            <div class="row mt-4">
                <div class="col-lg-6 pr-lg-5">
                    <p class="h5 lh-180 mb-3">
                        Our mission is to connect  intermediate developers with senior developers and professional developers to share ideas and experience in tech and also solve problems by responding to post and chat  as well as comments.

                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="lead lh-180">
                        WebsoftConnect was Design and developed by
                        Itoro Emmanuel Philip.
                    </p>
                    <p class="lead lh-180">
                        A Fullstack Developer Working @ Stathub Innovation hub uyo.
                    WebsoftConnect is an app own by Websoft Company..

                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="slice slice-lg pt-10 bg-primary" id="terms">
        <!-- SVG separator -->
        <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
            <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
                <polygon points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Badge -->
                    <span class="badge badge-warning badge-pill">Terms and Condition</span>
                    <!-- Title -->
                    <h2 class="my-4 text-white">These are the rules governing WebsoftConnect</h2>
                    <!-- Text -->
                    <p class="lead text-white lh-190">
                        <ul class="text-white">
                            <li>WebsoftConnect allows you to connect with other developers to share ideas but if any body lay a complain or report that he or she was harrased by a user, the user account will be suspended for 3days.</li>
                            <li>No user should upload Nudes,or pornographic videos, if caught penalty will be (blocking the account totally).</li>
                            <li>No user should bring any religious, political or any topic different from tech in the platform, else penalty will be (banning account for 3hours). </li>
                            <li>No user should insult,abuse, or comment in an evil manner to any post, else user will be limited to a whole post of that particular user. </li>
                            <li>All these is to help maintain a humanful behaviour in other to connect and unit developers, please do well to adhere to the terms and condition governing websoft connect.</li>
                        </ul>

                    </p>
                </div>

            </div>
            <!-- Milestones -->
            {{-- <div class="row mt-6">

            </div> --}}
        </div>
    </section>
    <section class="slice slice-lg pb-5">
        <div class="container">
            <!-- Section title -->
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-8 col-md-10">
                    <h2 class=" mt-4">The amazing team</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-1.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">Itoro Emmanuel Philip</h5>
                            <p class="text-muted text-sm mb-0">CEO & Founder</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-2.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">Monroe Parker</h5>
                            <p class="text-muted text-sm mb-0">Back End Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-3.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">John Sullivan</h5>
                            <p class="text-muted text-sm mb-0">Front End Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-4.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">James Lewis</h5>
                            <p class="text-muted text-sm mb-0">Vice Chairman</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-5 mb-sm-0">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-5.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">Danielle Levin</h5>
                            <p class="text-muted text-sm mb-0">Sales Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-5 mb-sm-0">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-6.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">Martin Gray</h5>
                            <p class="text-muted text-sm mb-0">UI/UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-5 mb-sm-0">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-7.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">George Squier</h5>
                            <p class="text-muted text-sm mb-0">Marketing Executive</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-0">
                    <div data-animate-hover="2">
                        <div class="animate-this">
                            <a href="#">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="assets/img/theme/light/person-8.jpg">
                            </a>
                        </div>
                        <div class="mt-3">
                            <h5 class="h6 mb-0">Jesse Stevens</h5>
                            <p class="text-muted text-sm mb-0">Ads Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
