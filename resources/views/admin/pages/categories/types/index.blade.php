@extends('admin.layouts.master')
@section('title')
    الانواع
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
                    <span>الانواع</span>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-map-o"></i>جميع الانواع </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                        <div class="actions">
                            <a href="#modal" data-id="{{Request::route()->id}}" data-toggle="modal" class="btn green addTypeBTN"><i class="fa fa-plus"></i> اضافة نوع جديد </a>
                        </div>
                    </div>

                    <div class="portlet-body form">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-stypeed table-responsive">
                                <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>القسم</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                @foreach($types as $type)
                                    <tr>
                                        <td><input type="text" name="name" value="{{$type->name}}" class="form-control typeName"></td>
                                        <td>
                                            <select name="category_id" class="form-control CategoryID">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($type->category_id == $category->id){{'selected'}}@endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <a data-url="{{route('admin.types.edit' ,['id' => $type->id])}}" data-id="{{$type->id}}" data-token="{!! csrf_token() !!}" class="btn btn-success editTypeBTN ">
                                                <i class="fa fa-edit"></i>
                                                تعديل
                                            </a>
                                            <button type="button" class="btn btn-danger btndelet " data-id="{{ $type->id }}"
                                                    data-url="{{route('admin.types.delete' ,['id'=>$type->id])}}" >
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
    @include('admin.pages.categories.types.modal.add-type')
@endsection