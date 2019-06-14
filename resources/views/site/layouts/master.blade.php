<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tags
        ========================== -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        @foreach($metas as $meta)
            <meta name="{{$meta->name}}" content="{{$meta->value}}">
        @endforeach

        <!-- Site Title
        ========================== -->
        <title>{{$settings->name}} | @yield('title')</title>

        <!-- Favicon
        ===========================-->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site/images/fav.png')}}">

        <!-- Web Fonts
        ========================== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">

        <!-- Base & Vendors
        ========================== -->

        <link rel="stylesheet" href="{{asset('assets/site/vendor/bootstrap/css/bootstrap-ar.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/fonts/icommon/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/fonts/icommon-subacate/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/flex-slider2/flexslider.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/jquery.bxslider/jquery.bxslider.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/bootstrap-select/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/tagsinput/css/tagsinput.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/dropzone/dropzone.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/rating-plugin/rateit.css')}}">
          @yield('styles')
        <!-- Site Style
        ========================== -->
        <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/site.css')}}">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <div class="wrapper">
        <!-- BEGIN HEADER -->
            @include('site.layouts.header')
        <!-- END HEADER -->
        <div class="main">
            <!-- BEGIN CONTENT -->
                @yield('content')
            <!-- END CONTENT -->
            <!-- BEGIN FOOTER -->
            @include('site.layouts.footer')
            <!-- END FOOTER -->
        </div>
    </div><!-- End Wrapper -->

    <script src="{{asset('assets/site/vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/site/vendor/tinymce/js/tinymce/langs/ar.js')}}"></script>
    <script src="{{asset('assets/site/vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/site/vendor/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/site/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/site/vendor/flex-slider2/jquery.flexslider.js')}}"></script>
    <script src="{{asset('assets/site/vendor/jquery.bxslider/jquery.bxslider.min.js')}}"></script>
    <script src="{{asset('assets/site/vendor/tagsinput/js/tagsinput.js')}}"></script>
    <script src="{{asset('assets/site/vendor/rating-plugin/jquery.rateit.min.js')}}"></script>
    <script src="{{asset('assets/site/vendor/scrollto.js')}}"></script>
    <script src="{{asset('assets/site/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
    <script src="{{asset('assets/admin/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/site/vendor/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/site/vendor/dropzone/form-dropzone.js')}}"></script>
    <script src="{{asset('assets/site/vendor/bootstrap-select/js/app.js')}}"></script>
    <script src="{{asset('assets/site/vendor/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/site/vendor/bootstrap-select/js/components-bootstrap-select.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
    <script src="{{asset('assets/site/js/site.js')}}"></script>
    <script src="{{asset('assets/admin/ajax.js')}}"></script>

    <script src="{{asset('assets/site/js/main.js')}}"></script>

    </body>
</html>