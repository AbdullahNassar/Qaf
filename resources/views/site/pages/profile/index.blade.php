@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">لوحه التحكم</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">لوحه التحكم</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="dashbord">
            <div class="container">
                <div class="row">
                @include('site.pages.profile.sidebar')
                    <div class="col-md-9">
                        <div class="dash-cont">
                            <div class="dash-cont-head box-item">
                                <div class="dash-head-title">
                                    <h4>مرحبا {{$member->f_name}}</h4>
                                    <span>
                                        اخر تفاعل منذ 1 ساعة
                                    </span>
                                </div><!--End dash-head-title-->
                                <ul class="dash-quick-nav">
                                    <li>
                                        <a href="{{route('site.profile.messages')}}">
                                            <i class="fa fa-envelope"></i>
                                            <span>{{count($member->allMessages())}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('site.profile.favorite')}}">
                                            <i class="fa fa-heart"></i>
                                            <span>{{count($member->countWishlist())}}</span>
                                        </a>
                                    </li>
                                </ul><!--End dash-quick-nav-->
                            </div><!--End dash-cont-head-->
                            <div class="row dash-state">
                                <div class="col-md-6">
                                    <div class="box-item no-padding panel-box">
                                        <div class="panel-box-head">
                                            <a href="{{route('site.profile.messages')}}">
                                                <h3 class="title title-sm">
                                                    الرسائل الجديدة
                                                </h3>
                                                <span class="panel-num">{{count($member->newMessages())}}</span>
                                            </a>
                                        </div><!--End panel-box-head-->
                                        <div class="panel-box-foot">
                                            <a href="{{route('site.profile.received')}}">
                                                <h3 class="title title-sm">
                                                    الرسائل الواردة
                                                </h3>
                                                <span class="panel-num">{{count($member->receivedMessages())}}</span>

                                            </a>
                                            <a href="{{route('site.profile.sent')}}">
                                                <h3 class="title title-sm">
                                                    الرسائل الصادرة
                                                </h3>
                                                <span class="panel-num">{{count($member->sentMessage())}}</span>
                                            </a>
                                        </div><!--End panel-box-foot-->
                                    </div><!-- End Icon-Box -->
                                </div><!-- End col-md-6-->
                                <div class="col-md-6">
                                    <div class="box-item no-padding panel-box">
                                        <div class="panel-box-head">
                                            <div>
                                                <h3 class="title title-sm">
                                                    عدد مشاهدات حسابى
                                                </h3>
                                                <span class="panel-num">{{$member->visits}}</span>
                                            </div>
                                        </div><!--End panel-box-head-->
                                        <div class="panel-box-foot">
                                            <a href="">
                                                <h3 class="title title-sm">
                                                    المتابعون
                                                </h3>
                                                <span class="panel-num">{{count($member->followers())}}</span>
                                            </a>
                                            <a href="{{route('site.profile.favorite')}}">
                                                <h3 class="title title-sm">
                                                    مفضلتى
                                                </h3>
                                                <span class="panel-num">{{count($member->countWishlist())}}</span>

                                            </a>
                                        </div><!--End panel-box-foot-->
                                    </div><!-- End Icon-Box -->
                                </div><!-- End col-md-6-->
                                <div class="col-md-12">
                                    <div class="box-item pro-stats">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="{{route('site.profile.public',['username'=>$member->username])}}" class="pro-stats-all">
                                                    <h3 class="title">
                                                        اعلاناتى
                                                    </h3>
                                                    <span>{{count($member->allAds())}}</span>
                                                </a>
                                            </div><!--End col-md-4-->
                                            <div class="col-md-4">
                                                <a href="#" class="progress-item">
                                                    <div class="progress-label">
                                                        <span>
                                                                قيد المراجعة({{count($member->underReview())}})
                                                        </span>

                                                        <span>@if(sizeof($member->allAds()) > 0){{( count($member->underReview()) * 100)  /count($member->allAds() )}}@else{{0}}@endif%</span>

                                                    </div>
                                                    <div class="progress">
                                                        @if(sizeof($member->allAds()) > 0)
                                                            <div class="progress-bar prog-processing not-loaded" data-width="{{( count($member->underReview()) * 100)  /count($member->allAds() )}}"></div>
                                                        @endif
                                                    </div>
                                                </a><!--End Progress-item-->

                                                <a href="#" class="progress-item">
                                                    <div class="progress-label">
                                                        <span>
                                                            النشطه({{count($member->activeAds())}})
                                                        </span>

                                                        <span>@if(sizeof($member->allAds()) > 0){{( count($member->activeAds()) * 100) /count($member->allAds())}}@else{{0}}@endif%</span>

                                                    </div>
                                                    <div class="progress">
                                                        @if(sizeof($member->allAds()) > 0)
                                                            <div class="progress-bar prog-active not-loaded" data-width="{{( count($member->activeAds()) * 100) /count($member->allAds())  }}"></div>
                                                        @endif
                                                    </div>
                                                </a><!--End Progress-item-->
                                            </div><!--End col-md-4-->
                                            <div class="col-md-4">
                                                <a href="#" class="progress-item">
                                                    <div class="progress-label">
                                                        <span>
                                                                الملغاة({{count($member->cancelledAd())}})
                                                        </span>
                                                        <span>@if(sizeof($member->allAds()) > 0){{( count($member->cancelledAd()) * 100 ) / count($member->allAds()) }}@else{{0}}@endif%</span>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar prog-cancel not-loaded" data-width="@if(sizeof($member->allAds()) > 0){{( count($member->cancelledAd()) * 100 ) / count($member->allAds()) }}@endif"></div>
                                                    </div>
                                                </a><!--End Progress-item-->
                                                <a href="#" class="progress-item">
                                                    <div class="progress-label">
                                                        <span>
                                                                المكتملة(80)
                                                        </span>
                                                        <span>90%</span>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar prog-complete not-loaded" data-width="90"></div>
                                                    </div>
                                                </a><!--End Progress-item-->
                                            </div><!--End col-md-4-->
                                        </div><!--End Row-->
                                    </div>
                                </div><!-- End col-md-3-->
                            </div><!--End dash-state-->
                        </div><!--End dash-cont-->
                    </div><!--End col-md-9-->
                </div><!--End row-->
            </div><!--End container-->
        </section><!--End dashbord-->
    </div><!--End page-content-->
@endsection