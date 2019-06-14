@extends('admin.layouts.master')
@section('title')
اضافه دول جديده
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
                <span>الدول</span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map-o"></i>اضافه دوله جديده</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <br />
                </div>

                <div class="portlet-body form">
                    <form  action="{{ route('admin.countries') }}" 
                           enctype="multipart/form-data" method="post"  onsubmit="return false;">
                        {!! csrf_field() !!}
                        <div class="form-body row">
                            <div class="form-group col-sm-6 col-md-4">
                                <label class="col-md-3 control-label">اسم الدوله</label>
                                <div class="col-md-9 col-sm-6">
                                    <input type="text" class="form-control" name="country_name" placeholder="ادخل اسم الدوله">
                                </div>
                            </div>
                            <div class="state-row" id="file-row" >
                                <div class="form-group col-sm-6 col-md-4">
                                    <label class="col-md-3 control-label">اسم المدينة</label>
                                    <div class="col-md-9 col-sm-4">
                                        <input type="text" class="form-control"  name="city_name[]" placeholder="ادخل اسم المدينه">
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6">
                                    <button type="button" class="btn state-generate btn-xs btn-success">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="text-center ">
                                    <button type="submit" class="btn  green addBTN">حفظ 
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--End portlet-->
        </div> 
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-map-o"></i>جميع الدول </div>
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
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($countries as $country)
                                <tr>
                                    <td><input type="text" name="name" value="{{$country->name}}" class="form-control countryName" ></td>
                                    <td>
                                        <a data-url="{{route('admin.countries.edit' ,['id' => $country->id])}}" data-id="{{$country->id}}" data-token="{!! csrf_token() !!}" class="btn btn-success editCountryBTN " data-toggle="modal">
                                            <i class="fa fa-edit"></i> 
                                            تعديل
                                        </a>
                                        <a href="{{route('admin.cities',['id'=>$country->id])}}" class="btn btn-success " >
                                            <i class="fa fa-map-marker"></i> 
                                            المدن
                                        </a>
                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $country->id }}"
                                                data-url="{{route('admin.countries.delete' ,['id'=>$country->id])}}" >
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
@include('admin.pages.country.templates.add-country')
@endsection