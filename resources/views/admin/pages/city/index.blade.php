@extends('admin.layouts.master')
@section('title')
عرض المدن
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
                <span>المدن</span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map-o"></i>جميع المدن </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <div class="actions">
                        <a href="#modal" data-id="{{Request::route()->id}}" data-toggle="modal" class="btn green addCityBTN"><i class="fa fa-plus"></i> اضافة محافظه جديده </a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-stypeed table-responsive">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($cities as $city)
                                <tr>
                                    <td><input type="text" name="name" value="{{$city->name}}" class="form-control cityName"></td>
                                    <td>
                                        <a data-url="{{route('admin.cities.edit' ,['id' => $city->id])}}" data-id="{{$city->id}}" data-token="{!! csrf_token() !!}" class="btn btn-success editCityBTN " data-toggle="modal">
                                            <i class="fa fa-edit"></i> 
                                            تعديل
                                        </a>
                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $city->id }}"
                                                data-url="{{route('admin.cities.delete' ,['id'=>$city->id])}}" >
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
@include('admin.pages.city.modal.add-city')
@endsection

