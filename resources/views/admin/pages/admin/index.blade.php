@extends('admin.layouts.master')
@section('title')
ادخال مستخدمين  للوحه التحكم
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
                        <i class="fa fa-users"></i>اضافه مستخدم جديد</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <br />
                </div>

                <div class="portlet-body form">
                    <form  action="{{ route('admin.admins') }}" 
                           enctype="multipart/form-data" method="post"  onsubmit="return false;">
                        {!! csrf_field() !!}
                        <div class="form-body row">
                            <div class="row" style="margin-left: 50px;">
                                <div class="form-group col-sm-12 col-md-12 ">
                                    <label class="col-md-3 control-label">صوره المستخدم</label>
                                    <div class="col-md-9 col-sm-9 file-box">
                                        <img src="http://knowledge-commons.com/static/assets/images/avatar.png" class="img-responsive mr-bot-15 profile-user-img  file-btn "
                                             style="cursor:pointer; height: 150px; width: 150px;">
                                        <input type="file" style="display:none;" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">اسم المستخدم</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="name" placeholder="ادخل اسم المستخدم">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">الاسم الظاهر للعميل</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="username" placeholder="ادخل الاسم الظاهر للعميل">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">البريد الالكتروني</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="email" class="form-control " name="email" placeholder="ادخل البريد الالكتروني">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">العنوان</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="address" placeholder="ادخل العنوان">
                                </div>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="col-md-3 control-label">رقم الهاتف</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control " name="phone" placeholder="ادخل رقم الهاتف">
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
                                    <button type="submit" class="btn  green addBTN">حفظ 
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--End portlet-->
        </div> 
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users"></i>جميع المستخدمين </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-stypeed table-responsive">
                            <thead>
                                <tr>
                                    <th>الصوره</th>
                                    <th>الاسم</th>
                                    <th>الاسم الظاهر</th>
                                    <th>رقم الهاتف</th>
                                    <th>البريد الالكتروني</th>
                                    <th>العنوان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($admins as $user)
                                <tr>
                                    <td>
                                        <img src="{{url('storage/uploads/admins/' .$user->image)}}" style="width: 150px; height: 150px;">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>
                                        <a href="admins/edit/{{$user->id}}" class="btn btn-success " data-toggle="modal">
                                            <i class="fa fa-edit"></i> 
                                            تعديل
                                        </a>

                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $user->id }}"
                                                data-url="{{ route('admin.admins.delete' , ['id' => $user->id ]) }}" >
                                            <i class="fa fa-trash"></i>
                                            مسح
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection