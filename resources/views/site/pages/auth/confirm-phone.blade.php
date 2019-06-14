@extends('site.layouts.master')
@section('title')
    تفعيل الحساب
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
                <li class="active">تفعيل الحساب</li>
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
                        <h3 class="title title-md">تفعيل الحساب</h3>
                        <div class="alert alert-success hidden " id="success"></div>
                        <div class="alert alert-danger hidden " id="error"></div>
                        <form class="sign-form confirm-code-ajax" action="{{route('site.confirm',['username'=>$user->username])}}" method="post" onsubmit="return false">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$user->id}}" name="user_id"/>
                            <div class="form-group">
                                <input type="text" name="code" class="form-control" placeholder="أدخل كود التفعيل">
                            </div><!--End form-group-->
                            <button class="custom-btn btn-block">تفعيل</button>
                        </form><!-- End Form -->
                    </div><!-- End Sign-Form -->
                </div><!--End col-md-6-->
            </div><!--End row-->
        </div><!-- End container -->
    </section><!-- End-->
</div><!--End page-content-->
@endsection