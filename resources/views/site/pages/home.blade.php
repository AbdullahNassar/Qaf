@extends('site.layouts.master')
@section('title')
    الصفحه الرئيسيه
@endsection
@section('content')
    <div class="home-slider">
        <div class="home-slider-img">
            <img src="{{asset('assets/site/images/home-slider.jpg')}}">
        </div><!-- End home-slider-Img -->
        <div class="container section-lg">
            <div class="row">
                <div class="col-md-9">
                    <div class="search-box">
                        <ul class="search-tabs" id="mobile-home-search">
                            @foreach($allCategories as $index=>$category)
                                @if($category->parent_id == 0)
                                    <li class="@if($index == 0){{'active'}}@endif">
                                        <a href="#{{$category->slug}}" data-toggle="tab">
                                            <span class="fa {{$category->icon}}"></span>
                                            {{$category->name}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="search-tab-content">
                            @foreach($allCategories as $index=>$category)
                                @if($category->parent_id == 0)
                                    @if(sizeof($category->subCategories) > 0)
                                    <div class="tab-pane fade @if($index == 0) {{'in active'}} @endif" id="{{$category->slug}}">
                                        <h3 class="title title-lg">
                                            <span class="fa {{$category->icon}}"></span>
                                            ابحث عن {{$category->name}} فى موقعنا
                                        </h3>
                                        <form action="{{route('site.search')}}">
                                            <div class="col-md-6 form-group">
                                                <select class="search-select-box" name="category_id">
                                                    <option disabled selected>
                                                        اختر فئة
                                                    </option>
                                                    @foreach($category->subCategories as $subCat)
                                                        <option value="{{$subCat->id}}">{{$subCat->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <select class="search-select-box" name="type_id">
                                                    <option disabled selected>
                                                        الماركة
                                                    </option>
                                                    @foreach($category->subCategories as $subCat)
                                                        @foreach($subCat->types as $type)
                                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <select class="search-select-box" name="used">
                                                    <option disabled selected>
                                                        الحالة
                                                    </option>
                                                    <option value="1">جديد</option>
                                                    <option value="0">مستعمل</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <select class="search-select-box" name="city_id">
                                                    <option disabled selected>
                                                        المنطقة / المدينة
                                                    </option>
                                                    @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input class="form-control" name="min" type="text" placeholder="السعر من">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input class="form-control" name="max" type="text" placeholder="السعر الى">
                                            </div>
                                            <div class="col-md-12">
                                                <button class="custom-btn btn-block">ابحث</button>
                                            </div>
                                        </form>
                                    </div><!--End tab-pane-->
                                    @else
                                    <div class="tab-pane fade @if($index == 0) {{'in active'}} @endif" id="{{$category->slug}}">
                                        <h3 class="title title-lg">
                                            <span class="fa {{$category->icon}}"></span>
                                            ابحث عن {{$category->name}} في موقعنا
                                        </h3>
                                        <form action="{{route('site.search')}}">
                                            <div class="col-md-12 form-group">
                                                <input class="form-control" name="search" type="text" placeholder="ابحث عن!">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <select class="search-select-box" name="city_id">
                                                    <option disabled selected>
                                                        المنطقة / المدينة
                                                    </option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input class="form-control" name="min" type="text" placeholder="السعر من">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input class="form-control" name="max" type="text" placeholder="السعر الى">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <button class="custom-btn btn-block">ابحث</button>
                                            </div>
                                        </form>
                                    </div><!--End tab-pane-->
                                    @endif
                                @endif
                            @endforeach
                        </div><!--End search-tab-content-->
                    </div><!--End search-box-->
                </div><!--End col-md-9-->
                <div class="col-md-3">
                    <div class="create-ads-box">
                        <h3 class="title">انشئ اعلانك مجانا</h3>
                        <p>
                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي
                        </p>
                        <a href="{{route('site.add.add')}}" class="custom-btn">
                            انشئ اعلانك الان
                        </a>
                    </div><!--End crebanners-ads-box-->
                </div><!--End col-md-9-->
            </div><!--End row-->
        </div><!-- End container -->
    </div><!--End home-slider-->
    <div class="page-content">
        <section class="category">
            <div class="container">
                <div class="row">
                    @foreach($allCategories as $category)
                        @if($category->parent_id == 0)
                            <div class="col-md-3">
                                <a href="{{route('site.category',['slug'=>$category->slug])}}">
                                    <div class="icon-box">
                                        <div class="icon-box-head">
                                            <span class="fa {{$category->icon}}"></span>
                                        </div><!-- End Icon-Box-Head -->
                                        <div class="icon-box-content">
                                            <h3 class="title">{{$category->name}}</h3>
                                        </div><!-- End Icon-Box-Content -->
                                    </div><!-- End Icon-Box -->
                                </a>
                            </div><!-- End col -->
                        @endif
                    @endforeach
                    <div class="col-md-3">
                        <a href="{{route('site.category',['slug'=>'all'])}}">
                            <div class="icon-box">
                                <div class="icon-box-head">
                                    <span class="icon-Gaming"></span>
                                </div><!-- End Icon-Box-Head -->
                                <div class="icon-box-content">
                                    <h3 class="title">كل الاقسام</h3>
                                </div><!-- End Icon-Box-Content -->
                            </div><!-- End Icon-Box -->
                        </a>
                    </div><!-- End col -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
        <section class="section-md">
            <div class="container">
                <div class="section-head has-border">
                    <h3 class="section-title">اعلانات مميزة</h3><!-- End Section-Title -->
                    <a href="#" class="more-items">المزيد +</a>
                </div>
                <div class="row">
                    @foreach($ads as $ad)
                        @if($ad->user->package_id !=0)
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
                        </div><!--End col-md-3-->
                        @endif
                    @endforeach
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Section -->
    </div><!--End page-content-->
@endsection