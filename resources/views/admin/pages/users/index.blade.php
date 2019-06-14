@extends('admin.layouts.master')
@section('title')
    مستخدمي واجهه الموقع
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
                                    <th>الباقه</th>
                                    <td>الحاله</td>
                                    <td>دردشه</td>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($members as $user)
                                    <tr class="@if($user->active == 0) {{'bg-yellow-crusta bg-font-yellow-crusta'}}@elseif($user->active == -1){{'bg-red bg-font-red'}}@elseif($user->active == 1){{'bg-white bg-font-white'}}@endif">
                                        <td>
                                            <img src="{{$user->image?url('storage/uploads/profile/'.$user->image):asset('assets/site/images/user-img.jpg')}}" style="width: 150px; height: 150px;">
                                        </td>
                                        <td>{{$user->f_name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->country['name']}}</td>
                                        <td>
                                            <select class="form-control choose-package" name="package_id" data-id="{{$user->id}}" data-url="{{route('admin.users.choose-package')}}">
                                                @foreach($packages as $package)
                                                <option value="{{$package->id}}" @if($user->package_id == $package->id){{'selected'}}@endif>{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control ActiveID" name="active" data-id="{{$user->id}}" data-token="{!! csrf_token() !!}" data-url="{{route('admin.users.active')}}">
                                                <option value="1" @if($user->active == 1){{'selected'}}@endif>مفعل</option>
                                                <option value="0" @if($user->active == 0){{'selected'}}@endif>معلق</option>
                                                <option value="-1" @if($user->active == -1){{'selected'}}@endif>مغلق</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.users.send-message',['id'=>$user->id])}}" class="btn btn-info">
                                                <i class="fa fa-envelope"></i>
                                                ارسال رساله
                                            </a>
                                        <td>
                                            <button type="button" class="btn btn-danger btndelet " data-id="{{ $user->id }}"
                                                    data-url="{{ route('admin.users.delete' , ['id' => $user->id ]) }}" >
                                                <i class="fa fa-trash"></i>
                                                مسح
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right">
                            {{ $members->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection