@extends('site.layouts.master')
@section('title')
    تسجيل الدخول
@endsection
@section('content')

<div class="page-header">
    <div class="page-header-title">
        <div class="container">
            <h2 class="title">تسجيل الدخول</h2>
        </div><!--End container-->
    </div><!--End page-header-title-->
    <div class="page-header-info">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                <li class="active">تسجيل الدخول</li>
            </ul>
        </div><!--End container-->
    </div><!-- End Page-Header-Info -->
</div><!-- End page-header-->
<div class="page-content">
    <section class="section-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="section-head">
                        <div class="section-head-img">
                            <img src="{{asset('assets/site/images/logo.png')}}">
                        </div><!--End section-head-img-->
                    </div><!--End section-head-->
                    <div class="box-item">
                        <h3 class="title title-md">تسجيل الدخول</h3>
                        <div class="alert alert-success hidden " id="success"></div>
                        <div class="alert alert-danger hidden " id="error"></div>
                        <form class="sign-form login-ajax" method="post" action="{{route('site.login')}}" onsubmit="return false">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="اسم المستخدم او رقم الهاتف او البريد الالكترونى">
                            </div><!--End form-group-->
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
                            </div><!--End form-group-->
                            <div class="form-group">
                                <div class="reset-new-user">
                                    <a href="{{route('site.reset')}}" class="pull-left">
                                        هل نسيت كلمة المرور؟
                                    </a>
                                    <a href="{{route('site.register')}}" class="pull-right">
                                        تسجيل عضو جديد ؟
                                    </a>
                                </div><!--End reset-new-user-->
                            </div><!--End form-group-->
                            <button class="custom-btn btn-block">سجل الدخول</button>
                        </form><!-- End Form -->
                    </div><!-- End Sign-Form -->
                </div><!--End col-md-6-->
            </div><!--End row-->
        </div><!-- End container -->
    </section><!-- End-->
</div><!--End page-content-->

@endsection