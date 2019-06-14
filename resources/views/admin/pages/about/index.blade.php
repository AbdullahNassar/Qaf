@extends('admin.layouts.master')
@section('title')
    عن الموقع
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
                    <span>عن الموقع</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users"></i>عن الموقع </div>
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
                                    <th>القسم</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                <tr>
                                    <td>القسم الاول</td>
                                    <td>
                                        <a href="{{route('admin.about.sec',['flug'=>'first'])}}" class="btn btn-success " data-toggle="modal">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>القسم الثانى</td>
                                    <td>
                                        <a href="{{route('admin.about.sec',['flug'=>'second'])}}" class="btn btn-success " data-toggle="modal">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>القسم الثالث</td>
                                    <td>
                                        <a href="{{route('admin.about.sec',['flug'=>'third'])}}" class="btn btn-success " data-toggle="modal">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection