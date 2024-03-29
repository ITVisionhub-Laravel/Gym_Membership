<div>
    <x-frontend.navbar :customer="$data['customerInfo']" />
    

    <!-- ***** Gymclass Lists Area Start***** -->
    <div class="class pt-5">
        <div class="container">
            <div class="section-header text-center wow zoomIn pt-5" data-wow-delay="0.1s">
                <h5 class="pt-5">Our Classes</h5>
                <h2 class="pt-3"> {{ $gymClassType }} Class Shedule</h2>
            </div>
    
            <div class="row class-container pt-4">
               @foreach ($gymClasses as $gymClass)
                    <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                        <a href="{{ route('class.details', ['gymclassId' => $gymClass->id]) }}">
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
                                        <p><i class="far fa-clock"></i>{{ $gymClass->schedules['0']->hours_From }} - {{
                                            $gymClass->schedules['0']->hours_To }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
    
            </div>
        </div>
    </div>
    <!-- ***** Gymclass Lists Area End ******-->

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
</div>
</body>
<x-frontend.footer :logo="$data['logo']" :partner="$data['partner']" />

</html>
@section('script')

@endsection