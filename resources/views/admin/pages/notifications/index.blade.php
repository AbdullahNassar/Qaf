@extends('admin.layouts.master')
@section('title')
    الاشعارات
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
                    <span>الاشعارات</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    @if(Session::has('msg'))
                        <div class="alert alert-danger">
                            <p>{{Session::get('msg')}}</p>
                        </div>
                    @endif
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-bell"></i>الاشعارات  </div>
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
                                    <th>صوره المرسل</th>
                                    <th>اسم المرسل</th>
                                    <th>المحتوى</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($notifications as $notification)
                                    <tr @if($notification->seen == 0) style="background-color: #7c94aa" @endif>

                                        <td><img style="width: 300px;height: 160px" src="{{url('storage/uploads/profile/'.$notification->member->image)}}" /></td>
                                        <td>{{($notification->member->f_name )?$notification->member->f_name .' '. $notification->member->l_name : $notification->member->phone}}</td>
                                        <td>{{str_limit($notification->message,150)}}</td>
                                        <td>
                                            <a href="{{route('admin.notifications.only' , ['id' => $notification->id ]) }}" class="btn btn-success " data-toggle="modal">
                                                <i class="fa fa-envelope-o"></i>
                                                مشاهدة
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{$notifications->links()}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection