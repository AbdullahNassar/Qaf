@extends('site.layouts.master')
@section('title')
    تعديل اعلان
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">تعديل الاعلان</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">تعديل الاعلان</li>
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
                                <li><a href="#enter-listings">تفاصيل الاعلان</a></li>
                                <li><a href="#add-photo">اضف صور</a></li>
                                <li><a href="#auther-contact">معلومات الاتصال</a></li>
                            </ul><!--End add-process-nav-->
                        </div><!--End add-process-->
                    </div><!--End col-md-4-->
                    <div class="col-md-9">
                        <form id="title-form" class="add-ad-form"  novalidate method="POST" action="{{route('site.ad.update')}}" onsubmit="return false" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$ad->id}}" />
                            <div id="enter-listings" class="box-item padding-20">
                                <h3 class="title">
                                    تفاصيل الاعلان
                                </h3>
                                <div class="form-group">
                                    <input type="text" disabled name="type_id" value="{{$ad->type->name}}" class="form-control" >
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <input type="text" name="name" value="{{$ad->name}}" class="form-control" placeholder="اسم الاعلان">
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <textarea class="form-control" name="description" placeholder="تفاصيل الاعلان" rows="6">{{$ad->description}}</textarea>
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <input id="tags_1" type="text" value="{{$ad->keywords}}"  name="keywords" class="tags form-control" placeholder="Tags" required />
                                </div><!--End form-group-->
                                <div class="option-show">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{$ad->price}}" name="price" placeholder="أضف السعر" required />
                                    </div><!--End form-group-->
                                    <div class="form-group">
                                        <label class="label-block">حالة المنتج</label>
                                        <div class="check-radio-item inline">
                                            <input type="radio" class="form-control" @if($ad->used == 1) checked @endif name="used" value="1" id="new">
                                            <label for="new">جديد</label>
                                        </div><!--End Check-radio-item-->
                                        <div class="check-radio-item inline">
                                            <input type="radio" class="form-control" @if($ad->used == 0) checked @endif name="used" value="0" id="old">
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
                                        <div class="form-group">
                                            @foreach($ad->images as $image)
                                                <label class="col-md-3 control-label">الصورة الحالية</label>
                                                <div class="col-md-8 ajax-target">
                                                    <img class="img-responsive mr-bot-15 btn-product-image" alt="user-image" src="{{url('storage/uploads/banners/'.$image->image)}}" style="cursor:pointer; " title="choose image">
                                                    <input type="file" style="display:none;" name="image[{{$image->id}}}]">
                                                    <button type="button" data-url="{{route('site.ad.images.delete',['ad_id'=>$ad->id,'image_id'=>$image->id])}}" class="ajax-delete btn btn-warning">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div><!--End Form-group-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">أضف صورة جديدة</label>
                                            <div class="col-md-8 file-box">
                                                <img class="img-responsive mr-bot-15 btn-product-image"
                                                     style="height: 150px; display: block; cursor: pointer;" src="{{url('storage/uploads/profile/user-img.jpg')}}">
                                                <input type="file" role="button" name="image[]" accept="image/*" style="display:none;">
                                                <div class="caption text-center">
                                                    <button type="button" class="file-generate btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--End Add-photo-->
                            <div id="auther-contact" class="box-item padding-20">
                                <h3 class="title">
                                    معلومات الاتصال
                                </h3>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{auth()->guard('members')->user()->f_name .' '.auth()->guard('members')->user()->f_name}}" placeholder="محمود محمد عبد الغنى">
                                </div><!--End form-group-->
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{auth()->guard('members')->user()->phone}}" placeholder="01208971865">
                                </div><!--End form-group-->

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