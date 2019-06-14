@extends('admin.layouts.master')
@section('title')
    تعديل عن الموقع  لوحه التحكم
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
                    <span>عن الموقع</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i>تعديل عن الموقع </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                        <br />
                    </div>

                    <div class="portlet-body form">
                        <form  action="{{route('admin.about.update')}}"
                               enctype="multipart/form-data" method="post"  onsubmit="return false;">
                            {!! csrf_field() !!}
                            <input type="hidden" name="flug" value="{{$about->flug}}" />
                            <div class="form-body row">
                                @if($about->image !=null)
                                    <div class="row" style="margin-left: 50px;">
                                        <div class="form-group col-sm-12 col-md-12 ">
                                        <label class="col-md-3 control-label">صوره القسم </label>
                                        <div class="col-md-9 col-sm-9 file-box">
                                        <img src="{{url('storage/uploads/about/'.$about->image)}}" class="img-responsive mr-bot-15 profile-user-img  file-btn "
                                        style="cursor:pointer; height: 150px; width: 150px;">
                                        <input type="file" style="display:none;" name="image">
                                        </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group col-sm-9 col-md-9">
                                    <label class="col-md-3 control-label">محتوى القسم</label>
                                    <div class="col-md-12 col-sm-6">
                                        <textarea class="form-control tiny-editor">
                                            {{$about->content}}
                                        </textarea>
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
