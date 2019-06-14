@extends('site.layouts.master')
@section('title')
    {{$notifications[0]->massage}}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">{{$notifications[0]->massage}}</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">{{$notifications[0]->massage}}</li>
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
                        <div class="message-detail box-item">
                            <div class="message-detail-head">
                                <h3 class="title title-md">{{$notifications[0]->massage}}</h3>
                                <button class="custom-btn">رؤوية الاعلان</button>
                            </div><!--End message-detail-head-->
                            <div id="show-messages" class="message-detail-cont">
                                @foreach($notifications as $message)
                                <div class="user-comment @if($message->sender_id ==0) recived-message @else sent-message @endif">
                                    <div class="comment-head">
                                        <div class="comment-head-img">
                                           <img class="avatar" alt="" src="@if($message->sender_id ==0) http://knowledge-commons.com/static/assets/images/avatar.png @else {{url('storage/uploads/profile/'.$message->member
                                           ->image)}} @endif" />
                                        </div><!--End comment-head-img-->
                                        <div class="comment-head-cont">
                                            <h3 class="title-sm">@if($message->sender_id ==0) الاداره @else {{($message->member->f_name )?$message->member->f_name .' '. $message->member->l_name : $message->member->phone}} @endif</h3>
                                            <span class="comment-date">
                                                <i class="fa fa-clock-o"></i>
                                                 {{$message->created_at->diffForhumans()}}
                                            </span><!--End comment-date-->
                                        </div><!--End comment-head-cont-->
                                    </div><!--End comment-head-->
                                    <div class="comment-content">
                                        <p>{{$message->massage}}</p>
                                    </div><!--End comment-content-->
                                </div><!--End user-comment-->
                                @endforeach
                            </div><!--End message-detail-cont-->
                        </div><!--End message-detail-->
                        <div class="box-item no-padding">
                            <div class="box-item-head no-margin">
                                <h3 class="title title-sm">
                                    أضف رد
                                </h3>
                            </div><!--End box-item-head-->
                            <div class="box-item-body">
                                <form class="replay-form" id="send-messages" action="{{route('site.profile.send-notification')}}">
                                    <input name="massage_id" type="hidden" value="{{$message->massage_id}}"/>
                                    <div class="form-group">
                                        <textarea id="message-content" class="form-control" name="message" placeholder="اكتب الرساله" rows="8"></textarea>
                                    </div><!--End review-form-->
                                    <div class="form-group">

                                    </div><!--End review-form-->
                                    <button class="custom-btn btn-block">
                                        ارسال
                                    </button>
                                </form><!--End review-form-->
                            </div><!--End box-item-body-->
                        </div><!--End box-item-->
                    </div><!-- End col-md-9 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection