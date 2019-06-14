@extends('site.layouts.master')
@section('title')
    الاشعارات
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">الاشعارات</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">الاشعارات</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md">
            <div class="container">
                <div class="row">
                    @include('site.pages.profile.sidebar')
                    <div class="col-md-9">
                        @if(count($notifications)>0)
                        <div class="messages-content">
                            @foreach($notifications as $notification)
                                <a href="{{route('site.profile.get-notification-one',['id'=>$notification->id])}}" class="user-message">
                                    <div class="message-head">
                                        <p>
                                            <i class="fa fa-clock-o"></i>
                                            {{$notification->created_at->diffForHumans()}}
                                        </p>
                                    </div><!-- End Message-head -->
                                    <div class="message-content">
                                        <p>{{str_limit($notification->message ,150)}}</p>
                                    </div><!-- End Message-Content -->
                                </a><!-- End User-Message -->
                            @endforeach
                        </div><!--End tab-content-->
                        @else
                            <div class="messages-content">
                                <div class="alert alert-danger text-center">
                                    <h3>لا توجد اشعارات حتي الان</h3>
                                </div>
                            </div>
                        @endif
                    </div><!-- End col-md-9 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection