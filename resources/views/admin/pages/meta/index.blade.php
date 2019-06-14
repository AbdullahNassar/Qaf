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
                        <form action="{{route('admin.meta')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
                            {!! csrf_field() !!}

                            <div class="form-body row">
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> الاسم</label>
                                    <div class="col-md-4 ">
                                        <input type="text"  class="form-control " name="name" placeholder="العنوان">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> المحتوى</label>
                                    <div class="col-md-4 ">
                                        <input type="text"  class="form-control " name="value" placeholder="المحتوى">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="text-center">
                                        <button type="submit" class="btn  green btn-lg addBTN">
                                            <i class="fa fa-edit"></i>  اضافه</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div><!--End portlet-->
            </div>
            <div class="col-md-12">
                <div class="portlet box green">
                    @if(Session::has('msg'))
                        <div class="alert alert-danger">
                            <p>{{Session::get('msg')}}</p>
                        </div>
                    @endif
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i>تواصل معنا  </div>
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
                                    <th>الاسم</th>
                                    <th>المحتوى</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($metas as $meta)
                                    <tr>

                                        <td>{{$meta->name}}</td>
                                        <td>{{$meta->value}}</td>
                                        <td>
                                            <a href="{{route('admin.meta.edit' , ['id' => $meta->id ]) }}" class="btn btn-success " data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                                تعديل
                                            </a>

                                            <button type="button" class="btn btn-danger btndelet " data-id="{{ $meta->id }}"
                                                    data-url="{{ route('admin.meta.delete' , ['id' => $meta->id ]) }}" >
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