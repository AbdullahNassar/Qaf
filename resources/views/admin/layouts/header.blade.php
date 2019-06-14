<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{route('admin.home')}}">
                <img src="{{asset('assets/admin/layouts/layout2/img/logo-default.png')}}" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
            <form class="search-form search-form-expanded" action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="بحث..." name="query">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">


                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-inbox" data-url="{{route('admin.notifications.header')}}" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> {{count($notifications->where('seen',0))}} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>
                                    <span class="bold">{{count($notifications->where('seen',0))}} في انتظار المراجعة</span> الاشعارات</h3>
                                <a href="{{route('admin.notifications')}}">عرض الكل</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    @foreach($notifications as $notification)
                                        <li @if($notification->seen == 0) style="background-color: #fafafa" @endif>
                                            <a href="{{route('admin.notifications.only' , ['id' => $notification->id ]) }}">

                                            <span class="photo">
                                                <img src="{{url('storage/uploads/profile/'.$notification->member->image)}}" class="img-circle" alt="">
                                            </span>
                                                <span class="subject">
                                                <span class="from">
                                                    {{($notification->member->f_name )?$notification->member->f_name .' '. $notification->member->l_name : $notification->member->phone}}
                                                </span>
                                                <span class="time">{{$notification->created_at->diffForhumans()}}</span>
                                            </span>
                                                <span class="message">
                                                {{str_limit($notification->message,150)}}
                                            </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{url('storage/uploads/admins/'.Auth::guard('admins')->user()->image)}}" />
                            <span class="username username-hide-on-mobile"> {{Auth::guard('admins')->user()->name}} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{route('admin.admins.edit',['id'=>auth()->guard('admins')->id()])}}">
                                    <i class="icon-user"></i>الصفحه الشخصيه</a>
                            </li>
                            <li>
                                <a href="{{route('admin.logout')}}">
                                    <i class="icon-logout"></i>تسجيل الخروج</a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
