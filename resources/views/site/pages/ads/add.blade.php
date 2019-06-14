@extends('site.layouts.master')
@section('title')
    اضافه اعلان جديد
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">اضف اعلان</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">اضف اعلان</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box-item add-process" id="add-process"  data-spy="affix">
                            <h3 class="title">خطوات اضافة اعلان</h3>
                            <ul class="nav add-process-nav">
                                <li><a href="#choose-cat">اختر القسم</a></li>
                                <li><a href="#enter-listings">تفاصيل الاعلان</a></li>
                                <li><a href="#add-photo">اضف صور</a></li>
                                <li><a href="#auther-contact">معلومات الاتصال</a></li>
                            </ul><!--End add-process-nav-->
                        </div><!--End add-process-->
                    </div><!--End col-md-4-->
                    <div class="col-md-9">
                        <form id="title-form" class="add-ad-form"  novalidate method="POST" action="{{route('site.add.add')}}" onsubmit="return false" enctype="multipart/form-data">
                            <div id="choose-cat" class="box-item padding-20">
                                <h3 class="title">
                                    اختر القسم
                                </h3>
                                <div class="form-group col-md-12">
                                    <select class="ui-select-box choose-cats" data-type="cat">
                                        <option disabled selected>
                                            اختر القسم
                                        </option>
                                        @foreach($main_cats as $main_cat)
                                        <option value="{{$main_cat->id}}">{{$main_cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!--End form-group-->
                                <div class="select-category">

                                </div>
                                <div class="select-category-type">

                                </div>

                            </div><!--End enter-listings-->
                            <div id="enter-listings" class="box-item padding-20">
                                <h3 class="title">
                                    تفاصيل الاعلان
                                </h3>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="اسم الاعلان">
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="تفاصيل الاعلان" rows="6"></textarea>
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <input id="tags_1" type="text" name="keywords" class="tags form-control" placeholder="Tags" required />
                                </div><!--End form-group-->
                                <div class="form-group col-md-12">
                                    <select class="bs-select form-control" multiple dir="rtl"  name="cities[]" data-none-Selected-Text="أختر من القائمة">
                                        @foreach($cities as  $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="option-show hidden">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="price" placeholder="أضف السعر" required />
                                    </div><!--End form-group-->
                                    <div class="form-group">
                                        <label class="label-block">حالة المنتج</label>
                                        <div class="check-radio-item inline">
                                            <input type="radio" class="form-control" name="used" value="1" id="new">
                                            <label for="new">جديد</label>
                                        </div><!--End Check-radio-item-->
                                        <div class="check-radio-item inline">
                                            <input type="radio" class="form-control" name="used" value="0" id="old">
                                            <label for="old">مستعمل</label>
                                        </div><!--End Check-radio-item-->
                                    </div><!--End form-group-->
                                </div>

                            </div><!--End enter-listings-->
                            <div id="add-photo" class="box-item padding-20">
                                <h3 class="title">
                                    أضف صور
                                </h3>
                                <div class="upload-image">
                                    <div runat="server">
                                        <div class="dropzone" id="mydropzone">

                                        </div>
                                        <div id="dropzone_image"></div>
                                        <input type="hidden" value="{{csrf_token()}}" id="form-token" />
                                    </div>
                                </div>
                            </div><!--End Add-photo-->
                            <div id="auther-contact" class="box-item padding-20">
                                <h3 class="title">
                                    معلومات الاتصال
                                </h3>
                                @if(auth()->guard('members')->check())
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{auth()->guard('members')->user()->f_name .' '.auth()->guard('members')->user()->f_name}}" placeholder="محمود محمد عبد الغنى">
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{auth()->guard('members')->user()->phone}}" placeholder="01208971865">
                                </div><!--End form-group-->
                                @endif

                            </div><!--End auther-contact-->

                            <button class="custom-btn btn-block">
                                انشئ اعلان
                            </button>
                        </form><!-- End Form -->
                    </div><!--End col-md-10-->
                </div><!--End row-->
            </div><!-- End container -->
        </section><!-- End-->
    </div><!--End page-content-->
@endsection