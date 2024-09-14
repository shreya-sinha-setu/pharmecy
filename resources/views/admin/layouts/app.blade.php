<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- shortcut icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
    <!-- css -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/morris.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/material.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/select2.min.css')}}">
    <!-- {{--    datatables css--}} -->
    <link rel="stylesheet" href="{{asset('frontend/datatables/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datetimepicker.min.css')}}"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('frontend/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/line-awesome.min.css')}}">
    <!-- Scripts -->
    <script src="{{asset('frontend/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('frontend/js/moment.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- <script src="{{asset('frontend/js/morris.min.js')}}"></script> -->
    <script src="{{asset('frontend/js/raphael.min.js')}}"></script>
    <script src="{{asset('frontend/js/chart.js')}}"></script>
    <script src="{{asset('frontend/js/greedynav.js')}}"></script>
    <script src="{{asset('frontend/js/layout.js')}}"></script>
    <!-- <script src="{{asset('frontend/js/theme-settings.js')}}"></script> -->
    <script src="{{asset('frontend/js/app.js')}}"></script>
    <script src="{{asset('frontend/js/select2.min.js')}}"></script>
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <!-- {{--    datatables js--}} -->
    <!-- <script src="{{asset('frontend/datatables/js/bootstrap.bundle.min.js')}}"></script> -->
    <!-- <script src="{{asset('frontend/datatables/js/jquery-3.6.0.min.js')}}"></script> -->
    <script src="{{asset('frontend/datatables/js/datatables.min.js')}}"></script>
    <script src="{{asset('frontend/datatables/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('frontend/datatables/js/vfs_fonts.js')}}"></script>
</head>
<body>
<div id="app">

    @include('sweetalert::alert')
    @yield('user-not-login')
    <div class="main-wrapper">
        <div id="loader-wrapper">
        <div id="loader">
        <div class="loader-ellips">
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        </div>
        </div>
        </div>
        @if(session()->has('error'))
            <div id="alert" class="float-end" style="width:30rem; margin:20px;margin-top: 68px;">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" data-auto-dismiss="4000">
                    <strong>{{session()->get('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif



        @if(session()->has('success'))
            <div id="alert" class="float-end" style="width:30rem; margin:20px;margin-top: 68px;">
                <div class="alert alert-primary alert-dismissible fade show" role="alert" data-auto-dismiss="4000">
                    <strong>{{session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        @if (Request::is('admin*'))
            @include('admin.layouts.includes.sidebar')
            @include('admin.layouts.includes.header')
        @endif
        <div class="page-wrapper">


            @yield('content')

        </div>
    </div>
</div>
@yield('script')
<script>
    $('.alert[data-auto-dismiss]').each(function (index, element) {
        var $element = $(element),
            timeout = $element.data('auto-dismiss') || 5000;
        setTimeout(function () {
            $element.alert('close');
        }, timeout);
    });
</script>
</body>
</html>
