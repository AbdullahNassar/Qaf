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