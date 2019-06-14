@extends('site.layouts.master')
@section('title')
    حسابى
@endsection
@section('content')
    <div class="page-header">
        <div class="page-header-title">
            <div class="container">
                <h2 class="title">مفضلتى</h2>
            </div><!--End container-->
        </div><!--End page-header-title-->
        <div class="page-header-info">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{route('site.home')}}">الرئيسية</a></li>
                    <li class="active">مفضلتى</li>
                </ul>
            </div><!--End container-->
        </div><!-- End Page-Header-Info -->
    </div><!-- End page-header-->
    <div class="page-content">
        <section class="section-md">
            <div class="container">
                <div class="row">
                    @include('site.pages.profile.sidebar')
                    <div class="col-md-9">
                        <div class="section-head has-border">
                            <h3 class="section-title">الجدول</h3><!-- End Section-Title -->
                        </div>
                        @if(session()->has('msg'))
                            <div class="alert alert-danger text-center">
                                <h3>{{session('msg')}}</h3>
                            </div>
                        @endif
                        <div class="section-content table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>لينك نتائح البحث</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $result)
                                <tr>
                                    <td>{{$result->search_url}}</td>
                                    <td>
                                        <a href="{{$result->search_url}}">مشاهده</a>
                                        <a href="{{route('result-search-delete',['id'=>$result->id])}}">حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table><!--End Table-->
                        </div><!--End Section-content-->
                    </div><!-- End col -->
                </div><!-- End row -->
            </div><!-- End container -->
        </section><!-- End Category-Section -->
    </div><!--End page-content-->
@endsection