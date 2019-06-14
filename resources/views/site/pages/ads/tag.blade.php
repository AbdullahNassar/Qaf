@extends('site.layouts.master')
@section('title')
    {{\Request::route()->tag}}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">{{\Request::route()->tag}}</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسيه</a></li>
                    <li class="active">{{\Request::route()->tag}}</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md categories-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-head has-border">
                            <h3 class="section-title">نتائج البحث</h3><!-- End Section-Title -->
                            <div class="toggle-items" data-container="#categories-wrap">
                                <a href="" data-layout="list_view">
                                    <i class="fa fa-th-list"></i>
                                </a>
                                <a href="" class="active" data-layout="grid_view">
                                    <i class="fa fa-th-large"></i>
                                </a>
                            </div><!--End toggle Items-->
                        </div>
                        <div id="categories-wrap" class="table-layout">
                            <div class="row">
                                @if(sizeof($ads) > 0)
                                    @foreach($ads as $ad)
                                        <div class="col-md-3">
                                            <div class="pro-item">
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
                                                        <li><a href="{{route('site.category',['slug' => $ad->MainCategory()->slug])}}">{{$ad->MainCategory()->name}}</a></li>
                                                        <li class="active">{{$ad->type['name']}}</li>
                                                    </ul>
                                                    <p>
                                                        {!! $ad->description !!}
                                                    </p>
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
                                        </div><!--End col-md-4-->
                                    @endforeach
                                    @else
                                    <div class="alert alert-block" role="alert">
                                        <p>لاتوجد نتائج تناسب هذا البحث</p>
                                    </div>
                                @endif
                            </div><!--End row-->
                        </div><!--End categories-wrap-->
                        @if(sizeof($ads) > 0)
                            {{$ads->links()}}
                        @endif
                    </div><!-- End col-md-9-->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection