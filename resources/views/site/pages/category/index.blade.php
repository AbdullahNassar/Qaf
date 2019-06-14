@extends('site.layouts.master')
@section('title')
    {{$category->name}}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">{{$category->name}}</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسيه</a></li>
                    <li class="active">{{$category->name}}</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md categories-page">
            <form action="{{$base_url}}">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box-item widget side-widget">
                            <div class="widget-title">
                                <i class="fa fa-search"></i>
                                <h3 class="title">البحث</h3>
                            </div><!--End widget-title-->
                            <div class="widget-content" id="FilterData">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="searchWord" name="search" placeholder="اكتب ما تبحث عنه">
                                </div><!-- End Form-Grop -->
                                <div class="form-group">
                                    <select class="ui-select-box " id="typeBox" name="type_id">
                                        <option disabled selected>اختار النوع</option>
                                        @php
                                            $subCategs = $category->subCategories
                                        @endphp
                                        @foreach($subCategs as $single)
                                            @foreach($single->types as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div><!--End Form-group-->
                                <div class="form-group">
                                    <input type="number" name="first_limit" class="form-control half-width first_limit" placeholder="السعر من">
                                    <input type="number" name="last_limit" class="form-control half-width to last_limit" placeholder="السعر الى">
                                </div><!--End Form-group-->
                                <div class="form-group">
                                    <div class="check-radio-item inline">
                                        <input type="radio" class="form-control" value="1" name="type" id="new">
                                        <label for="new">جديد</label>
                                    </div><!--End Check-radio-item-->
                                    <div class="check-radio-item inline">
                                        <input type="radio" class="form-control" value="0" name="type" id="old">
                                        <label for="old">مستعمل</label>
                                    </div><!--End Check-radio-item-->
                                </div><!--End Form-group-->
                            </div><!--End widget-content-->
                        </div><!--End widget-->
                        <div class="box-item widget side-widget">
                            <div class="widget-title">
                                <i class="fa fa-list-ul"></i>
                                <h3 class="title">جميع الأقسام</h3>
                            </div><!--End widget-title-->
                            <div class="widget-content">
                                <div class="accordion-container" id="all-cat">
                                    @foreach($allCategories as $singleCategory)
                                        @if($singleCategory->parent_id == 0)
                                            @if(sizeof($singleCategory->subCategories) > 0)
                                            <div class="panel">
                                                <a href="#cat{{$singleCategory->id}}" data-toggle="collapse" data-parent="#all-cat" class="collapsed">
                                                    {{$singleCategory->name}}
                                                    <span class="badge">({{count($singleCategory->subCategories)}})</span>
                                                </a>
                                                <div id="cat{{$singleCategory->id}}" class="panel-collapse collapse">
                                                    <ul class="cat-items">
                                                        @php
                                                            $sub = $singleCategory->subCategories
                                                        @endphp
                                                        @foreach($sub as $s)
                                                            <li>
                                                                <a href="{{route('site.category',['slug' => $s->slug])}}">
                                                                    {{$s->name}}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div><!--End panel-collapse-->
                                            </div><!--End Panel-->
                                            @else
                                                <div class="panel">
                                                    <a href="{{route('site.category',['slug' => $singleCategory->slug])}}" class="collapsed">
                                                        {{$singleCategory->name}}
                                                        <span class="badge">({{count($singleCategory->subCategories)}})</span>
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div><!--End toggle-container-->

                            </div><!--End widget-content-->
                        </div><!--End widget-->
                    </div><!-- End Col -->
                    <div class="col-md-9">
                        <div class="section-head has-border">
                            <h3 class="section-title">مضافةحديثاً</h3><!-- End Section-Title -->
                            <div class="toggle-items" data-container="#categories-wrap">
                                <a href="" data-layout="list_view">
                                    <i class="fa fa-th-list"></i>
                                </a>
                                <a href="" class="active" data-layout="grid_view">
                                    <i class="fa fa-th-large"></i>
                                </a>
                            </div><!--End toggle Items-->
                        </div>
                        <div id="categories-template">
                            @include('site.pages.category.templates.cat' ,compact('all'))
                        </div><!--End categories-wrap-->
                    </div><!-- End col-md-9-->
                </div><!-- End row -->
            </div><!-- End container -->
            </form>
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection