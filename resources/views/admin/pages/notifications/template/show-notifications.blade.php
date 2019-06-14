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