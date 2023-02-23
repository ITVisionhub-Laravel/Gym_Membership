<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="
    utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Majestic Admin</title>
    <x-css />
    @livewireStyles
</head>
<body>
    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <x-script />
    @livewireScripts
    {{ $scripts }}
    @stack('script')
    @yield('script')
</body>

</html>