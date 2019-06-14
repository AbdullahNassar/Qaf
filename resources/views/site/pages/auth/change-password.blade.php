@extends('site.layouts.master')
@section('title')
    تغيير كلمه المرور
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-title">
        <div class="container">
            <h2 class="title">تغيير كلمه المرور</h2>
        </div><!--End container-->
    </div><!--End page-header-title-->
    <div class="page-header-info">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                <li class="active">تغيير كلمه المرور</li>
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
                        <h3 class="title title-md">تغيير كلمه المرور</h3>
                        <div class="alert alert-success hidden " id="success"></div>
                        <div class="alert alert-danger hidden " id="error"></div>
                        <form class="sign-form change-password-ajax" method="post" action="{{route('site.change-password',['id'=>$member->id,'hash'=>$hash])}}" onsubmit="return false">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="كلمه المرور الجديدة">
                            </div><!--End form-group-->
                            <div class="form-group">
                                <input type="password" name="confirm-password" class="form-control" placeholder="تأكيد كلمه المرور الجديدة">
                            </div><!--End form-group-->
                            <button class="custom-btn btn-block">تحديث</button>
                        </form><!-- End Form -->
                    </div><!-- End Sign-Form -->
                </div><!--End col-md-6-->
            </div><!--End row-->
        </div><!-- End container -->
    </section><!-- End-->
</div><!--End page-content-->
@endsection