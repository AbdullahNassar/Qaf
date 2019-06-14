@extends('admin.layouts.master')
@section('title')
    الكلمات الافتتاحيه
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
                    <span>الكلمات الافتتاحيه</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>الكلمات الافتتاحيه
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="{{route('admin.meta.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
                            {!! csrf_field() !!}
                            <input type="hidden" value="{{$meta->id}}" name="id" />
                            <div class="form-body row">
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> العنوان</label>
                                    <div class="col-md-4 ">
                                        <input type="text"  class="form-control " value="{{$meta->name}}" name="name" placeholder="العنوان">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> المحتوى</label>
                                    <div class="col-md-4 ">
                                        <input type="text"  class="form-control " value="{{$meta->value}}" name="value" placeholder="المحتوى">
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