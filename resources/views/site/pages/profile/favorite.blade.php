@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">مفضلتى</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">مفضلتى</li>
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
                            <h3 class="section-title">مفضلتى</h3><!-- End Section-Title -->
                        </div>
                        <div class="block-content">
                            @if(sizeof($wishlists) > 0)
                            @foreach($wishlists as $wishlist)
                                @php
                                    $ad = $wishlist->ad;
                                @endphp
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
                                    <p class="content"> {{ strip_tags(str_limit($ad->description,150))  }}  </p>
                                    <div class="pro-item--map-date">
                                        <div class="pro-item--map">
                                            <i class="fa fa-map-marker"></i>
                                            @if(sizeof($ad->places) > 0)
                                                {{$ad->places[0]->name}}
                                            @endif
                                        </div><!--End pro-item--map-->
                                        <div class="pro-item--date">
                                            <i class="fa fa-clock-o"></i>
                                            {{$ad->created_at->diffforhumans()}}
                                        </div><!--End pro-item--date-->
                                    </div><!--End map-date-->

                                    <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="custom-btn">مشاهدة الاعلان</a>
                                    <a data-url="{{route('site.wishlist.delete',['id'=>$ad->id])}}" data-token="{{csrf_token()}}" class="custom-btn wishlistDeleteBTN">حذف من المفضلة</a>
                                </div><!-- End pro-item-Content -->
                            </div><!-- End pro-item -->
                            @endforeach
                                @else
                            <div class="alert alert-danger text-center">
                                <h3>لا توجد اعلانات حتي الان</h3>
                            </div>
                            @endif
                        </div><!--End block-content-->
                        @if(sizeof($wishlists) > 0)
                        {{$wishlists->render()}}
                        @endif
                    </div><!-- End col-md-9 -->


                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection