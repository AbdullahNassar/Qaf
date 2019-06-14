@extends('site.layouts.master')
@section('title')
المتابعين
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">المتابعين</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">المتابعين</li>
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
                        <div class="section-head has-border">
                            <h3 class="section-title">المتابعون</h3><!-- End Section-Title -->
                        </div>
                        <div class="row">
                            @if(sizeof($followers) > 0)
                            @foreach($followers as $follower)
                                <div class="col-md-6 FDIV">
                                    <div class="user-follower">
                                        <div class="user-img">
                                            <img src="{{asset('storage/uploads/profile/'.$follower->image)}}">
                                        </div><!-- End User-Img -->
                                        <div class="user-info">
                                            <h3 class="title title-md">
                                                {{$follower->name}}
                                            </h3>
                                            <p>
                                                {{$follower->email}}
                                            </p>
                                        </div><!-- End User-Info -->
                                        <div class="user-action">
                                            <button class="custom-btn followerDelete" data-token="{!! csrf_token() !!}" data-url="{{route('site.followers.delete',['id'=>$follower->id])}}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <button class="custom-btn" data-toggle="modal" data-target="#send-message{{$follower->id}}">
                                                <i class="fa fa-envelope"></i>
                                            </button>
                                        </div><!-- End User-Action -->
                                    </div><!-- End User-Follower -->
                                </div><!-- End col -->
                            @endforeach
                                @else

                            <div class=" alert alert-danger text-center">
                                <h3>لا توجد رسائل حتي الان</h3>
                            </div>

                            @endif
                        </div><!-- End row -->
                    </div><!-- End col -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
    @foreach($followers as $follower)
        <div class="modal fade" id="send-message{{$follower->id}}" tabindex="-1" role="dialog" aria-labelledby="send-message">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form contactFollower" method="post" action="{{route('site.followers.contact',['id' => $follower->founder_id])}}">
                        {!! csrf_field() !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> ارسال رسالة</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="5" placeholder="ارسل رسالتك  هنا"></textarea>
                            </div> <!-- End form-group -->

                        </div><!--End modal-body-->
                        <div class="modal-footer">
                            <button type="submit" class="custom-btn pull-right">حفظ التغييرات</button>
                        </div>
                    </form><!--End Form-->
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach
@endsection