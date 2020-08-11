<?php /*<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>


            </div>
        </div>
        <div id="app">

        </div>
  <link href="{{ asset('css/template/main.css') }}" rel="stylesheet">

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
 //template from https://colorlib.com/preview/theme/hookup/
 */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Katie & Parker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Caslon+Text:400,400i,700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/template/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/aos.css') }}" rel="stylesheet">
    <?php /*<link href="{{ asset('css/template/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template/icomoon.css') }}" rel="stylesheet">*/ ?>
    <link href="{{ asset('css/template/style.css') }}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Katie & Parker</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
                <li class="nav-item"><a href="#groom-bride-section" class="nav-link"><span>Groom &amp; Bride</span></a></li>
                <?php //<li class="nav-item"><a href="#lovestory-section" class="nav-link"><span>Love Story</span></a></li> ?>
                <li class="nav-item"><a href="#greeting-section" class="nav-link"><span>Greetings</span></a></li>
                <li class="nav-item"><a href="#people-section" class="nav-link"><span>People</span></a></li>
                <li class="nav-item"><a href="#when-where-section" class="nav-link"><span>When &amp; Where</span></a></li>
                <li class="nav-item"><a href="#rsvp-section" class="nav-link"><span>RSVP</span></a></li>
                <li class="nav-item"><a href="#gallery-section" class="nav-link"><span>Gallery</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<section id="home" class="video-hero js-fullheight" style="height: 700px; background-image: url(img/beach2.jpg?h=700); background-size:cover; background-position: top center;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <!--<a class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=Mjjw19B7rMk',containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'default',optimizeDisplay:true}"></a>-->
    <div class="container">
        <div class="row js-fullheight justify-content-center d-flex align-items-center">
            <div class="col-md-12">
                <div class="text text-center">
                    <div class="icon">
                        <span class="flaticon-rose-outline-variant-with-vines-and-leaves"></span>
                    </div>
                    <span class="subheading">The Wedding of</span>
                    <h1>Katie &amp; Parker</h1>
                    <div id="timer" class="d-flex">
                        <div class="time" id="days"></div>
                        <div class="time pl-3" id="hours"></div>
                        <div class="time pl-3" id="minutes"></div>
                        <div class="time pl-3" id="seconds"></div>
                    </div>
                    <span class="subheading">December 19, 2020</span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section ftco-about ftco-no-pt ftco-no-pb" id="groom-bride-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap">
                    <div class="row d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="img d-flex align-self-stretch align-items-center" style="background-image:url(img/beach2.jpg);">
                            </div>
                        </div>
                        <div class="col-md-6 py-md-5 text">
                            <div class="py-md-4">
                                <div class="row justify-content-start pb-3">
                                    <div class="col-md-12 ftco-animate p-4 p-lg-5 text-center">
                                        <span class="subheading mb-4">Join us to celebrate <br>the wedding day of</span>
                                        <h2 class="mb-4">Katie <span>&amp;</span> Parker</h2>
                                        <span class="icon flaticon-rose-variant-outline-with-vines"></span>
                                        <span class="subheading">Which is celebration on</span>
                                        <p class="time mb-4"><span>Dec | 19 | 2020</span></p>
                                        <span class="subheading mb-5">Starting at 2:00 <br> in the afternoon</span>
                                        <span class="subheading mb-5">ST Paul's United Methodist Church <br> in Staunton VA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section bg-section">
    <div class="overlay-top" style="background-image: url(img/top-bg.jpg);"></div>
    <div class="overlay-bottom" style="background-image: url(img/bottom-bg.jpg);"></div>
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">Bride &amp; Groom</span>
                <h2 class="mb-3">Bride &amp; Groom</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6 text-center d-flex align-items-stretch">
                        <div class="bride-groom ftco-animate">
                            <div class="img" style="background-image: url(img/katie.jpg);"></div>
                            <div class="text mt-4 px-4">
                                <h2>Katie Keifer</h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center d-flex align-items-stretch">
                        <div class="bride-groom ftco-animate">
                            <div class="img" style="background-image: url(img/parker.jpg);"></div>
                            <div class="text mt-4 px-4">
                                <h2>Parker Dell</h2>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /*<section class="ftco-section" id="lovestory-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">Love Story</span>
                <h2 class="mb-3">Love Story</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="timeline animate-box">
                    <li class="animate-box">
                        <div class="timeline-badge" style="background-image:url(images/couple-1.jpg);"></div>
                        <div class="timeline-panel ftco-animate text-md-right">
                            <div class="overlay"></div>
                            <div class="timeline-heading">
                                <span class="date">June 10, 2017</span>
                                <h3 class="timeline-title">First We Meet</h3>
                            </div>
                            <div class="timeline-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in .</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted animate-box">
                        <div class="timeline-badge" style="background-image:url(images/couple-2.jpg);"></div>
                        <div class="timeline-panel ftco-animate">
                            <div class="overlay overlay-2"></div>
                            <div class="timeline-heading">
                                <span class="date">June 10, 2017</span>
                                <h3 class="timeline-title">First Date</h3>
                            </div>
                            <div class="timeline-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in .</p>
                            </div>
                        </div>
                    </li>
                    <li class="animate-box">
                        <div class="timeline-badge" style="background-image:url(images/couple-3.jpg);"></div>
                        <div class="timeline-panel ftco-animate text-md-right">
                            <div class="overlay"></div>
                            <div class="timeline-heading">
                                <span class="date">June 14, 2017</span>
                                <h3 class="timeline-title">In A Relationship</h3>
                            </div>
                            <div class="timeline-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in .</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted animate-box">
                        <div class="timeline-badge" style="background-image:url(images/couple-4.jpg);"></div>
                        <div class="timeline-panel ftco-animate">
                            <div class="overlay overlay-2"></div>
                            <div class="timeline-heading">
                                <span class="date">May. 10, 2019</span>
                                <h3 class="timeline-title">We're Engaged</h3>
                            </div>
                            <div class="timeline-body">
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in .</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>*/ ?>
<section class="ftco-section bg-light" id="greeting-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">COVID Policy</span>
                <h2 class="mb-3">Greetings</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <h2 class="section-title" style="text-transform: capitalize; font-family: 'Cardo',serif;">"Dearly Beloved, We are gathered here today..."</h2>
                <p><strong>Dear Ones,</strong></p>
                <p>
                    Parker and I are certain that God is very good. We are certain that we want to spend the rest of our lives together as husband and wife. But we are not certain whether we will be able to gather together with all of you this year.
                </p>
                <p>
                    Currently, Virginia's COVID-19 response would allow our wedding to take place with all of our family and friends! We are planning in the hope that this will still be the case in December. At the same time, we are preparing alternatives in the event of another shut down. I will be updating this website with our most current plan and, should there be a substantial change, I'll make sure I to get in touch with each of you.
                </p>
                <p>
                    We're also very aware that many of you may need to consider your health and safety to travel to our wedding. Please keep in touch with us! I would love to hear from you if you have concerns or if there are things that would make you feel safer at our ceremony or reception. If you must send your regrets, know that we deeply value you as part of our lives and we sincerely hope that it will be safe to visit soon!
                </p>
                <p>
                    You are all very dear to us and we could not live this life without the support of our wonderful family and friends. Thank you for your patience, grace, and love in the times of Coronavirus!
                </p>
                <p>
                    Love Katie and Parker
                </p>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section" id="people-section">
    <div class="container-fluid px-md-5">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">People</span>
                <h2 class="mb-3">Family &amp; Friends</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-friends owl-carousel ftco-owl ftco-animate">
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(img/jon.jpg);"></div>
                            <div class="text">
                                <h3>Jon Gee</h3>
                                <span>Best man</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(img/noah.jpg);"></div>
                            <div class="text">
                                <h3>Noah Dell</h3>
                                <span>Groomsmen</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/groom-men-3.jpg);"></div>
                            <div class="text">
                                <h3>Jacob Dell</h3>
                                <span>Groomsmen</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/groom-men-4.jpg);"></div>
                            <div class="text">
                                <h3>Bobby Beal</h3>
                                <span>Groomsmen</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/groom-men-4.jpg);"></div>
                            <div class="text">
                                <h3>Michael Keifer</h3>
                                <span>Groomsmen</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/bridesmaid-1.jpg);"></div>
                            <div class="text">
                                <h3>Rose Jones</h3>
                                <span>Bridesmaid</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/bridesmaid-2.jpg);"></div>
                            <div class="text">
                                <h3>Mary Dell</h3>
                                <span>Bridesmaid</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/bridesmaid-3.jpg);"></div>
                            <div class="text">
                                <h3>Alicia Brean</h3>
                                <span>Bridesmaid</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/bridesmaid-4.jpg);"></div>
                            <div class="text">
                                <h3>Angel Worth</h3>
                                <span>Bridesmaid</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="people text-center">
                            <div class="img" style="background-image: url(images/bridesmaid-4.jpg);"></div>
                            <div class="text">
                                <h3>Angel Worth</h3>
                                <span>Bridesmaid</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section bg-light" id="when-where-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">Place</span>
                <h2 class="mb-3">Place &amp; Time</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 ftco-animate">
                <div class="place img" style="background-image: url(images/place-2.jpg);">
                    <div class="text text-center">
                        <span class="icon flaticon-wedding-kiss"></span>
                        <h3>The Ceremony</h3>
                        <p><span>Saturday, 28, 2019</span><br><span>03:00 pm-4:00 pm</span></p>
                        <p><span>St. Paul's United Methodis Church<br> 2000 Shutterlee Mill Rd<br> Staunton, 24401</span></p>
                        <p><a href="#" class="btn-custom">See Map</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ftco-animate">
                <div class="place img" style="background-image: url(images/place-1.jpg);">
                    <div class="text text-center">
                        <span class="icon flaticon-reception-bell"></span>
                        <h3>The Reception</h3>
                        <p><span>Saturday, 19, 2020</span><br><span>04:00 pm-9:00 pm</span></p>
                        <p><span>Barren Ridge Vineyards<br> 984 Barren Ridge Road<br> Fishersville, VA 22939</span></p>
                        <p><a href="#" class="btn-custom">See Map</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="ftco-section bg-secondary" id="rsvp-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">RSVP</span>
                <h2 class="mb-3">Are Your Attending?</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">

                <a href="{{ route('login') }}" class="btn btn-lg btn-primary text-center">Login to RSVP</a>
            </div>
        </div>
    </div>
</section>
<section class="ftco-section" id="gallery-section">
    <div class="container-fluid px-md-4">
        <div class="row justify-content-center pb-5">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <span class="clone">Photos</span>
                <h2 class="mb-3">Gallery</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-1.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-1.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-2.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-2.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-3.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-3.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-4.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-4.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-5.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-5.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-6.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-6.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-7.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-7.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="images/gallery-8.jpg" class="gallery img image-popup d-flex align-items-center justify-content-center" style="background-image: url(images/gallery-8.jpg);">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="ion-ios-image"></span></div>
                </a>
            </div>
        </div>
    </div>
</section>


<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" /><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>

<script src="{{ asset('js/template/jquery.min.js') }}"></script>
<script src="{{ asset('js/template/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/template/popper.min.js') }}"></script>
<script src="{{ asset('js/template/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/template/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/template/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('js/template/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/template/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/template/aos.js') }}"></script>
<script src="{{ asset('js/template/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('js/template/jquery.mb.YTPlayer.min.js') }}"></script>
<script src="{{ asset('js/template/scrollax.min.js') }}"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false" type="449c6e4c80def2ffd8bbd963-text/javascript"></script>
<script src="{{ asset('js/template/google-map.js') }}"></script>
<script src="{{ asset('js/template/main.js') }}"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="449c6e4c80def2ffd8bbd963-|49" defer=""></script></body>
</html>
