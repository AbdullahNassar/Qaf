@extends('admin.layouts.master')
@section('title')
    الاشعارات
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{route('admin.home')}}">الرئيسيه</a>
                    <i class="fa fa-angle-left"></i>
                </li>
                <li>
                    <span>الرسائل</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-hide hide"></i>
                            <span class="caption-subject font-hide bold uppercase">الرسائل</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                            <ul class="chats" id="show-messages">
                                @foreach($messages as $message)
                                <li class="@if($message->sender_id ==0) in @else out @endif">
                                    <img class="avatar" alt="" src="@if($message->sender_id ==0) http://knowledge-commons.com/static/assets/images/avatar.png @else {{url('storage/uploads/profile/'.$message->member->image)}} @endif" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> @if($message->sender_id ==0) الاداره @else {{($message->member->f_name )?$message->member->f_name .' '. $message->member->l_name : $message->member->phone}} @endif </a>
                                        <span class="datetime"> {{$message->created_at->diffForhumans()}} </span>
                                        <span class="body"> {{$message->massage}} </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <form method="post" action="{{route('admin.notifications.send')}}" onsubmit="return false;">
                            <input type="hidden" name="receiver_id" value="{{$receiver_id}}" />
                            <input type="hidden" id="massage_id" name="massage_id" value="{{$messages?$message->massage_id:''}}" />
                        <div class="chat-form">
                            <div class="input-cont">
                                <input class="form-control" id="message-content" name="message" type="text" placeholder="Type a message here..." />
                            </div>
                            <div class="btn-cont">
                                <span class="arrow"> </span>
                                <button class="btn blue icn-only chat-messages">
                                    <i class="fa fa-check icon-white"></i>
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
@endsection