@extends('site.layouts.master')
@section('title')
    {{$ad->name}}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">تفاصيل الاعلان</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">تفاصيل الاعلان</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md pro-detail">
            <div class="container">
                <div class="box-item pro-detail-action">
                    <div class="custom-btn show-auth-num">
                        <i class="fa fa-phone"></i>
                        اضغط لترى رقم البائع
                        <span>{{$ad->user['phone']}}</span>
                    </div>
                    <a class="custom-btn scroll-to send-auth-sms" href="#send-message">
                        ارسل رسالة
                    </a>
                    <button class="custom-btn WishlistBTN" data-token="{!! csrf_token() !!}" data-url="{{route('site.wishlist')}}" data-id="{{$ad->id}}">
                        <i class="fa fa-heart-o"></i>
                        <span class="button-text">
                            @if(auth()->guard('members')->check() && sizeof(\App\Wishlist::where('ad_id', $ad->id)->where('member_id' ,auth()->guard('members')->user()->id)->value('id')) > 0)
                                حذف من المفضله
                            @else
                                اضافه للمفضله
                            @endif
                        </span>
                    </button>
                    <button class="custom-btn" data-toggle="modal" data-target="#reportAds">
                        <i class="fa fa-exclamation-triangle"></i>
                        ابلغ عن الاعلان
                    </button>
                    <div class="custom-btn">
                        <a href="#reviews" class="scroll-to">اضف تعليف</a>
                        <ul class="rating">
                            @for($i = 1 ; $i <= 5 ;$i++)
                                @if($i < $totalReview)
                                    <li class="active"></li>
                                @else
                                    <li></li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                </div><!--End ad-more-->
                <div class="box-item pro-detail-content">
                    <div class="col-md-7 pro-gallery">
                        <ul class="slides">
                            @foreach($ad->images as $image)
                                <li data-thumb="{{asset('storage/uploads/banners/'.$image->image)}}">
                                    <img src="{{asset('storage/uploads/banners/'.$image->image)}}" alt="Car">
                                </li>
                            @endforeach
                        </ul>
                    </div><!--End col-md-7-->
                    <div class="col-md-5 ad-detail-info-wrap pro-detail-info">
                        <div class="pro-price">
                            {{$ad->price}} ر.س
                        </div><!--End ad-detail-price-->
                        <h3 class="pro-name">
                            {{$ad->name}}
                        </h3><!--End ad-detail-name-->
                        <div class="pro-auth-info">
                            <div>
                                <span>بواسطة:</span>
                                <span>
                                    <a href="{{route('site.profile.public',['username'=>$ad->user['username']])}}">{{$ad->user['username']}}</a>
                                </span>
                            </div>
                            <div>
                                <span>العنوان:</span>
                                @foreach($ad->places as $place)
                                    <span>{{$place->name}} - </span>
                                @endforeach
                            </div>
                            <div class="auth-status">
                                <span>
                                    الحالة:
                                </span>
                                <span>متصل</span>
                            </div>
                        </div><!--End pro-auth-info-->
                        <div class="pro-detail-feat">
                            <h3 class="title title-sm">تفاصيل اكتر عن الاعلان</h3>
                            <ul class="feature-list">
                                <li>
                                    <span>حالة المنتج</span>
                                    <span>
                                        @if($ad->used == 1)
                                            جديد
                                            @else
                                        مستعمل
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span>تاريخ الاعلان</span>
                                    <span>{{ar_date($ad->created_at->timestamp)}}</span>
                                </li>
                                <li>
                                    <span>عدد مشاهدات الاعلان</span>
                                    <span>{{$ad->visits}}</span>
                                </li>
                                <li>
                                    <span>الموديل</span>
                                    <span>{{$ad->type['name']}}</span>
                                </li>
                            </ul><!--End feature-list-->
                        </div><!--End pro-detail-feat-->
                        <div class="pro-share">
                            <h3 class="title title-sm">مشاركة الاعلان</h3>
                            <ul class="social-share a2a_kit a2a_kit_size_32 a2a_default_style">
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                                <li>
                                    <a class="a2a_button_facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="a2a_button_twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="a2a_button_google_plus">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="a2a_dd" href="https://www.addtoany.com/share">
                                        <i class="fa fa-plus-square"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!--End pro-share-->
                    </div><!--End col-md-6-->
                </div><!--End box-item-->
                <div class="row">
                    <div class="col-md-8">
                        <div class="box-item pro-detail-desc">
                            <h3 class="title title-sm">وصف المنتج</h3>
                            {!! $ad->description !!}
                        </div><!--End ad-detail-desc-->
                        <div class="user-community">
                            <div class="box-item no-padding">
                                <ul class="box-item-head nav nav-tabs style-2" role="tablist">
                                    <li class="active">
                                        <a href="#pro-rate" role="tab" data-toggle="tab">تقييم الاعلان</a>
                                    </li>
                                    <li>
                                        <a href="#pro-discuss" role="tab" data-toggle="tab">مناقشات الزوار</a>
                                    </li>
                                </ul>
                            </div><!--End box-item-head-->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="pro-rate">
                                    <div class="box-item no-padding">
                                        <div class="user-reviews" id="user_reviews">
                                            @include('site.pages.ads.templates.review' ,compact('reviews'))
                                        </div>
                                        <div class="box-item-foot">
                                            @if(sizeof($reviews) > 0)
                                                {{$reviews->links()}}
                                            @endif
                                        </div><!--End box-item-foot-->
                                    </div><!--End box-item-->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="box-item no-padding" id="reviews">
                                                <div class="box-item-head no-margin">
                                                    <h3 class="title title-sm">
                                                        اكتب تعليق
                                                    </h3>
                                                </div><!--End box-item-head-->
                                                <div class="box-item-body">
                                                    <form class="review-form" id="reviews-form" action="{{route('site.review',['slug' => $ad->slug])}}" method="POST">
                                                        {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <div class="rateit" id="rateitval" data-rateit-mode="font" data-rateit-icon="" style="font-family:fontawesome">
                                                                <input type="hidden" name="rate" id="rateInput">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" placeholder="اكتب تعليقك" rows="8"></textarea>
                                                        </div><!--End review-form-->
                                                        <button class="custom-btn btn-block" type="submit">
                                                            ارسال
                                                        </button>
                                                    </form><!--End review-form-->
                                                </div><!--End box-item-body-->
                                            </div><!--End box-item-->
                                        </div><!--End col-md-7-->
                                    </div><!--End row-->

                                </div><!--End tabpanel-->
                                <div role="tabpanel" class="tab-pane fade" id="pro-discuss">
                                    <div class="box-item no-padding">
                                        <div class="user-reviews" id="user_discussion">
                                            @include('site.pages.ads.templates.discussion' ,compact('$allConversations'))
                                        </div><!--End user-reviews-->
                                        <div class="box-item-foot">
                                        @if(sizeof($allConversations) > 1)
                                            {{$allConversations->links()}}
                                        @endif
                                        </div><!--End box-item-foot-->
                                    </div><!--End box-item-->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="box-item no-padding" id="reviews">
                                                <div class="box-item-head no-margin">
                                                    <h3 class="title title-sm">
                                                        اكتب تعليق
                                                    </h3>
                                                </div><!--End box-item-head-->
                                                <div class="box-item-body">
                                                    <form class="review-form" id="conversation-form" action="{{route('site.conversation',['slug'=>$ad->slug])}}" method="post">
                                                        {!! csrf_field() !!}

                                                        <div class="form-group">
                                                            <textarea class="form-control" name="content" placeholder="اكتب رايك" rows="8"></textarea>
                                                        </div><!--End review-form-->
                                                        <button class="custom-btn btn-block" type="submit">
                                                            ارسال
                                                        </button>
                                                    </form><!--End review-form-->
                                                </div><!--End box-item-body-->
                                            </div><!--End box-item-->
                                        </div><!--End col-md-7-->
                                    </div><!--End row-->

                                </div><!--End tabpanel-->
                            </div><!--End tab-content-->
                        </div><!--End user-community-->
                    </div><!--End col-md-8-->

                    <div class="col-md-4">
                        <div class="box-item no-padding" id="send-message">
                            <div class="box-item-head no-margin">
                                <h3 class="title title-sm">تواصل مع البائع </h3>
                            </div><!--End box-item-head-->
                            <div class="box-item-body">
                                <form class="contact-seller" action="{{route('site.message',['slug'=>\Request::route()->slug])}}" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="الرسالة" name="message" rows="7"></textarea>
                                    </div><!--End form-group-->
                                    <button class="custom-btn btn-block" type="submit">ارسال</button>
                                </form>
                            </div><!--End box-item-body-->
                        </div><!--End contact-seller-->
                        <div class="box-item no-padding">
                            <div class="box-item-head">
                                <h3 class="title title-sm">اعلانات ذات صلة</h3>
                            </div><!--End box-item-head-->
                            <div class="box-item-body no-padding">
                                @foreach($ads as $sindleAd)
                                    @if($sindleAd->id != $ad->id)
                                        <div class="pro-item pro-item-list item-list-sm">
                                            <div class="pro-item-head">
                                                <div class="pro-item-img">
                                                    <img src="{{asset('storage/uploads/banners/'.$sindleAd->images[0]->image)}}">
                                                </div><!--End pro-item-itmg-->
                                            </div><!-- End pro-item-head -->
                                            <div class="pro-item-content">
                                                <div class="title-price">
                                                    <a href="{{route('site.ad.only',['slug'=>$sindleAd->slug])}}" class="title title-sm">{{$sindleAd->name}}</a>
                                                </div><!-- End Title-Price -->
                                                <ul class="breadcrumb">
                                                    <li><a href="{{route('site.category',['slug' => $sindleAd->MainCategory()->slug])}}">{{$sindleAd->MainCategory()->name}}</a></li>
                                                    <li class="active">{{$sindleAd->type['name']}}</li>
                                                </ul>
                                                <div class="pro-item--map-date">
                                                    <div class="pro-item--map">
                                                        <i class="fa fa-map-marker"></i>
                                                        @foreach($sindleAd->places as $place)
                                                            {{$place->name}} -
                                                        @endforeach
                                                    </div><!--End pro-item--map-->
                                                    <div class="pro-item--date">
                                                        <i class="fa fa-clock-o"></i>
                                                        {{ar_date($sindleAd->created_at->timestamp)}}
                                                    </div><!--End pro-item--date-->
                                                </div><!--End map-date-->
                                            </div><!-- End pro-item-Content -->
                                        </div><!-- End pro-item -->
                                    @endif
                                @endforeach
                            </div><!--End box-item-body-->
                        </div><!--End box-item-->
                        <div class="box-item no-padding">
                            <div class="box-item-head no-margin">
                                <h3 class="title title-sm">كلمات دلالية</h3>
                            </div><!--End box-item-head-->
                            <div class="box-item-body">
                                <ul class="tags">
                                    @foreach(explode("," , $ad->keywords) as $tag)
                                    <li>
                                        <a href="{{route('site.ad.tag' ,['tag' => $tag])}}">
                                            {{$tag}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div><!--End box-item-body-->
                        </div><!--End box-item-->
                    </div><!--End col-md-4-->

                </div><!--End row-->
            </div><!-- End Container -->
        </section><!-- End section-md -->
    </div><!--End page-content-->
    <div class="modal fade" id="reportAds" tabindex="-1" role="dialog" aria-labelledby="reportAds">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form reportForm" method="post" action="{{route('site.report',['slug' => $ad->slug])}}">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">الإبلاغ عن الإعلان</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="check-radio-item">
                                <input type="radio" class="form-control" value="هذا الإعلان غير حقيقى" name="report_type" id="1">
                                <label for="1">هذا الإعلان غير حقيقى</label>
                            </div><!--End check-radio-item-->
                            <div class="check-radio-item">
                                <input type="radio" class="form-control" value="هذا الإعلان فى الفئة الخاطئة" name="report_type" id="2">
                                <label for="2">هذا الإعلان فى الفئة الخاطئة</label>
                            </div><!--End check-radio-item-->
                            <div class="check-radio-item">
                                <input type="radio" class="form-control" value="هذا الإعلان يعرض سلعة ممنوعة من البيع" name="report_type" id="3">
                                <label for="3">هذا الإعلان يعرض سلعة ممنوعة من البيع</label>
                            </div><!--End check-radio-item-->
                            <div class="check-radio-item">
                                <input type="radio" class="form-control" value="هذا الإعلان منتهى الصلاحية" name="report_type" id="4">
                                <label for="4">هذا الإعلان منتهى الصلاحية</label>
                            </div><!--End check-radio-item-->
                        </div><!--End Form-group-->
                        <div class="form-group hidden">
                            <label>أخبرنا لماذا تريد الإبلاغ عن هذا الإعلان</label>
                            <textarea class="form-control" name="report" placeholder="الرجاء تزويدنا بالمزيد من التفاصيل التي قد تساعدنا عند التحقق من البلاغ المقدّم. إذا أردت معرفة نتيجة التحقق، الرجاء إضافة إيميلك>"></textarea>
                        </div><!--End Form-group-->
                    </div><!--End modal-body-->
                    <div class="modal-footer">
                        <button type="submit" class="custom-btn pull-right">حفظ التغييرات</button>
                    </div>
                </form><!--End Form-->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
