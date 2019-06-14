@extends('admin.layouts.master')
@section('title')
    الاشتراكات
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
                    <span>الاشتراكات</span>
                </li>
            </ul>
        </div>
        <form action="{{route('admin.subscriber')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
            {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>الاشتراكات
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                            <div class="form-body row">
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> الموضوع</label>
                                    <div class="col-md-6 ">
                                        <input type="text"  class="form-control " name="title" placeholder="الموضوع">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-md-3 control-label"> الرساله</label>
                                    <div class="col-md-6">
                                        <div class="col-md-12 col-sm-6">
                                        <textarea class="form-control tiny-editor" name="messages">
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="text-center">
                                        <button type="submit" class="btn  green btn-lg addBTN">
                                            <i class="fa fa-edit"></i>  أرسال</button>
                                    </div>
                                </div>
                            </div>
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
                            <i class="fa fa-users"></i>الرسائل  </div>
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
                                    <th><input type="checkbox" id="chose-all-email" /></th>
                                    <th>البريد الالكترونى</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($subscribers as $subscriber)
                                    <tr>

                                        <td>
                                            <input class="chose-email" type="checkbox" name="email[]" value="{{$subscriber->id}}"/>
                                        </td>
                                        <td>{{$subscriber->email}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btndelet " data-id="{{ $subscriber->id }}"
                                                    data-url="{{ route('admin.meta.delete' , ['id' => $subscriber->id ]) }}" >
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
    </form>
    </div>
@endsection