@props(['logo', 'partner'])
<!-- ***** Contact-sub ******-->
<div class="footer-top-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-xs-12">
                <div id="gymedge_about-2" class="widget widget_gymedge_about">
                    <h3 class="widgettitle"> {{ $logo->name ?? 'None' }}</h3><br>
                    <p><span class="hero">{{ $logo->name ?? 'None' }} </span>{{ $logo->description ?? 'None' }}</p>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div id="gymedge_address-2" class="widget widget_gymedge_address">
                    <h3 class="widgettitle">Office Address</h3>
                    <br>
                    <ul>
                        {{-- <li><i class="fa fa-paper-plane-o" aria-hidden="true" style="color: #13e30c;"></i>&nbsp; &nbsp;{{ $logo->address ?? 'None'}}</li>
                    <li><i class="fa fa-phone" aria-hidden="true" style="color:#13e30c"></i>&nbsp; &nbsp;<a href="tel:022- 2534588">{{ $logo->ph_no ?? 'None'}}</a></li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true" style="color: #13e30c;"></i> &nbsp;&nbsp;
                        <a href="mailto:5heroesgym@gmail.com">{{ $logo->email ?? 'None'}}</a></li> --}}

                        <li><i class="fa fa-paper-plane-o" aria-hidden="true" style="color: #13e30c;"></i>&nbsp;
                            &nbsp;{{ $appSetting->address ?? 'None' }}</li>
                        <li><i class="fa fa-phone" aria-hidden="true" style="color:#13e30c"></i>&nbsp; &nbsp;<a
                                href="tel:022- 2534588">{{ $appSetting->phone ?? 'None' }}</a></li>
                        <li><i class="fa fa-envelope-o" aria-hidden="true" style="color: #13e30c;"></i> &nbsp;&nbsp;
                            <a href="mailto:5heroesgym@gmail.com">{{ $appSetting->email ?? 'None' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div id="text-2" class="widget widget_text">
                    <h3 class="widgettitle">Opening Time</h3><br>
                    <div class="textwidget">
                        <p class="hero"><i class="fa fa-calendar" style="font-size:15px"></i></i>&nbsp;Date & Time
                            :{{ $logo->open_day ?? 'None' }} - {{ $logo->open_time ?? 'None' }}</p>
                        <p class="hero1"><i class="fa fa-clock-o"
                                style="font-size:20px"></i>&nbsp;{{ $logo->close_day ?? 'None' }} Closed</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div id="text-3" class="widget widget_text">
                    <h3 class="widgettitle">Official Partner</h3><br>
                    <div class="row">
                        @foreach ($partner as $partner)
                            <div class="col-md-4">
                                <p>{{ $partner->name ?? 'None' }}</p>
                                @if ($partner->image)
                                    <img src="{{ asset("$partner->image") }}" width="70" height="70"
                                        alt="Partner">
                                @else
                                    <p>none</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-12">
                <p>Copyright &copy; February 7, 2023 <span style="color:#13e30c">ITVision Hub Company Ltd</span></p>
            </div>
        </div>

        <div class="row app-logo pt-2">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/ios_logo.png') }}" alt="app-store" height="50">
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/images/google_logo.png') }}" alt="android-stroe" height="50">
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
