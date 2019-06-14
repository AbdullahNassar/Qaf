@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">اعلاناتى</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">اعلاناتى</li>
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
                        <div class="section-head has-border">
                            <h3 class="section-title">اعلاناتى</h3><!-- End Section-Title -->
                        </div>

                        <ul class="nav nav-tabs style-2" role="tablist">
                            <li role="presentation" class="active"><a href="#all" aria-                                                controls="all" role="tab" data-toggle="tab">جميع الأعلانات</a></li>
                            <li role="presentation"><a href="#active-ad" aria-controls="active-ad" role="tab" data-toggle="tab">اعلانات مفعلة</a></li>
                            <li role="presentation"><a href="#under-review" aria-controls="under-review" role="tab" data-toggle="tab">اعلانات قيد المراجعة</a></li>
                            <li role="presentation"><a href="#rejected" aria-controls="rejected" role="tab" data-toggle="tab">اعلانات مرفوضة</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active descript" id="all">
                                @foreach($ads as $ad)
                                <div class="pro-item pro-item-list">
                                    <div class="pro-item-head">
                                        <div class="pro-item-img">
                                            <img src="{{url('storage/uploads/banners/'.$ad->images[0]->image)}}">
                                        </div><!--End pro-item-itmg-->
                                        <div class="verified" data-toggle="tooltip" data-placement="left" title="" data-original-title="موثوق">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                    </div><!-- End pro-item-head -->
                                    <div class="pro-item-content">
                                        <div class="title-price">
                                            <h3 class="title">{{$ad->name}}</h3>
                                            <span class="price">{{$ad->price}} ر.س</span>
                                        </div><!-- End Title-Price -->
                                        <ul class="breadcrumb">
                                            <li><a href="#">{{$ad->MainCategory()->name}}</a></li>
                                            <li class="active">{{$ad->type->name}}</li>
                                        </ul>
                                        <p class="content">{{ strip_tags(str_limit($ad->description,150))  }}</p>
                                        <div class="pro-item--map-date">
                                            <div class="pro-item--map">
                                                <i class="fa fa-map-marker"></i>
                                                @if(count($ad->places)>0)
                                                    {{$ad->places[0]->name}}
                                                @endif
                                            </div><!--End pro-item--map-->
                                            <div class="pro-item--date">
                                                <i class="fa fa-clock-o"></i>
                                                {{$ad->created_at->diffforhumans()}}
                                            </div><!--End pro-item--date-->
                                        </div><!--End map-date-->

                                        <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                                        <a href="{{route('site.ad.edit',['slug'=>$ad->slug])}}" class="see-more">تعديل الاعلان</a>
                                        <a href="{{route('site.ad.delete',['slug'=>$ad->slug])}}" class="see-more">حذف الاعلان</a>
                                    </div><!-- End pro-item-Content -->
                                </div><!-- End pro-item-List -->
                                @endforeach
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="active-ad">
                                @php
                                $activeAds = $ads->where('active',1);
                                @endphp
                                @foreach($activeAds as $activeAd)
                                <div class="pro-item pro-item-list">
                                    <div class="pro-item-head">
                                        <div class="pro-item-img">
                                            <img src="{{url('storage/uploads/banners/'.$activeAd->images[0]->image)}}">
                                        </div><!--End pro-item-itmg-->
                                        <div class="verified" data-toggle="tooltip" data-placement="left" title="" data-original-title="موثوق">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                    </div><!-- End pro-item-head -->
                                    <div class="pro-item-content">
                                        <div class="title-price">
                                            <h3 class="title">{{$ad->name}}</h3>
                                            <span class="price">{{$ad->price}} ر.س</span>
                                        </div><!-- End Title-Price -->
                                        <ul class="breadcrumb">
                                            <li><a href="#">{{$ad->MainCategory()->name}}</a></li>
                                            <li class="active">{{$ad->type->name}}</li>
                                        </ul>
                                        <p class="content">{{ strip_tags(str_limit($ad->description,150))  }}</p>
                                        <div class="pro-item--map-date">
                                            <div class="pro-item--map">
                                                <i class="fa fa-map-marker"></i>
                                                @if(count($ad->places)>0)
                                                    {{$ad->places[0]->name}}
                                                @endif
                                            </div><!--End pro-item--map-->
                                            <div class="pro-item--date">
                                                <i class="fa fa-clock-o"></i>
                                                {{$ad->created_at->diffforhumans()}}
                                            </div><!--End pro-item--date-->
                                        </div><!--End map-date-->
                                        <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                                    </div><!-- End pro-item-Content -->
                                </div><!-- End pro-item-List -->
                                @endforeach
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="under-review">
                                @php
                                    $reviewAds = $ads->where('active',0);
                                @endphp
                                @foreach($reviewAds as $activeAd)
                                    <div class="pro-item pro-item-list">
                                        <div class="pro-item-head">
                                            <div class="pro-item-img">
                                                <img src="{{url('storage/uploads/banners/'.$activeAd->images[0]->image)}}">
                                            </div><!--End pro-item-itmg-->
                                            <div class="verified" data-toggle="tooltip" data-placement="left" title="" data-original-title="موثوق">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                        </div><!-- End pro-item-head -->
                                        <div class="pro-item-content">
                                            <div class="title-price">
                                                <h3 class="title">{{$ad->name}}</h3>
                                                <span class="price">{{$ad->price}} ر.س</span>
                                            </div><!-- End Title-Price -->
                                            <ul class="breadcrumb">
                                                <li><a href="#">{{$ad->MainCategory()->name}}</a></li>
                                                <li class="active">{{$ad->type->name}}</li>
                                            </ul>
                                            <p class="content">{{ strip_tags(str_limit($ad->description,150))  }}</p>
                                            <div class="pro-item--map-date">
                                                <div class="pro-item--map">
                                                    <i class="fa fa-map-marker"></i>
                                                    @if(count($ad->places)>0)
                                                        {{$ad->places[0]->name}}
                                                    @endif
                                                </div><!--End pro-item--map-->
                                                <div class="pro-item--date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{$ad->created_at->diffforhumans()}}
                                                </div><!--End pro-item--date-->
                                            </div><!--End map-date-->
                                            <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                                        </div><!-- End pro-item-Content -->
                                    </div><!-- End pro-item-List -->
                                @endforeach
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="rejected">
                                @php
                                    $rejectedAds = $ads->where('active',-1);
                                @endphp
                                @foreach($rejectedAds as $activeAd)
                                    <div class="pro-item pro-item-list">
                                        <div class="pro-item-head">
                                            <div class="pro-item-img">
                                                <img src="{{url('storage/uploads/banners/'.$activeAd->images[0]->image)}}">
                                            </div><!--End pro-item-itmg-->
                                            <div class="verified" data-toggle="tooltip" data-placement="left" title="" data-original-title="موثوق">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                        </div><!-- End pro-item-head -->
                                        <div class="pro-item-content">
                                            <div class="title-price">
                                                <h3 class="title">{{$ad->name}}</h3>
                                                <span class="price">{{$ad->price}} ر.س</span>
                                            </div><!-- End Title-Price -->
                                            <ul class="breadcrumb">
                                                <li><a href="#">{{$ad->MainCategory()->name}}</a></li>
                                                <li class="active">{{$ad->type->name}}</li>
                                            </ul>
                                            <p class="content">{{ strip_tags(str_limit($ad->description,150))  }}</p>
                                            <div class="pro-item--map-date">
                                                <div class="pro-item--map">
                                                    <i class="fa fa-map-marker"></i>
                                                    @if(count($ad->places)>0)
                                                        {{$ad->places[0]->name}}
                                                    @endif
                                                </div><!--End pro-item--map-->
                                                <div class="pro-item--date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{$ad->created_at->diffforhumans()}}
                                                </div><!--End pro-item--date-->
                                            </div><!--End map-date-->
                                            <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="see-more">مشاهدة الاعلان</a>
                                        </div><!-- End pro-item-Content -->
                                    </div><!-- End pro-item-List -->
                                @endforeach
                            </div>

                        </div>

                    </div><!-- End col-md-9 -->

                </div><!--End row-->
            </div><!--End container-->
        </section><!--End dashbord-->
    </div><!--End page-content-->
@endsection