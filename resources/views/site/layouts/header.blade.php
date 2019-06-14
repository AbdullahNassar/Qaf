<header class="header">
    <div class="container">
        <a href="{{route('site.home')}}" class="logo">
            <img src="{{asset('assets/site/images/logo.png')}}">
        </a>
        <div class="top-navbar">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <nav class="collapse collapsing navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if(!auth()->guard('members')->check())
                        <li>
                            <a href="{{route('site.login')}}">تسجيل الدخول</a>
                        </li>
                    @else
                        <li>
                            <a href="{{route('site.profile.settings')}}">مرحبا : {{(auth()->guard('members')->user()->l_name)?auth()->guard('members')->user()->f_name .' '. auth()->guard('members')->user()->l_name:auth()->guard('members')->user()->phone}}</a>
                        </li>

                        <li class="dropdown" id="header_notification_bar" data-url="{{route('site.profile.notification')}}">
                            <a href="user-notification.html" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                إشعارات
                                <span class="notf-num">
                                            {{count($notifications->where('member_id',auth()->guard('members')->id())->where('type',0))}}
                                        </span>
                            </a>
                            <ul class="dropdown-menu notification">
                                <div class="notfic-head">
                                            <span>
                                                الأشعارات
                                            </span>
                                    <span>
                                                <a href="#">تحديد الكل كمقروء</a>
                                            </span>
                                </div>
                                <div class="notific-body">
                                    @foreach($notifications->where('member_id',auth()->guard('members')->id())->where('type',0) as $notification)
                                    <li @if($notification->seen == 0) style="background-color: #7c94aa" @endif>
                                        <a href="{{route('site.profile.get-notification-one',['id'=>$notification->id])}}">
                                            <p>{{str_limit($notification->message,150)}}</p>
                                            <span class="time">
                                                        {{$notification->created_at->diffForhumans()}}
                                                    </span>
                                        </a>
                                    </li>
                                    @endforeach
                                </div><!--End notific-body-->
                                <div class="notific-foot">
                                    <a href="{{route('site.profile.get-notification')}}">
                                        شاهد جميع الإشعارات
                                    </a>
                                </div>
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('site.logout')}}">تسجيل الخروج</a>
                        </li>


                    @endif
                    <li>
                        <a href="{{route('site.add.add')}}" class="bg-link">انشئ اعلانك الآن</a>
                    </li>
                </ul>
            </nav>
        </div><!--End top-navbar-->
    </div><!-- End container-->
</header><!-- End Header -->
