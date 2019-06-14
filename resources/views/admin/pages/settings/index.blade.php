@extends('admin.layouts.master')
@section('title')
بيانات الموقع
@endsection
@section('content')
<div class="page-content">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{route('admin.home')}}">الرئيسيه</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>بيانات الموقع</span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gears"></i>بيانات الموقع
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{route('admin.settings')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
                        {!! csrf_field() !!}

                        <div class="form-body row">
                            <div class="row" style="margin-left: 150px;">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> لوجو الموقع</label>
                                    <div class="col-md-9 col-sm-9 file-box">
                                        <img src="{{url('storage/uploads/logo/'.$settings->logo)}}" class="img-responsive mr-bot-15 profile-user-img  file-btn "
                                             style="cursor:pointer; height: 150px; width: 150px;">
                                        <input type="file" style="display:none;" name="logo">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> عنوان الموقع</label>
                                <div class="col-md-4 ">
                                    <input type="text" value="{{$settings->name}}" class="form-control " name="name" placeholder="عنوان الموقع">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> البريد الاكتروني</label>
                                <div class="col-md-4">
                                    <input type="email" value="{{$settings->email}}" class="form-control " name="email" placeholder="البريد الالكتروني">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label">رقم الهاتف</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->phone}}" class="form-control " name="phone" placeholder="هاتف الشركه">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> العنوان</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->address}}" class="form-control" name="address" placeholder="عنوان الشركه">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label"> وصف مصغر للموقع</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->description}}" class="form-control " name="description" placeholder="وصف الموقع">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label">رابط الفيسبوك</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->facebook}}" class="form-control " name="facebook" placeholder="رابط صفحه الموقع علي الفيسبوك">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label">رابط تويتر</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->twitter}}" class="form-control " name="twitter" placeholder="رابط صفحه الموقع علي تويتر">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label">رابط جوجل بلس</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->google}}" class="form-control " name="google" placeholder="رابط صفحه الموقع علي جوجل بلس">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label">رابط قناه يوتيوب</label>
                                <div class="col-md-4">
                                    <input type="text" value="{{$settings->youtube}}" class="form-control " name="youtube" placeholder="رابط القناه الخاصه بالموقع علي يوتيوب">
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit" class="btn  green btn-lg addBTN">
                                        <i class="fa fa-edit"></i>  تعديل</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div><!--End portlet-->
        </div>
    </div>
</div>
@endsection