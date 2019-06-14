@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">اعدادات الحساب</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">اعدادات الحساب</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md">
            <div class="container">
                <div class="row">
                    <form class="update-profile-form" method="post" action="{{route('site.profile.settings')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input name="id" type="hidden" value="{{$member->id}}"/>
                        <div class="col-md-3">
                            <div class="dash-side box-item no-padding">
                                <div class="dash-side-head  file-box">
                                    <img src="{{$member->image?url('storage/uploads/profile/'.$member->image):asset('assets/site/images/user-img.jpg')}}" class="img-responsive mr-bot-15 profile-user-img  file-btn "
                                         style="cursor:pointer;">
                                    <input type="file" style="display:none;" name="image">
                                </div><!--End dash-side-head-->
                                <div class="dash-side-content">
                                    <ul class="dash-side-nav">
                                        <li @if(Request::route()->getName() == 'site.profile')class="active"@endif>
                                            <a href="{{route('site.profile')}}">
                                                لوحة التحكم
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('site.profile.messages')}}">
                                                الرسائل
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'site.profile.ads')class="active"@endif>
                                            <a href="{{route('site.profile.ads')}}">
                                                اعلاناتى
                                            </a>
                                        </li>

                                        <li @if(Request::route()->getName() == 'site.profile.favorite')class="active"@endif>
                                            <a href="{{route('site.profile.favorite')}}">
                                                مفضلتى
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'site.profile.package')class="active"@endif>
                                            <a href="{{route('site.profile.package')}}">
                                                باقاتى
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'site.profile.followers')class="active"@endif>
                                            <a href="{{route('site.profile.followers')}}">
                                                المتابعون
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'site.profile.get-notification')class="active"@endif>
                                            <a href="{{route('site.profile.get-notification')}}">
                                                الاشعارات
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'result-search')class="active"@endif>
                                            <a href="{{route('result-search')}}">
                                                نتائج البحث
                                            </a>
                                        </li>
                                        <li @if(Request::route()->getName() == 'site.profile.settings')class="active"@endif>
                                            <a href="{{route('site.profile.settings')}}">
                                                الملف الشخصى
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('site.profile.closeAccount')}}">
                                                اغلاق الحساب
                                            </a>
                                        </li>
                                    </ul><!--End dash-side-nav-->
                                </div><!--End dash-side-content-->
                            </div>
                            <!--End dash-side-->
                        </div><!--End col-md-3-->
                        <div class="col-md-9">
                            <div class="box-item form-group">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="section-head">
                                    <h3 class="section-title">
                                        معلومات العنوان
                                    </h3>
                                </div><!-- End Section-Head -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="f_name" value="{{$member->f_name}}" placeholder="الاسم الاول">
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="l_name" value="{{$member->l_name}}" placeholder="الاسم الاخير">
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" value="{{$member->username}}" placeholder="username">
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="ui-select-box" name="country_id">
                                                @foreach($countries as $cat)
                                                    <option value="{{$cat->id}}" @if($cat->id == $member->country_id) selected @endif > {{$cat->name}} </option>
                                                @endforeach
                                            </select>
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                </div><!--End row-->
                            </div><!--End box-item-->
                            <div class="box-item">
                                <div class="section-head">
                                    <h3 class="section-title">
                                        تغيير رقم الهاتف
                                    </h3>
                                </div><!-- End Section-Head -->
                                <div class="row">
                                    <div class="form-group">
                                        <label for="phone" class="verified">
                                            <a  data-toggle="modal" data-target="#change-phone" href="#change-phone">
                                                اضافة رقم الهاتف
                                            </a>
                                        </label>

                                        <div class="col-md-6">
                                            <input id="phone" type="tel" class="form-control" value="{{$member->phone}}" disabled>
                                        </div><!-- End col-md-6-->
                                    </div><!--End form-group-->
                                </div><!--End row-->
                            </div><!--End box-item-->
                            <div class="box-item">
                                <div class="section-head">
                                    <h3 class="section-title">
                                        تغيير البريد الالكترونى
                                    </h3>
                                </div><!-- End Section-Head -->
                                <div class="row">
                                    <div class="form-group">
                                        <label for="email" class="verified">
                                            <span class="icon-success"></span>
                                            موثق
                                            <a data-toggle="modal" data-target="#change-email" href="#">
                                                تغير
                                            </a>
                                        </label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" value="{{$member->email}}" disabled>
                                        </div><!-- End col-md-6-->
                                    </div><!--End form-group-->
                                </div><!--End row-->
                            </div><!--End box-item-->
                            <div class="box-item">
                                <div class="section-head">
                                    <h3 class="section-title">
                                        تنبيهات الإيميل
                                    </h3>
                                </div><!-- End Section-Head -->
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label class="verifie" >
                                                    <input type="checkbox" value="">
                                                    <strong>نعم</strong>
                                                    ، أود الحصول على رسائل دوريَة
                                                    <i data-toggle="tooltip" data-placement="left" title="
									نقوم من حين إلى آخر بإرسال رسائل دوريّة إلى جميع مستخدمي أوليكس، تتضمّن أحدث المستجدات وأبرز التغييرات التي نُجريها على خدماتنا، كما نُعلن فيها عن منتجاتنا الجديدة وحملاتنا الترويجية. إن كنت ترغب في متابعة أحدث أخبارنا، إشترك في رسائلنا الدوريّة.                         		" class="fa fa-exclamation" aria-hidden="true"></i>
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                    <strong>نعم</strong>
                                                    ، أود الحصول على تنبيهات عند استلام رسائل جديدة
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                    <strong>نعم</strong>
                                                    ، أود الحصول على تنبيهات عند إضافة إعلانات جديدة لبحوثي المحفوظة
                                                </label>
                                            </div>
                                        </div><!-- End col-md-6-->
                                    </div><!--End form-group-->
                                </div><!--End row-->
                            </div><!--End box-item-->
                            <div class="box-item">
                                <div class="section-head">
                                    <h3 class="section-title">
                                        تغيير كلمة السر
                                    </h3>
                                </div><!-- End Section-Head -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input  type="password" name="oldPassword" class="form-control" placeholder=" كلمة السر القديمه">
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" name="newPassword" class="form-control" placeholder=" كلمة السر الجديده">
                                        </div><!--End form-group-->
                                    </div><!-- End col-md-6-->
                                </div><!--End row-->
                            </div><!--End box-item-->
                            <button type="submit" class="custom-btn pull-right">حفظ التغييرات</button>
                        </div><!-- End col col-md-9-->
                    </form>
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
    <div class="modal fade" id="change-email" tabindex="-1" role="dialog" aria-labelledby="change-email">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form update-profile-form" method="post" action="{{route('site.profile.settings')}}" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="{{$member->id}}"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">تغير البريد  الالكترونى</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input  type="email" class="form-control" value="{{$member->email}}" disabled>
                        </div><!--End form-group-->
                        <div class="form-group">
                            <input  type="email" class="form-control" id="new-email" name="email" placeholder="البريد الالكتروني الجديد">
                        </div> <!-- End form-group -->
                        <div class="form-group">
                            <input  type="text" class="form-control hidden" id="code-confirm" name="code" placeholder="رقم التاكيد">
                        </div> <!-- End form-group -->
                    </div><!--End modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="custom-btn pull-right">حفظ التغييرات</button>
                    </div>
                </form><!--End Form-->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="change-phone" tabindex="-1" role="dialog" aria-labelledby="change-phone">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form update-profile-form" method="post" action="{{route('site.profile.settings')}}" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="{{$member->id}}"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">تغير رقم  الهاتف</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input  type="tel" class="form-control" value="{{$member->phone}}" disabled>
                        </div> <!-- End form-group -->
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="رقم  الهاتف الجديد">
                        </div> <!-- End form-group -->
                    </div><!--End modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="custom-btn pull-right">حفظ التغييرات</button>
                    </div>
                </form><!--End Form-->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection