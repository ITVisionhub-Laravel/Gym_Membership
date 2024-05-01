<!-- ***** Header Area Start ***** -->
@props(['customer'])
<header class="header-area header-sticky" style="background-color:#232d39">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">Gym</a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ route('home') }}" class="active">Home</a>
                        </li>
                        <li class="scroll-to-section"><a href="#features">About</a></li>
                        <li class="scroll-to-section"><a href="#our-classes">Classes</a></li>
                        <li class="scroll-to-section"><a href="#trainers">Trainers</a></li>
                        <li class="scroll-to-section"><a href="#schedule">Schedules</a></li>
                        {{-- @if (Auth::user() && !$customer)
                            <li class="scroll-to-section">
                                <a href="{{ url('user_register') }}">
                                    Profile
                                </a>
                            </li>
                        @endif --}}
                        <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                        <li>
                            @guest
                                @if (Route::has('login'))
                            <li class="scroll-to-section"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li class="scroll-to-section"><a href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- @php
                                $nameWords = explode(' ', __(Auth::user()->name));
                                $shortenedName = implode(' ', array_slice($nameWords, 0, 2));
                                if (count($nameWords) > 2) {
                                    $shortenedName .= '...';
                                }
                            @endphp --}}
                            @if (Auth::user()->phone_number)
                                <li class="scroll-to-section"><img
                                        src="{{ asset('uploads/customer/' . Auth::user()->image) }}" width="30"
                                        height="30" class="d-inline-block bg-transparent border-0 rounded-circle"
                                        alt="{{ __(Auth::user()->name) }}">
                                    <a href="{{ route('user.details') }}"
                                        class="d-inline-block">{{ Str::words(__(Auth::user()->name), 2) }}</a>
                                </li>
                            @else
                                @if (Auth::user()->age)
                                    <li class="scroll-to-section"><img
                                            src="{{ asset('uploads/customer/' . Auth::user()->image) }}" width="30"
                                            height="30" class="d-inline-block bg-transparent border-0 rounded-circle"
                                            alt="{{ __(Auth::user()->name) }}">
                                        <a href="{{ url('user_register') }}"
                                            class="d-inline-block">{{ Str::words(__(Auth::user()->name), 2) }}</a>
                                    </li>
                                @else
                                    <li class="scroll-to-section"><img src="{{ asset('uploads/customer/sample.png') }}"
                                            width="30" height="30" class="d-inline-block bg-transparent border-0"
                                            alt="{{ __(Auth::user()->name) }}">


                                        <a href="{{ url('user_register') }}"
                                            class="d-inline-block">{{ Str::words(__(Auth::user()->name), 2) }}</a>
                                        {{-- <a href="{{ url('user_register') }}"
                                            class="d-inline-block">{{ __(Auth::user()->name) }}</a> --}}
                                    </li>
                                @endif
                            @endif

                            {{-- <li class="scroll-to-section"><a
                                    href="{{ url('user_register') }}">{{ __(Auth::user()->name) }}</a>
                            </li> --}}

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
