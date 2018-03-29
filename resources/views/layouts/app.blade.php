<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- style.css refrences from style.scss -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/paper-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('bower_components/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css') }}">
</head>
<body ng-app="app">
   
    @yield('header')

    <div id="app">
        @yield('content')
    </div>


    <!-- Scripts -->
    <script src="{{ asset('jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    
    <!-- DatePicker Bootstrap -->
   <!--  <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script> -->
   <!--  <script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script> -->
    <script src="{{ asset('bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Particle JS -->
    <script src="{{ asset('js/particles.js') }}"></script>
    <script src="{{ asset('js/app2.js') }}"></script>
    <script src="{{ asset('js/stats.js') }}"></script>

    <!--Setup Angular.JS-->
    <script src="{{ asset('angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>

   <script type="text/javascript">
       $(document).ready(function() {
           /*$("#datetimepicker1").datetimepicker();*/
            $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

       });
   </script>

    @yield('script')

</body>
</html>
