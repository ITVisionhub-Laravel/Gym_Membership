<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--  <title>@yield('title')|{{ config('app.name', 'Laravel') }}</title>  --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{--  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">--}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> 

    {{--  Css files  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/class-detail.css') }}">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/features-1-icon.png') }}">
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/> --}}
    <!-- Scripts -->
    {{--  @vite(['resources/css/app.css', 'resources/js/app.js'])  --}}
    @livewireStyles
</head>

<body class="font-sans antialiased">
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
    <div class="min-h-screen bg-gray-100">
        {{--  @include('layouts.navigation')  --}}

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <!-- jQuery -->
    //<script src="assets/js/jquery-2.1.0.min.js"></script>
    
    <!-- Bootstrap -->
    //<script src="assets/js/popper.js"></script>
    //<script src="assets/js/bootstrap.min.js"></script>
    {{--  <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>  --}}
    
    <!-- Plugins -->
    //<script src="assets/js/scrollreveal.min.js"></script>
    //<script src="assets/js/waypoints.min.js"></script>
    //<script src="assets/js/jquery.counterup.min.js"></script>
    //<script src="assets/js/imgfix.min.js"></script>
    //<script src="assets/js/mixitup.js"></script>
    //<script src="assets/js/accordions.js"></script>
    
    <!-- Global Init -->
    //<script src="assets/js/custom.js"></script>
    <script>
        window.addEventListener('message', event => {
            alertify.set('notifier','position', 'top-right');
            alertify.success(event.detail.text,event.detail.type);
    
            });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @livewireScripts
</body>

</html>
