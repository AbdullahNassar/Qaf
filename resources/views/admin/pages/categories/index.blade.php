@extends('admin.layouts.master')
@section('title')
الاقسام الرئيسية و الفرعية
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
                <span>الاقسام</span>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users"></i>جميع الاقسام
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                    <div class="actions">
                        <a href="#add-main-modal" class="btn green" data-toggle="modal"><i class="fa fa-plus"></i> اضافة قسم رئيسي </a>
                        <a href="#add-sub-modal" class="btn green" data-toggle="modal"><i class="fa fa-pencil"></i> اضافة قسم فرعي </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-stypeed table-responsive">
                            <thead>
                                <tr>
                                    <th>اسم القسم</th>
                                    <th>نوع القسم</th>
                                    <th>اخر تعديل</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if ($category->isMain())
                                        رئيسي
                                        @else
                                        فرعي من {{ $category->parent? $category->parent->name : '--' }}
                                        @endif
                                    </td>
                                    <td>{{$category->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('admin.types' ,['id'=>$category->id])}}" class="btn btn-success ">
                                            <i class="fa fa-link"></i>
                                            الانواع
                                        </a>

                                        <a href="#" class="btn btn-success ajax-submit" data-url="{{ route('admin.categories.info', ['id' => $category->id]) }}">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>

                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $category->id }}"
                                                data-url="{{ route('admin.categories.delete' , ['id' => $category->id ]) }}" >
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.pages.categories.modals.add')
@include('admin.pages.categories.modals.add-sub')
@endsection
@section('scripts')
<script src="{{ asset('assets/global/process.js') }}"></script>
@endsection
