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
  <!-- plugins:css -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/base/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    @livewireStyles
</head>
<body>

    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')

        <div class="container-fluid page-body-wrapper">
        @include('layouts.inc.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>

        </div>
    </div>

    <script src="{{asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>

    <script src="{{asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    
    <script src="{{asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('admin/js/template.js')}}"></script>

     {{--  Custom js for this page  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.1/echarts.min.js"></script>
    <script src="{{asset('admin/js/dashboard.js')}}"></script>
    <script src="{{asset('admin/js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/js/chart.js')}}"></script>
    <script src="{{asset('admin/js/data-table.js')}}"></script>
    <script src="{{asset('admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.js')}}"></script>
     {{--  End custom js for this page  --}}

     <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>
     <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    @livewireScripts
    @yield('scripts')
    
    @stack('script')
    @yield('script')
</body>
</html>