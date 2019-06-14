@extends('admin.layouts.master')
@section('title')
    الاعلانات
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
                    <span>الاعلانات</span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-diamond"></i>جميع الاعلانات</div>
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
                                    <th>المالك</th>
                                    <th>السعر</th>
                                    <th>النوع</th>
                                    <th>الحاله</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach($ads as $ad)
                                        <tr class="@if($ad->active == 0) {{'bg-yellow-crusta bg-font-yellow-crusta'}}@elseif($ad->active == -1){{'bg-red bg-font-red'}}@elseif($ad->active == 1){{'bg-white bg-font-white'}}@endif">
                                            <td><img src="{{url('storage/uploads/banners/'.$ad->images[0]->image)}}" height="150px;" width="250px;"></td>
                                            <td>{{$ad->name}}</td>
                                            <td>{{$ad->user['username']}}</td>
                                            <td>{{$ad->price}}</td>
                                            <td>{{$ad->type['name']}}</td>
                                            <td>
                                                <select class="form-control ActiveID" name="active" data-id="{{$ad->id}}" data-token="{!! csrf_token() !!}" data-url="{{route('admin.ad.active')}}">
                                                    <option value="1" @if($ad->active == 1){{'selected'}}@endif>مفعل</option>
                                                    <option value="0" @if($ad->active == 0){{'selected'}}@endif>معلق</option>
                                                    <option value="-1" @if($ad->active == -1){{'selected'}}@endif>مغلق</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{route('site.ad.only',['slug'=>$ad->slug])}}" class="btn btn-success m-b-15 center-block">
                                                    <i class="fa fa-eye"></i>
                                                    عرض الاعلان
                                                </a>
                                                <a href="reports/{{$ad->id}}" class="btn btn-success m-b-15 center-block">
                                                    <i class="fa fa-exclamation-triangle"></i>
                                                    البلاغات
                                                </a>
                                                <button type="button" class="btn btn-danger btndelet btn-block" data-id="{{ $ad->id }}"
                                                        data-url="{{ route('admin.ad.delete' , ['id' => $ad->id ]) }}" >
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
                            {{ $ads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection