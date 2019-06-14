@extends('site.layouts.master')
@section('title')
    الرسائل الوارده
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">الرسائل الوارده</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">الرسائل الوارده</li>
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
                        <ul class="messages-nav">
                            <li>
                                <a href="{{route('site.profile.messages')}}">كل الرسائل</a>
                            </li>
                            <li class="active">
                                <a href="{{route('site.profile.sent')}}">الرسائل الصادرة</a>
                            </li>
                            <li>
                                <a href="{{route('site.profile.received')}}">الرسائل الواردة</a>
                            </li>
                        </ul><!--End messages-nav-->
                        @if(sizeof($messages) < 1)
                            <div class="messages-content">
                                <div class="alert alert-danger text-center">
                                    <h3>لا توجد رسائل حتي الان</h3>
                                </div>
                            </div>
                        @else

                        <div class="messages-content">
                            @foreach($messages as $message)
                                <a href="{{route('site.message.only', ['message_id' => $message->id])}}" class="user-message">
                                    <div class="user-img">
                                        <img src="{{asset('storage/uploads/profile/'.$message->image)}}">
                                    </div><!-- End User-Img -->
                                    <div class="message-head">
                                        <h3 class="title title-sm">
                                            {{$message->name}}
                                        </h3>
                                        <p>
                                            <i class="fa fa-clock-o"></i>
                                            {{$message->created_at->diffForHumans()}}
                                        </p>
                                    </div><!-- End Message-head -->
                                    <div class="message-content">
                                        <h3 class="title title-sm">
                                            {{$message->ad}}
                                        </h3>
                                        <p>{{str_limit($message->message ,10)}}</p>
                                    </div><!-- End Message-Content -->
                                    <div class="message-action">
                                        <i class="fa fa-star-o"></i>
                                    </div><!-- End Message-Action -->
                                </a><!-- End User-Message -->
                            @endforeach
                        </div><!--End tab-content-->
                        @endif
                    </div><!-- End col-md-9 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection