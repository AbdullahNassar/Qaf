@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">باقاتى</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">باقاتى</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-lg">
            <div class="container">
                <div class="beckages">
                    <div class="beckages-head">
                        <div class="beckages-head-item">اختر الباقة</div>
                        <div class="beckages-head-item">مميزاتها</div>
                        <div class="beckages-head-item">اسعارها</div>
                    </div><!--End beckages-head-->
                    <div class="beckages-body">
                        @foreach($packages as $package)
                        <div class="beckages-body-cell  {{$package->style}}">
                            <div class="beckages-body-header">
                                <div class="beckages-title">{{$package->name}}</div>
                                <div class="beckages-subtitle">{{$package->type}}</div>
                            </div>
                            <div class="beckages-body-content grey-bg">
                                <div class="beckages-feat">
                                    @foreach(explode(',',$package->features) as $feat)
                                        <div class="beckages-feat-item">{{$feat}}</div>
                                        @if(($loop->index+1)%3 == 0)
                                </div>
                                            <div class="beckages-feat">
                                        @endif
                                    @endforeach
                                </div>
                            </div><!--End beckages-body-content-->
                            <div class="beckages-body-footer">
                                <div class="beckages-price">{{$package->price}}</div>
                                <button data-url="{{route('site.profile.order-package',['id'=>$package->id])}}" class="beckages-order package-order">اطلب</button>
                            </div><!--End beckages-body-content-->
                        </div><!--End beckages-body-cell-->
                        @endforeach
                    </div><!--End beckages-body-->

                </div><!--End beckages-->

            </div><!--End container-->

        </section>

    </div><!--End page-content-->
@endsection