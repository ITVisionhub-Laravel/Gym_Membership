<x-admin>
    <ul class="box-info">
	
        <li>
            <i class='bx bxs-group' ></i>
            <span class="text">
                <h3>{{ $attendencedMembers->count() }}</h3>
                <a href="{{route('attendents.index')}}"><p>Attendented Members</p> </a>
            </span>
        </li>
   
    
        <li>
            <i class='bx bxs-group' ></i>
            <span class="text">
                <h3>{{ $members->count() }}</h3>
                <a href="{{ url('admin/customers') }}"><p>Register Members</p></a>
            </span>
        </li>
    
    
        <li>
            <i class='bx bxs-calendar-check' ></i>
            <span class="text">
                @if (!$noExpiredPaymentMember)
                <h3>{{ $expiredPaymentMember->count() }}</h3>
                    <a href="{{route('attendents.index')}}"><p>Payment Expired Members</p></a>
                @else
                    <h3>0</h3>    
                    <p>Payment Expired Members</p>
                @endif
                
                
            </span>
        </li>
    
        <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>${{ $price }}</h3>
                <p>Total Earnings</p>
            </span>
        </li>
</ul>

    <div class="col-md-12 row">
      @if ($monthlyEarningMoney)
          @include('admin.dashboard.barchart',compact('monthlyEarningMoney','month'))
      @else
          @include('admin.dashboard.barchart')
      @endif

       

       @include('admin.dashboard.memberlist',compact('attendencedMembers','members'))
      
    </div>

    <section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">OUR TRAINNER</h5>
        <div class="row">
            @forelse ($trainers as $trainer)
                <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{asset('uploads/trainer/'.$trainer->image)}}" alt="card image"></p>
                                    <h4 class="card-title">{{ $trainer->name }}</h4>
                                    <p class="card-text">{{ $trainer->description }}</p>
                                    <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h4 class="card-title">{{ $trainer->name }}</h4>
                                    <p class="card-text">{{ $trainer->description }}</p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                <i class="uil uil-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                <i class="uil uil-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                <i class="uil uil-skype"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                <i class="uil uil-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div>No Trainers</div>
            @endforelse
            
            
        </div>
    </div>
</section>
<x-slot name="scripts">
</x-slot>
</x-admin>
