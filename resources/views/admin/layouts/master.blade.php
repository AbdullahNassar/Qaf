<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin RTL Theme #2 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <meta content="{{ csrf_token() }}" name="csrf" />

        <!-- Fav Icon
		===========================-->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site/images/fav.png')}}">

        <!-- Google Web Fonts
		===========================-->
        <link href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">

        <!-- BEGIN Vendor GLOBAL STYLES
        ===============================-->
        <link rel="stylesheet" href="{{asset('assets/admin/global/plugins/font-awesome/css/font-awesome.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}"/>

        <!-- BEGIN THEME GLOBAL STYLES
        ===============================-->
        <link rel="stylesheet" href="{{asset('assets/admin/global/css/components-rtl.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/global/css/custom-style.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/global/css/plugins-rtl.min.css')}}"/>

        <!--BEGIN THEME LAYOUT STYLES
        =================================-->
        <link rel="stylesheet" href="{{asset('assets/admin/layouts/layout2/css/layout-rtl.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/admin/layouts/layout2/css/themes/blue-rtl.min.css')}}" id="style_color" />
        <link rel="stylesheet" href="{{asset('assets/admin/layouts/layout2/css/custom-rtl.min.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/admin/sweetalert.css')}}">

    </head> <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @include('admin.layouts.header')
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('admin.layouts.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                @yield('content')
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- BEGIN FOOTER -->
        @include('admin.layouts.footer')
        <!-- END FOOTER -->
        @yield('modals')
        @yield('templates')

        <!-- common edit modal with ajax for all project -->
        <div id="common-modal" class="modal fade" role="dialog">
            <!-- modal -->
        </div>

        <!-- delete with ajax for all project -->
        <div id="delete-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
            </div>
        </div>
        <script id="template-modal" type="text/html" >
                <div class = "modal-content" >
                    <input type = "hidden" name = "_token" value="{{ csrf_token() }}" >
                    <div class = "modal-header" >
                        <button type = "button" class = "close" data - dismiss = "modal" > &times; </button>
                        <h4 class = "modal-title bold" > حذف العنصر ؟</h4>
                    </div>
                    <div class = "modal-body" >
                        <p > هل انت متاكد ؟</p>
                    </div>
                    <div class = "modal-footer" >
                        <a
                            href = "{url}"
                            id = "delete" class = "btn btn-danger" >
                            <li class = "fa fa-trash" > </li> حذف
                        </a>

                        <button type = "button" class = "btn btn-warning" data-dismiss = "modal" >
                            <li class = "fa fa-times" > </li> الغاء </button >
                    </div>
                </div>
            </script>


            @include('admin.templates.loading')
            @include('admin.templates.alerts')
            @include('admin.templates.delete-modal')

            <form action="#" id="csrf">{!! csrf_field() !!}</form>
            <!-- END CONTAINER  -->
            <!--[if lt IE 9]>
            <script src="{{asset('assets/admin/global/plugins/respond.min.js')}}"></script>
            <script src="{{asset('assets/admin/global/plugins/excanvas.min.js')}}"></script>
            <script src="{{asset('assets/admin/global/plugins/ie8.fix.min.js')}}"></script>
            <![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            <script src="{{asset('assets/admin/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->

            <script src="{{asset('assets/site/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
            <script src="{{asset('assets/admin/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{asset('assets/admin/global/scripts/app.min.js')}}" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{asset('assets/admin/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{asset('assets/admin/layouts/layout2/scripts/layout.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/layouts/layout2/scripts/demo.min.js')}}" type="text/javascript"></script>
            <script src="{{asset('assets/admin/sweetalert.min.js')}}"></script>
            <script src="{{asset('assets/admin/ajax.js')}}"></script>
            @yield('scripts')
            <!-- END THEME LAYOUT SCRIPTS -->
        </body>

    </html>
