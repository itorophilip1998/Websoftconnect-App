@extends('layout')

@section('content')
    <!-- Main content -->
    <section class="slice py-6 pt-lg-7 pb-lg-8 bg-dark">
        <!-- Container -->
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-lg-6">
                    <!-- Heading -->
                    <h1 class="h1 text-white text-center text-lg-left my-4">
                       Get our <strong>Attention</strong>
                    </h1>
                    <!-- Text -->
                    <p class="lead text-white text-center text-lg-left opacity-8">
                       Contact us, if there is any issue, let us know some info about you and how we can help you!
                    </p>
                    <!-- Buttons -->
                    <div class="mt-5 text-center text-lg-left">
                        <a href="#sct-form-contact" data-scroll-to class="btn btn-white btn-lg btn-icon">
                            <span class="btn-inner--icon">
                                <i data-feather="edit-2"></i>
                            </span>
                            <span class="btn-inner--text">Write a message</span>
                        </a>
                    </div>
                    <!-- Clients -->
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-left mt-5">
                        <div class="col-auto text-sm text-white pl-0 pr-4">Trusted by:</div>
                        <div class="client-group col">
                            <div class="row">
                                <div class="client col-3 py-3">
                                    <img alt="Image placeholder" src="assets/img/clients/svg/google-gray.svg">
                                </div>
                                <div class="client col-3 py-3">
                                    <img alt="Image placeholder" src="assets/img/clients/svg/spotify-gray.svg">
                                </div>
                                <div class="client col-3 py-3">
                                    <img alt="Image placeholder" src="assets/img/clients/svg/airbnb-gray.svg">
                                </div>
                                <div class="client col-3 py-3">
                                    <img alt="Image placeholder" src="assets/img/clients/svg/paypal-gray.svg">
                                </div>
                            </div>
                        </div>
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

    <section class="slice slice-lg">
        <div class="container">
            <div class="row row-grid justify-content-between align-items-center">
                <div class="col-lg-5">
                    <h3>Elibrary off Ibb<br>Uyo, Akwa Ibom State,Nigeria.</h3>
                    <p class="lead my-4">
                        E: <a href="#">support@websoft.io</a><br>
                        T: (+234) 9024195493
                    </p>
                    <p>
                        Want to share any feedback with us, report a technical issue or just ask us a question? Fill free to contact us and we will get back to you shortly.
                    </p>
                </div>
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830872278!2d-74.1197639579598!3d40.69766374873451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sro!4v1580299124407!5m2!1sen!2sro" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="true" class="rounded"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="slice slice-lg" id="sct-form-contact">
        <div class="container position-relative zindex-100">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6 text-center">
                    <h3>Contact us</h3>
                    <p class="lh-190">If there's something we can help you with, jut let us know. We'll be more than happy to offer you our help</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>

                       <strong>Hello  {{ Session::get('user')}}!</strong><br>
                     {{ Session::get('message')}}
                    </div>
                @endif
                    <!-- Form -->
                    <form action="/contactus"  method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="first_name" type="text" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="last_name" type="text" placeholder="Last name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="email" type="email" placeholder="email@example.com" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="phone" type="text" placeholder="+40-745-234-567" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control form-control-lg" name="message" placeholder="Tell us a few words ..." rows="3" required></textarea>
                        </div>
                        <div class="text-center">
                            <!-- <div class="g-recaptcha" data-sitekey="6Lfs5ScUAAAAANAJwGrdfvWLFRRiVbKRE2vfoaFj"></div> -->
                            <button type="reset" class="btn-reset d-none"></button>
                            <button type="submit" class="btn btn-block btn-lg btn-primary mt-4">Send your message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
