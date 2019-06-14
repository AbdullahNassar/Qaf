@extends('admin.layouts.master')
@section('title')
تعديل مستخدمين  لوحه التحكم
@endsection
@section('content')
<div class="page-content">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('/')}}">الرئيسيه</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>المستخدمين</span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users"></i>تعديل مستخدم </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <br />
                </div>

                <div class="portlet-body form">
                    <form  action="{{ route('admin.admins.edit',['id'=>$admin->id]) }}" 
                           enctype="multipart/form-data" method="post"  onsubmit="return false;">
                        {!! csrf_field() !!}
                        <div class="form-body row">
                            <div class="row" style="margin-left: 50px;">
                                <div class="form-group col-sm-12 col-md-12 ">
                                    <label class="col-md-3 control-label">صوره المستخدم</label>
                                    <div class="col-md-9 col-sm-9 file-box">
                                        <img src="{{url('storage/uploads/admins/'.$admin->image)}}" class="img-responsive mr-bot-15 profile-user-img  file-btn "
                                             style="cursor:pointer; height: 150px; width: 150px;">
                                        <input type="file" style="display:none;" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">اسم المستخدم</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="name" value="{{$admin->name}}" placeholder="ادخل اسم المستخدم">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">الاسم الظاهر للعميل</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="username" value="{{$admin->username}}" placeholder="ادخل الاسم الظاهر للعميل">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">البريد الالكتروني</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="email" class="form-control " name="email" value="{{$admin->email}}" placeholder="ادخل البريد الالكتروني">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">العنوان</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="address" value="{{$admin->address}}" placeholder="ادخل العنوان">
                                </div>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">رقم الهاتف</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="phone" value="{{$admin->phone}}" placeholder="ادخل رقم الهاتف">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">الرقم السري</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="password" class="form-control " name="password" placeholder="ادخل الرقم السري">
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="text-center ">
                                    <a href="{{route('admin.admins')}}" class="btn btn-danger">
                                        <span class="fa fa-arrow-right"></span>
                                        عوده للخلف</a>
                                    <button type="submit" class="btn  green addBTN"><i class="fa fa-edit"></i>  تعديل</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--End portlet-->
        </div> 
    </div>
</div>   
@endsection
