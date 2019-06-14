@extends('admin.layouts.master')
@section('title')
الفئات
@endsection
@section('content')
<div class="page-content">
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('/admin')}}">الرئيسيه</a>
                <i class="fa fa-angle-left"></i>
            </li>
            <li>
                <span>الفئات</span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users"></i>جميع الفئات
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <div class="actions">
                        <a href="#add-modal" class="btn green" data-toggle="modal"><i class="fa fa-plus"></i> اضافة فئة جديدة</a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-stypeed table-responsive">
                            <thead>
                                <tr>
                                    <th>اسم الفئة</th>
                                    <th>اسم القسم</th>
                                    <th>اخر تعديل</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($types as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        {{ $type->category? $type->category->name : '--' }}
                                    </td>
                                    <td>{{$type->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success ajax-submit" data-url="{{ route('admin.types.info', ['id' => $type->id]) }}">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>

                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $type->id }}"
                                                data-url="{{ route('admin.types.delete' , ['id' => $type->id ]) }}" >
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
                        {{ $types->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.pages.types.modals.add')
@endsection
@section('scripts')
<script src="{{ asset('assets/global/process.js') }}"></script>
@endsection
