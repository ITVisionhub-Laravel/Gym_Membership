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
                @if ($ExpiredPaymentMember)
                <h3>{{ $payment }}</h3>
                <a href="{{url('admin/expiredMembers')}}"><p>Payment Expired Members</p></a>
                @else
                    <h3>0</h3>
                    <p>Payment Expired Members</p>
                @endif


            </span>
        </li>

        {{-- <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>${{ $price }}</h3>
                <p>Total Earnings</p>
            </span>
        </li> --}}
        {{-- <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>${{ $expenses }}</h3>
                <p>Total Expenses</p>
            </span>
        </li> --}}
        {{-- <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>${{ $incomes }}</h3>
                <p>Total Incomes</p>
            </span>
        </li> --}}
        {{-- <li>
            <i class='bx bxs-dollar-circle' ></i>
            <span class="text">
                <h3>${{ $profits }}</h3>
                <p>Total Profits</p>
            </span>
        </li> --}}

</ul>

<hr>
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-3 mb-2" style="border-radius:10px; background-color: lightgreen">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon"> <i class="fa fa-line-chart" aria-hidden="true"></i> </div>
                    </div>
                     <div class=" mt-2 px-3">
                    <h5 class="heading">Total Income</h5>
                    <p>${{ $incomes }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 mb-2" style="border-radius:10px; background-color: #cfe8ff">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon2"> <i class="fa fa-usd" aria-hidden="true"></i> </div>
                    </div>
                     <div class=" mt-2 px-3">
                    <h5 class="heading">Our Revenue</h5>
                    <p>${{ $profits }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{url('admin/profitsharing')}}" class="card-link">
                <div class="card p-3 mb-2" style="border-radius:10px; background-color: rgb(231, 179, 228)">
                    <div class="d-flex">
                        <div class="d-flex flex-row align-items-center">
                            <div class="profitshare"><i class="fa-regular fa-handshake"></i></div>
                        </div>
                        <div class=" mt-2 px-3">

                                <h5 class="heading">YUFC Income</h5>

                            <p>${{ $yufcIncome }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <div class="card p-3 mb-2" style="border-radius:10px; background-color: burlywood">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="expense"> <i class="fa-regular fa-credit-card"></i> </div>
                    </div>
                     <div class=" mt-2 px-3">
                    <h5 class="heading">Total Expense</h5>
                    <p>${{ $expenses }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <div class="card p-3 mb-2" style="border-radius:10px; background-color: rgb(228, 228, 100)">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon1"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> </div>
                    </div>
                     <div class=" mt-2 px-3">
                    <h5 class="heading">Sale Product</h5>
                    <p>$50.00</p>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-3">
            <div class="card p-3 mb-2" style="border-radius:10px; background-color: #fff2c6">
                <div class="d-flex">
                    <div class="d-flex flex-row align-items-center">
                        <div class="icon3"> <i class="fa fa-times" aria-hidden="true"></i> </div>
                    </div>
                     <div class=" mt-2 px-3">
                    <h5 class="heading">Faulty Items</h5>
                    <p>$70.00</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>


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
                                            <a class="social-icon text-xs-center" target="_blank" href="https://x.com/PannPoem?t=Mj7Q0WC-O_TUZqlKvnJyXA&s=35">
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
 <x-barchartjs :monthlyEarningMoney=$monthlyEarningMoney :month=$month></x-barchartjs>
</x-slot>
</x-admin>
