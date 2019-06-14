@extends('site.layouts.master')
@section('title')
    جميع الاقسام
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">مجلات</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسيه</a></li>
                    <li class="active">مجلات</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md categories-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box-item widget side-widget">
                            <div class="widget-title">
                                <i class="fa fa-list-ul"></i>
                                <h3 class="title">جميع الأقسام</h3>
                            </div><!--End widget-title-->
                            <div class="widget-content no-padding">
                                <ul class="side-category nav nav-tabs">
                                    @foreach($allCategories as $index=>$category)
                                        @if($category->parent_id == 0)
                                            <li class="@if($index == 0){{'active'}}@endif">
                                                <a href="#{{$category->slug}}-tab" role="tab" data-toggle="tab">
                                                    <span class="fa {{$category->icon}}"></span>
                                                    {{$category->name}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul><!--End side-category-->
                            </div><!--End widget-content-->

                        </div><!--End widget-->
                    </div><!-- End col-md-3 -->
                    <div class="col-md-9 tab-content">
                        @foreach($allCategories as $index=>$category)
                            @if($category->parent_id == 0)
                                <div class="box-item widget side-widget tab-pane fade @if($index == 0){{'in active'}}@endif" role="tabpanel" id="{{$category->slug}}-tab">
                                    <div class="widget-title">
                                        <span class="fa {{$category->icon}}"></span>
                                        <h3 class="title">{{$category->name}}</h3>
                                    </div><!--End widget-title-->
                                    <div class="widget-content gray-bg">
                                        <div class="row">
                                            @foreach($category->subCategories as $subCategory)
                                                <div class="col-md-4">
                                                    <a href="{{route('site.category',['slug' => $subCategory->slug])}}">
                                                        <div class="icon-box box-block">
                                                            <div class="icon-box-head">
                                                                <span class="fa {{$subCategory->icon}}"></span>
                                                            </div><!-- End Icon-Box-Head -->
                                                            <div class="icon-box-content">
                                                                <h3 class="title">{{$subCategory->name}}</h3>
                                                                <span>({{count($subCategory->types)}})</span>
                                                            </div><!-- End Icon-Box-Content -->
                                                        </div><!-- End Icon-Box -->
                                                    </a>
                                                </div><!-- End col-md-4 -->
                                            @endforeach
                                        </div><!--End row-->
                                    </div><!--End widget-content-->
                                </div><!--End widget-->
                            @endif
                        @endforeach
                    </div><!-- End col-md-9 -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection