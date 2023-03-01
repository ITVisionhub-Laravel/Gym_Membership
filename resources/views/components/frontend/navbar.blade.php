<!-- ***** Header Area Start ***** -->
@props(['qrcode'])
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">GYM</a>
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