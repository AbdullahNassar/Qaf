<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start @if(Request::route()->getName() == 'admin.home'){{'active open'}}@endif">
                <a href="{{route('admin.home')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">الرئيسيه</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.settings'){{'active open'}}@endif">
                <a href="{{route('admin.settings')}}" class="nav-link nav-toggle">
                    <i class="fa fa-gears"></i>
                    <span class="title">بيانات الموقع</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item  @if(Request::route()->getName() == 'admin.admins' || Request::route()->getName() == 'admin.site.users'){{'active open'}}@endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">المستخدمين</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if(Request::route()->getName() == 'admin.admins'){{'active open'}}@endif">
                        <a href="{{route('admin.admins')}}" class="nav-link ">
                            <span class="title">مستخدمي لوحه التحكم</span>
                        </a>
                    </li>
                    <li class="nav-item  @if(Request::route()->getName() == 'admin.site.users'){{'active open'}}@endif">
                        <a href="{{route('admin.site.users')}}" class="nav-link ">
                            <span class="title">مستخدمي الواجهه</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.countries'){{'active open'}}@endif">
                <a href="{{route('admin.countries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-map-marker"></i>
                    <span class="title">الدول والمدن التابعه لها </span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.ads'){{'active open'}}@endif">
                <a href="{{route('admin.ads')}}" class="nav-link nav-toggle">
                    <i class="fa fa-diamond"></i>
                    <span class="title">الاعلانات </span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.categories.index'){{'active open'}}@endif">
                <a href="{{route('admin.categories.index')}}" class="nav-link nav-toggle">
                    <i class="fa fa-database"></i>
                    <span class="title">الاقسام وانواعها</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.about'){{'active open'}}@endif">
                <a href="{{route('admin.about')}}" class="nav-link nav-toggle">
                    <i class="fa fa-info-circle"></i>
                    <span class="title">عن الموقع</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.contact'){{'active open'}}@endif">
                <a href="{{route('admin.contact')}}" class="nav-link nav-toggle">
                    <i class="fa fa-envelope"></i>
                    <span class="title">تواصل معنا</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.meta'){{'active open'}}@endif">
                <a href="{{route('admin.meta')}}" class="nav-link nav-toggle">
                    <i class="fa fa-tags"></i>
                    <span class="title">الكلمات الافتتاحيه</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.subscriber'){{'active open'}}@endif">
                <a href="{{route('admin.subscriber')}}" class="nav-link nav-toggle">
                    <i class="fa fa-envelope-o  "></i>
                    <span class="title">الاشتراكات</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.notifications'){{'active open'}}@endif">
                <a href="{{route('admin.notifications')}}" class="nav-link nav-toggle">
                    <i class="fa fa-bell"></i>
                    <span class="title">الإشعارات</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
