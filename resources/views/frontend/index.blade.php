
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
    <link rel="stylesheet" href="assets/css/main.css">
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

    <x-frontend.navbar :customer="$customer"> </x-frontend.navbar>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="assets/images/gym-vdo.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work harder, get stronger</h6>
                <h2>Join with our <em>gym</em></h2>
                <div class="row">
                    {{--   style="pointer-events: none; opacity: 0.4;"  --}}
                    <div class="col-md-6">
                        <div class="float-end main-button scroll-to-section">
                            {{--  onclick="return confirm('Please Fill Up Your Information')"  --}}

                        <a href="{{ url('package-details') }}" @if ($customer)
                            disabled
                        @endif >View Packages</a>
                    </div>
                    </div>

                     {{--  style="pointer-events: none; opacity: 0.4;"  --}}
                    <div class="col-md-6">
                        <div class="col-md-4 main-button scroll-to-section">
                            {{--  onclick="return confirm('Please Fill Up Your Information')"  --}}
                            <a href="{{ url('product-checkout') }}" >View Products</a>
                        </div>
                    </div>

                </div>
                <x-forms.input-error name="township"/>
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
                        <h2 class="mb-3">Our<em>About</em></h2>

                        <p>Training Studio for gyms and fitness centers. You are allowed to play this 5 heroes gym for your aims.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="assets/images/prersonal-training.png" alt="" width="250" height="250" style="
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                      ">
                    <p class="herogym"><span style="color: #6ca12b;"><strong>5HEROES TRAINING Gym </strong></span>sit amet consectetur adipisicing elit. Reprehenderit fugiat, voluptatibus asperiores sapiente voluptatem sequi iure natus voluptas vero quasi ut dolorem nobis repellat esse labore necessitatibus saepe sit distinctio!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere voluptatem eaque laboriosam blanditiis cumque nemo veniam atque laudantium amet maxime at dolor sapiente, minima ipsam placeat exercitationem maiores, nulla officiis.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo fugiat modi maxime, veritatis veniam ipsum omnis? Facilis voluptates eaque rem eligendi qui voluptate, dolorum quis exercitationem, consequuntur at non quos.</p>
                </div>
                <div class="col-md-6">
                    <div class="card card-logo shadow">
                        <div class="card-body">
                            <h5> Our Vision</h5>
                                <p class="text-justify english text" style="color:black">
                                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ad quasi necessitatibus aspernatur possimus totam ea delectus reiciendis nostrum nihil dolorem, consectetur commodi quam vero odit, omnis atque et quo?
                                </p>
                        </div>
                    </div>
                    <div class="card mt-3 card-logo shadow">
                      <div class="card-body">
                        <h5>Our Mission</h5>
                        <p class="text-justify" style="color:black">
                          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, eos possimus dolorem, sed aliquid quasi reiciendis maxime tempora facere facilis soluta ut, voluptas officia distinctio dicta beatae corporis est qui.
                        </p>
                      </div>
                    </div>

                    <div class="card mt-3 card-logo shadow">
                      <div class="card-body">
                        <h5>Our Value</h5>
                        <p class="text-justify english text " style="color:black">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, eos possimus dolorem, sed aliquid quasi reiciendis maxime tempora facere facilis soluta ut, voluptas officia distinctio dicta beatae corporis est qui.
                        </p>
                      </div>
                    </div>
                    </div>
                    </div>

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
                        <h2>Not Now <em>When?</em>, Not You <em>Who?</em></h2>
                        <p>"Join our vibrant gym community and unlock a world of fitness benefits tailored just for you. From personalized workouts
                        and diverse classes to a supportive environment, we're here to guide you towards your fitness goals. Experience the
                        difference and join us today to elevate your fitness journey!"</p>
                        <div class="main-button scroll-to-section">
                            <a href="#our-classes">View Packages</a>
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
            <div class="row">
                @foreach ($class_categories as $class_category)
                <div class="col-md-3">
                    <div class="card shadow image-thumb" > 
                        <img src="{{asset('/uploads/class/'.$class_category->image)}}" class="card-img-top" alt="Class">
                        
                        <div class="card-body">
                          <h5 class="card-title">{{ $class_category->name ?? 'None'}}</h5>
                          <p class="card-text mb-4 paragraph-container">{{ $class_category->description ?? 'None' }}</p>
                          <a href="{{ url('class-detail') }}" class="btn" style="background-color: #6ca12b;color: #fff">View Class</a>
                        </div>
                      </div>
                </div>
                @endforeach
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
                        <p>These schedules offer a diverse range of classes tailored to various fitness levels and goals. With flexible timing and
                        a variety of options, you can seamlessly integrate workouts into your routine, ensuring consistent progress towards your
                        objectives.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="filters">
                        <ul class="schedule-filter">
                            @foreach ($days_of_week as $day)
                                <li class="{{ $day->name === 'Monday' ? 'active' : '' }}" data-tsfilter="{{ $day->name }}">{{ $day->name }}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1">
                    <div>
                        <table>
                            <tbody>
                                
                                @foreach ($class as $class)
                                <tr class="{{ $class->gymSchedules->daysOfWeek->name }} ts-item show" data-tsmeta="{{ $class->gymSchedules->daysOfWeek->name }}">
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->gymSchedules->hours_from }}</td>
                                    <td>{{ $class->gymSchedules->hours_to }}</td>
                                    <td>{{ $class->trainer->name }}</td>
                                </tr>
                                @endforeach
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
                        <p>Expert trainers bring extensive knowledge and experience to guide your fitness journey effectively. They provide
                        personalized instruction, ensuring proper form and technique for optimal results. With their expertise, you can achieve
                        your fitness goals safely and efficiently.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($trainer as $trainer)
                <div class="mb-4 col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img src="{{ asset('/uploads/trainer/'.$trainer->image) }}" alt="Trainer">
                        </div>
                        <div class="down-content">
                            @foreach ($trainer->class as $gymClass)
                                <span>{{ $gymClass->name ?? '' }}, </span>
                            @endforeach
                            <h4 class="{{ count($trainer->class) > 0 ? '' : 'trainer-name' }}">{{ $trainer->name ?? '' }}</h4>
                            <p class="paragraph-container">{{ $trainer->description ?? '' }}</p>
                            <ul class="social-icons">
                                <li><a href="http://www.facebook.com/{{ $trainer->fb_name ?? 'None' }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.facebook.com/{{ $trainer->twitter_name ?? 'None' }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://www.facebook.com/{{ $trainer->linkin_name ?? 'None' }}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="http://www.facebook.com/{{ $trainer->fb_name ?? 'None' }}"><i class="fa fa-behance"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->



    <!-- ***** Contact Us Area Starts ***** -->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                        <iframe src="{{ $logo->location ?? 'None'}}" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

    <x-frontend.footer :logo="$logo" :partner="$partner"/>


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
