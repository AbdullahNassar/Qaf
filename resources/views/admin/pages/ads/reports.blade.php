@extends('admin.layouts.master')
@section('title')
    البلاغات
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
                    <span>البلاغات</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-exclamation-triangle"></i>جميع البلاغات</div>
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
                                    <th>نوع البلاغ</th>
                                    <th>البلاغ</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report->report_type}}</td>
                                        <td>{{$report->report}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btndelet " data-id="{{ $report->id }}"
                                                    data-url="delete/{{$report->id}}" >
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