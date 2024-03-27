<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>5 Heroes GYM | Build your body strong</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/class-detail.css') }}">

    <link rel="icon" type="image/x-icon" href="assets/images/features-1-icon.png">

</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky background-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">5 Heroes<em> Training</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">About</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Classes</a></li>
                            <li class="scroll-to-section"><a href="#trainers">Trainers</a></li>
                            <li class="scroll-to-section"><a href="#schedule">Schedules</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                            <li class="main-button"><a href="#">Register</a></li>
                        </ul>
                        <a class="menu-trigger">
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Main Banner Area End ***** -->

    <!-- Class Start -->
    <div class="class pt-5">
        <div class="container">
            <div class="section-header text-center wow zoomIn pt-5" data-wow-delay="0.1s">
                <h5 class="pt-5">Our Classes</h5>
                <h2 class="pt-3"> {{ $gymClassType }} Class Shedule</h2>
            </div>
           
            <div class="row class-container pt-4">
                @foreach ($gymClasses as $gymClass)
                    <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                        <div class="class-wrap">
                            <div class="class-img">
                                <img src="{{asset('/uploads/class/'.$gymClass->image)}}" alt="Image">
                            </div>
                            <div class="class-text">
                                <div class="class-teacher">
                                    @if ($gymClass->trainers->isNotEmpty())
                                        <img src="{{ asset('/uploads/trainer/'.$gymClass->trainers[0]->image) }}" alt="Image">
                                        <h3>{{ $gymClass->trainers['0']->name }}</h3>
                                    @endif
                                    <a href="">+</a>
                                </div>
                                <h2>{{ $gymClass->name }}</h2>
                                @if ($gymClass->schedules->isNotEmpty())
                                    <div class="class-meta">
                                        <p><i class="far fa-calendar-alt"></i>{{ $gymClass->schedules['0']->daysOfWeek->name }}</p>
                                        <p><i class="far fa-clock"></i>{{ $gymClass->schedules['0']->hours_From }} - {{ $gymClass->schedules['0']->hours_To }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Class End -->

    <!-- **** Classes Videos ****-->
    <div class="container pt-4">
        <h2>Training Class Videos</h2>
        <div class="row pt-5">
            <div class="col-md-4">
                <video autoplay muted loop id="class-vdo">
                <source src="{{ asset('assets/images/gym-vdo.mp4') }}" type="video/mp4" height="75" />
                </video>
            </div>
            <div class="col-md-4">
                <video autoplay muted loop id="class-vdo">
                    <source src="{{ asset('assets/images/gym-video.mp4') }}" type="video/mp4" />
                </video>
            </div>
            <div class="col-md-4">
                <video autoplay muted loop id="class-vdo">
                    <source src="{{ asset('assets/images/tima-vdo.mp4')}}" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
    <!-- **** End Classes Videos *****-->

    <!-- Discount Start -->
    <div class="discount wow zoomIn pt-5" data-wow-delay="0.1s" style="margin-bottom: 0px;">
        <div class="container">
            <div class="section-header text-center">
                <p>Awesome Discount</p>
                <h2>Get <span>30%</span> Discount for all Classes</h2>
            </div>
            <div class="container discount-text">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur
                    facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra
                    quis sem. Curabitur non nisl nec nisi scelerisque maximus.
                </p>
                <a class="btn">Join Now</a>
            </div>
        </div>
    </div>
    <!-- Discount End -->


    <!-- ***** Contact-sub ******-->
    <div class="footer-top-area mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12 pt-2">
                    <div id="gymedge_about-2" class="widget widget_gymedge_about">
                        <h3 class="widgettitle"> 5Heroes Gym</h3><br>
                        <p><span class="hero">5Heroes Gym </span>is a fitness center with a modern and contemporary
                            atmosphere. With the best trainers, equipments and fitness programs, 5 Heroes Gym guarantees
                            results.</p>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div id="gymedge_address-2" class="widget widget_gymedge_address">
                        <h3 class="widgettitle">Corporate Office</h3>
                        <br>
                        <ul class="footer-corporate">
                            <li><i class="fa fa-paper-plane-o" aria-hidden="true" style="color: #13e30c;"></i>&nbsp;
                                &nbsp;1st floor Hledan Township</li>
                            <li><i class="fa fa-phone" aria-hidden="true" style="color:#13e30c"></i>&nbsp; &nbsp;<a
                                    href="tel:022- 2534588">+959 986543572</a></li>
                            <li><i class="fa fa-envelope-o" aria-hidden="true" style="color: #13e30c;"></i> &nbsp;&nbsp;
                                <a href="mailto:5heroesgym@gmail.com">5heroesgym@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div id="text-2" class="widget widget_text">
                        <h3 class="widgettitle">Opening Time</h3><br>
                        <div class="textwidget">
                            <p class="hero "><i class="fa fa-calendar" style="font-size:15px"></i></i>&nbsp;Date & Time
                                : Monday To Friday <span class="time"> &nbsp;&nbsp;&nbsp;&nbsp;(9 AM to 8 PM)</span></p>

                            <p class="hero1"><i class="fa fa-clock-o" style="font-size:20px"></i>&nbsp; Saturday &
                                Sunday Closed</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div id="text-3" class="widget widget_text">
                        <h3 class="widgettitle">Official Partner</h3><br>
                        <p>Royal D Energy Drink</p>
                        <img src="assets/images/royad.jpg" alt="energydrink" width="80" height="80">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; February 7, 2023 <span style="color:#13e30c">ITVision Hub Company Ltd</span></p>
                </div>
            </div>

            <div class="row app-logo pt-2">
                <div class="col-md-6">
                    <img src="assets/images/ios_logo.png" alt="app-store" height="50">
                </div>
                <div class="col-md-6">
                    <img src="assets/images/google_logo.png" alt="android-stroe" height="50">
                </div>
            </div>


            <!--Chat  code begins here -->

            <a href="#" class="float">
                <i class="fa fa-envelope my-float"></i>
            </a>
            <div class="label-container">
                <div class="label-text">Join Now!</div>
                <i class="fa fa-play label-arrow"></i>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
</body>

</html>