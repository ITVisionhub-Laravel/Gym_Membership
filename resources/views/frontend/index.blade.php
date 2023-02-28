
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>5 Heroes GYM | Build your body strong</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="icon" type="image/x-icon" href="assets/images/features-1-icon.png">
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">Gym</a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">About</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Classes</a></li>
                            <li class="scroll-to-section"><a href="#trainers">Trainers</a></li>
                            <li class="scroll-to-section"><a href="#schedule">Schedules</a></li>
                            @if (Auth::user())
                                <li class="scroll-to-section"><a href="@if ($qrcode)
                                    {{ url('user_qrcode') }}
                                @else
                                    {{ url('user_register') }} 
                                @endif">@if ($qrcode)
                                    QRCode
                                    @else
                                    Submit
                                @endif</a></li>
                            @endif
                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li> 
                            <li>
                            @guest
                            @if (Route::has('login'))
                            <li class="scroll-to-section"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                            <li class="scroll-to-section"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="scroll-to-section"><a href="{{ route('login') }}">{{ __(Auth::user()->name) }}</a></li>
                            <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                            </li>
                        </ul>   
                        @endguest
                             
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work harder, get stronger</h6>
                <h2>easy with our <em>gym</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="#features">View Packages</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Features Item Start ***** -->
    <section class="section " id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2 class="mb-3">Choose <em>Program</em></h2>
                        
                        <p>Training Studio for gyms and fitness centers. You are allowed to play this 5 heroes gym for your aims.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4>Basic Fitness</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto </p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="second one">
                            </div>
                            <div class="right-content">
                                <h4>New Gym Training</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto  </p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="third gym training">
                            </div>
                            <div class="right-content">
                                <h4>Basic Muscle Course</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto</p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="fourth muscle">
                            </div>
                            <div class="right-content">
                                <h4>Advanced Muscle Course</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto</p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="training fifth">
                            </div>
                            <div class="right-content">
                                <h4>Yoga Training</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto</p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="assets/images/features-1-icon.png" alt="gym training">
                            </div>
                            <div class="right-content">
                                <h4>Body Building Course</h4>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur, voluptatem odit fuga quis distinctio, iusto.</p>
                                <a href="#" class="text-button">Discover More</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Item End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section" id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Don’t <em>think</em>, begin <em>today</em>!</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo odio architecto labore dolor dicta quibusdam consequatur. Deleniti dolorum autem qui delectus odio. Minima magnam id labore harum dolores, quas eaque!</p>
                        <div class="main-button scroll-to-section">
                            <a href="#our-classes">Become a member</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->
     

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2 class="mb-3">Our <em>Classes</em></h2>
                       
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero iure, excepturi soluta ducimus nisi ut deleniti? Ipsa, necessitatibus nam, debitis similique, corrupti temporibus iure officiis nobis laboriosam </p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs" class="gym-class">
              <div class="col-lg-4">
                <ul>
                  <li><a href='#tabs-1'><img src="assets/images/gym.png" width="50" height="50" alt="">Yoga Training Class</a></li>
                  <li><a href='#tabs-2'><img src="assets/images/gym.png"  width="50" height="50" alt="">Body Training Class</a></a></li>
                  <li><a href='#tabs-3'><img src="assets/images/gym.png"  width="50" height="50" alt="">Basic Training Class </a></a></li>
                  <li><a href='#tabs-4'><img src="assets/images/gym.png"  width="50" height="50" alt="">Muscle Class</a></a></li>
                  
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
                    <img src="assets/images/training-image-02.jpg" alt="First Class">
                    <h4>Yoga Training Class</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet dolorum doloribus, atque deserunt ipsum hic nobis cumque expedita eaque fuga deleniti repellendus repudiandae? Ea nostrum at assumenda aliquam velit molestiae.</p>
                    <div class="main-button">
                        <a href="#schedule">View Classes</a>
                    </div>
                  </article>
                  <article id='tabs-2'>
                    <img src="assets/images/training-image-01.jpg" alt="Second Training">
                    <h4>Muscle Training Class</h4>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio perferendis fuga aliquam quisquam similique nemo earum quis et, quaerat sapiente cupiditate culpa. Veritatis, harum iste perspiciatis ipsa aperiam quos itaque?</p>
                    <div class="main-button">
                        <a href="#">View Classes</a>
                    </div>
                  </article>
                  <article id='tabs-3'>
                    <img src="assets/images/training-image-03.jpg" alt="Third Class">
                    <h4>Body Fitness Training Class</h4>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. In error suscipit illo cumque saepe nulla ducimus excepturi obcaecati ipsum velit quo nostrum, labore eius animi nesciunt, atque minima deleniti asperiores!</p>
                    <div class="main-button">
                        <a href="#">View Classes</a>
                    </div>
                  </article>
                  <article id='tabs-4'>
                    <img src="assets/images/training-image-04.jpg" alt="Fourth Training">
                    <h4>Muscle Training Class</h4>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid, illo. Aut fuga aliquam repudiandae commodi error quidem fugit maxime voluptatum ducimus, odio nemo iure deserunt tenetur, placeat, blanditiis eaque consequuntur.</p>
                    <div class="main-button">
                        <a href="#">View Classes</a>
                    </div>
                  </article>
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->
    
    <section class="section" id="schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2 class="mb-3">Classes <em>Schedule</em></h2>
                        
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure a dolore cum quis, voluptas inventore laboriosam hic est quibusdam autem. Sapiente itaque alias ut a sint voluptates animi quod tenetur?</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="filters">
                        <ul class="schedule-filter">
                            <li class="active" data-tsfilter="monday">Monday</li>
                            <li data-tsfilter="tuesday">Tuesday</li>
                            <li data-tsfilter="wednesday">Wednesday</li>
                            <li data-tsfilter="thursday">Thursday</li>
                            <li data-tsfilter="friday">Friday</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1">
                    <div class="schedule-table filtering">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="day-time">Fitness Class</td>
                                    <td class="monday ts-item show" data-tsmeta="monday">10:00AM - 11:30AM</td>
                                    <td class="tuesday ts-item" data-tsmeta="tuesday">2:00PM - 3:30PM</td>
                                    <td>Htoo Aung</td>
                                </tr>
                                <tr>
                                    <td class="day-time">Muscle Training</td>
                                    <td class="friday ts-item" data-tsmeta="friday">10:00AM - 11:30AM</td>
                                    <td class="thursday friday ts-item" data-tsmeta="thursday" data-tsmeta="friday">2:00PM - 3:30PM</td>
                                    <td>Nay Toe </td>
                                </tr>
                                <tr>
                                    <td class="day-time">Body Building</td>
                                    <td class="tuesday ts-item" data-tsmeta="tuesday">10:00AM - 11:30AM</td>
                                    <td class="monday ts-item show" data-tsmeta="monday">2:00PM - 3:30PM</td>
                                    <td>MYo Pa Pa Aung</td>
                                </tr>
                                <tr>
                                    <td class="day-time">Yoga Training Class</td>
                                    <td class="wednesday ts-item" data-tsmeta="wednesday">10:00AM - 11:30AM</td>
                                    <td class="friday ts-item" data-tsmeta="friday">2:00PM - 3:30PM</td>
                                    <td>Htoo Aung</td>
                                </tr>
                                <tr>
                                    <td class="day-time">Advanced Training</td>
                                    <td class="thursday ts-item" data-tsmeta="thursday">10:00AM - 11:30AM</td>
                                    <td class="wednesday ts-item" data-tsmeta="wednesday">2:00PM - 3:30PM</td>
                                    <td>Jassa</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Testimonials Starts ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2 class="mb-3">Expert <em>Trainers</em></h2>
                       
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, ad maxime dolores dolorum repudiandae quod asperiores non eaque expedita sunt, dignissimos itaque minima vel ipsa, eos explicabo perferendis quo ipsum!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/six-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Strength Trainer</span>
                            <h4>Htoo Aung</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus minus, et molestias harum, distinctio placeat ipsum aspernatur tenetur, adipisci numquam praesentium! Nemo sit nam animi hic officiis totam voluptates voluptate.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/five-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Muscle Trainer</span>
                            <h4>Thu Ya Htet Zaw</h4>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat nulla maxime alias inventore et possimus commodi, saepe ad! Ducimus amet natus similique rerum doloribus! Eos debitis dolore eaque corrupti incidunt.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="assets/images/fourth-trainer.jpg" alt="">
                        </div>
                        <div class="down-content">
                            <span>Power Trainer</span>
                            <h4>Myo Pa Pa Aung</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis recusandae, tenetur consequuntur obcaecati error aperiam vel molestiae odit, distinctio ipsa consequatur debitis quas enim est dolore quam placeat neque ipsam.</p>
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->
    

    <!-- ***** Become Member ***** -->
    <section class="section" id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Let's <em>Register</em>,to become <em>our member</em>!</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo odio architecto labore dolor dicta quibusdam consequatur. Deleniti dolorum autem qui delectus odio. Minima magnam id labore harum dolores, quas eaque!</p>
                        <div class="main-button scroll-to-section">
                            <a href="{{ url('user_register') }}">Let's Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Become Member End ***** -->
    
    <!-- ***** Contact Us Area Starts ***** -->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                        <iframe src="{{ $logo->location }}" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="contact-form">
                        {{-- <h5 style="background-color: rgba(104, 110, 118, 0.8)">Suggestion Form</h5> --}}
                        <form id="contact" action="" method="post">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="email" type="text" id="email" pattern="" placeholder="Your Email*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-12 col-sm-12">
                              <fieldset>
                                <input name="subject" type="text" id="subject" placeholder="Subject">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area Ends ***** -->
    
    <!-- ***** Contact-sub ******-->
    <div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <div id="gymedge_about-2" class="widget widget_gymedge_about">
                        <h3 class="widgettitle"> {{ $logo->name }}</h3><br>			
                        <p><span class="hero">{{ $logo->name }} </span>{{ $logo->description }}</p>
                    </div>
                </div>
            <div class="col-sm-3 col-xs-12">
                <div id="gymedge_address-2" class="widget widget_gymedge_address">
                    <h3 class="widgettitle">Office Address</h3>
                    <br>			
                <ul>
                    <li><i class="fa fa-paper-plane-o" aria-hidden="true" style="color: #13e30c;"></i>&nbsp; &nbsp;Yangon , Insein</li>
                    <li><i class="fa fa-phone" aria-hidden="true" style="color:#13e30c"></i>&nbsp; &nbsp;<a href="tel:022- 2534588">{{ $logo->ph_no }}</a></li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true" style="color: #13e30c;"></i> &nbsp;&nbsp;
                        <a href="mailto:5heroesgym@gmail.com">{{ $logo->email }}</a></li>
                </ul>
            </div>
        </div>
            <div class="col-sm-3 col-xs-12">
                <div id="text-2" class="widget widget_text">
                    <h3 class="widgettitle">Opening Time</h3><br>			
                        <div class="textwidget">
                            <p class="hero">{{ $logo->open_day }} - {{ $logo->open_time }}</p>
                            <p class="hero1">{{ $logo->close_day }} Closed</p>
                        </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div id="text-3" class="widget widget_text">
                    <h3 class="widgettitle">Official Partner</h3><br>			
                    <p>Royal D Energy Drink</p>
                    <img src="{{asset($logo->image)}}" alt="energydrink" width="80" height="80">
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