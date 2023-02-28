
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
    
    <x-frontend.navbar/>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video"> 
            <source src="assets/images/gym-vdo.mp4" type="video/mp4" />
        </video> 
        

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work harder, get stronger</h6>
                <h2>easy with our <em>gym</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="{{ url('package-details') }}">View Packages</a>
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
                        <h2>Don’t <em>think</em>, begin <em>today</em>!</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo odio architecto labore dolor dicta quibusdam consequatur. Deleniti dolorum autem qui delectus odio. Minima magnam id labore harum dolores, quas eaque!</p>
                        <div class="main-button scroll-to-section">
                            <a href="#our-classes">View Packages</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->
     

    {{-- <!-- ***** Our Classes Start ***** -->
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
                  @foreach ($class as $item)
                  <li><a href="#{{ $item->id }}"><img src="assets/images/gym.png" width="50" height="50" alt="">{{ $item->name }}</a></li>
                  @endforeach
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                @foreach ($class as $item)
                  <article id='{{ $item->id }}'>
                    <img src="{{ asset($item->image) ?? 'None'}}" alt="First Class">
                    <h4>{{ $item->name ?? 'None'}}</h4>
                    <p>{{ $item->description ?? 'None' }}</p>
                    <div class="main-button">
                        <a href="#schedule">View Classes</a>
                    </div>
                </article>
                 @endforeach
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** --> --}}
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
                <div class="col-md-3">
                    <div class="card shadow  image-thumb" >
                        <img src="assets/images/six-trainer.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Body Fintness</h5>
                          <p class="card-text ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="{{ url('class-detail') }}" class="btn" style="background-color: #6ca12b;color: #fff">View Class</a>
                        </div>
                      </div>
                </div>
            </div>


        </div>
    </section>
    <!-- ***** Our Classes End ***** -->
    {{-- <section class="section" id="schedule">
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
                            <li data-tsfilter="monday">Tuesday</li>
                            <li data-tsfilter="monday">Wednesday</li>
                            <li data-tsfilter="monday">Thursday</li>
                            <li data-tsfilter="monday">Friday</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 offset-lg-1">
                    <div class="schedule-table filtering">
                        <table>
                            <tbody>
                                @foreach ($class as $class)
                                <tr>
                                    <td class="day-time">{{ $class->name }}</td>
                                    <td class="monday ts-item show" data-tsmeta="monday">{{ $class->morning_time }}</td>
                                    <td class="monday ts-item show" data-tsmeta="monday">{{ $class->evening_time }}</td>
                                    <td>{{ $class->trainer->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
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
    {{-- <section class="section" id="trainers">
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
                @foreach ($trainer as $trainer)
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            @if ($trainer->image)
                                <img src="{{ asset('/uploads/trainer/'.$trainer->image) }}" alt="Trainer">
                            @else
                                <p>none</p>
                            @endif
                        </div>
                        <div class="down-content">
                            <span>{{ $trainer->class->name ?? 'None' }}</span>
                            <h4>{{ $trainer->name ?? 'None' }}</h4>
                            <p>{{ $trainer->description ?? 'None' }}</p>
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
    </section> --}}
    <!-- ***** Testimonials Ends ***** -->
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