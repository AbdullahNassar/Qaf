@extends('admin.layouts.master')
@section('title')
تواصل معنا
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
                <span>تواصل معنا</span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gears"></i>تواصل معنا
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{route('admin.contact')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">
                        {!! csrf_field() !!}

                        <div class="form-body row">
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> العنوان</label>
                                <div class="col-md-4 ">
                                    <input type="text"  class="form-control " name="title" placeholder="العنوان">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> المحتوى</label>
                                <div class="col-md-4 ">
                                    <input type="text"  class="form-control " name="content" placeholder="المحتوى">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 control-label"> الايقونه</label>
                                <div class="col-md-4 ">
                                    <select class="form-control fa" name="icon">
                                        @foreach($icons as $key => $val)
                                        <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="text-center">
                                    <button type="submit" class="btn  green btn-lg addBTN">
                                        <i class="fa fa-edit"></i>  اضافه</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        <i class="fa fa-users"></i>تواصل معنا  </div>
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
                                    <th>العنوان</th>
                                    <th>المحتوى</th>
                                    <th>الايقونه</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($contacts as $contact)
                                <tr>

                                    <td>{{$contact->title}}</td>
                                    <td>{{$contact->content}}</td>
                                    <td><i class="fa {{$contact->icon}}"></i></td>
                                    <td>
                                        <a href="{{route('admin.contact.edit' , ['id' => $contact->id ]) }}" class="btn btn-success " data-toggle="modal">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>

                                        <button type="button" class="btn btn-danger btndelet " data-id="{{ $contact->id }}"
                                                data-url="{{ route('admin.contact.delete' , ['id' => $contact->id ]) }}" >
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