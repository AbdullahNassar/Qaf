@extends('site.layouts.master')
@section('title')
    {{$member->username}}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">{{$member->username}}</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">{{$member->username}}</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md pro-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-item auther-block">
                            <div class="auther-block--head">
                                <div class="auther-img">
                                    <img src="{{asset('storage/uploads/profile/'.$member->image)}}">
                                </div><!--End auther-img-->
                                <div class="auther-info">
                                    <h4 class="auther-name">
                                        {{$member->f_name}} {{$member->l_name}}
                                    </h4>
                                    <h4 class="auther-location">
                                        <i class="fa fa-map"></i>
                                        {{$member->country['name']}}
                                    </h4>
                                    <h4 class="auther-mail">
                                        <i class="fa fa-envelope"></i>
                                        {{$member->email}}
                                    </h4>
                                    <h4 class="auther-phone">
                                        <i class="fa fa-phone"></i>
                                        {{$member->phone}}
                                    </h4>
                                </div><!--End auther-info-->
                            </div><!--End auther-block--head-->
                            <div class="auther--communicate">
                                <button class="custom-btn" data-toggle="modal" data-target="#send-message" >
                                    <i class="fa fa-envelope"></i>
                                    اتصل
                                </button>
                                @if(Auth::guard('members')->check())
                                <button class="custom-btn FollowBTN" data-url="{{route('site.profile.follow',['id'=>$member->id])}}" data-token="{!! csrf_token() !!}">
                                    <i class="fa fa-user-plus"></i>
                                    <span class="FollowText">
                                        @if(count(\App\Follower::where('follower_id' ,Auth::guard('members')->user()->id)->where('followed_id' ,$member->id)->first()) > 0)
                                            الغاء المتابعه
                                        @else
                                            متابع
                                        @endif
                                    </span>
                                </button>
                                @endif
                            </div><!--End auther--communicate-->
                            <div class="author--share">
                                <ul class="social-list">
                                    @if(!empty($member->facebook))
                                    <li>
                                        <a href="{{$member->facebook}}">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty($member->twitter))
                                        <li>
                                            <a href="{{$member->twitter}}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if(!empty($member->google))
                                        <li>
                                            <a href="{{$member->google}}">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div><!--End author--share-->
                        </div>
                    </div><!--End col-md-4-->
                    <div class="col-md-8">
                        <div class="box-item">
                            <h3 class="section-title">نبذة عنى</h3><!-- End Section-Title -->.
                            <p>
                                {{$member->information}}
                            </p>
                        </div> <!-- End box-item -->
                    </div> <!-- End Col -->
                </div><!--End row-->
            </div><!-- End Container -->
        </section><!-- End section-md -->
        <section class="section-md">
            <div class="container">
                <div class="section-head has-border">
                    <h3 class="section-title">اعلاناتى</h3><!-- End Section-Title -->
                </div>
                <div class="row">
                    @foreach($ads as $ad)
                        <div class="col-md-3">
                            <div class="pro-item">
                                <div class="pro-item-head">
                                    <div class="pro-item-img">
                                        <img src="{{asset('storage/uploads/banners/'.$ad->images[0]->image)}}">
                                    </div><!--End pro-item-itmg-->
                                    <div class="verified" data-toggle="tooltip" data-placement="left" title="موثوق">
                                        <i class="fa fa-check-square-o"></i>
                                    </div>
                                </div><!-- End pro-item-head -->
                                <div class="pro-item-content">
                                    <div class="title-price">
                                        <h3 class="title">{{$ad->name}}</h3>
                                        <span class="price">{{$ad->price}} ر.س</span>
                                    </div><!-- End Title-Price -->
                                    <ul class="breadcrumb">
                                        <li><a href="{{route('site.category',['slug' => $ad->MainCategory()->slug])}}">{{$ad->MainCategory()->name}}</a></li>
                                        <li class="active">{{$ad->type['name']}}</li>
                                    </ul>
                                    {!! $ad->description !!}
                                    <div class="pro-item--map-date">
                                        <div class="pro-item--map">
                                            <i class="fa fa-map-marker"></i>
                                            @foreach($ad->places as $place)
                                                {{$place->name}} ,
                                            @endforeach
                                        </div><!--End pro-item--map-->
                                        <div class="pro-item--date">
                                            <i class="fa fa-clock-o"></i>
                                            {{ar_date($ad->created_at->timestamp)}}
                                        </div><!--End pro-item--date-->
                                    </div><!--End map-date-->

                                    <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                                </div><!-- End pro-item-Content -->
                            </div><!-- End pro-item -->
                        </div><!--End col-md-3-->
                    @endforeach
                </div><!-- End row -->
                @if(sizeof($ads) > 0)
                    {{$ads->links()}}
                @endif
            </div><!-- End container -->
        </section><!-- End Section -->
    </div><!--End page-content-->
    <div class="modal fade" id="send-message" tabindex="-1" role="dialog" aria-labelledby="send-message">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form contact-seller" method="post" action="{{route('site.profile.public',['username'=>$member->username])}}">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ارسال رسالة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="message"  class="form-control"  rows="5" placeholder="ارسل رسالتك  هنا"></textarea>
                        </div><!--End form-group-->
                    </div><!--End modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="custom-btn pull-right">ارسال رساله</button>
                    </div>
                </form><!--End Form-->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection