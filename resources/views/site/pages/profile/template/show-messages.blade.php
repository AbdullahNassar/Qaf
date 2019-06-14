@foreach($messages as $message)
    <div class="user-comment @if($message->sender_id == auth()->guard('members')->id())sent-message @else recived-message @endif">
        <div class="comment-head">
            <div class="comment-head-img">
                @if(!empty($message->image))
                    <img src="{{asset('storage/uploads/profile/'.$message->image)}}">
                @else
                    <img src="http://knowledge-commons.com/static/assets/images/avatar.png">
                @endif
            </div><!--End comment-head-img-->
            <div class="comment-head-cont">
                <h3 class="title-sm">{{$message->name}}</h3>
                <span class="comment-date">
                                                            <i class="fa fa-clock-o"></i>
                    {{$message->created_at->diffForhumans()}}
                                                        </span><!--End comment-date-->
            </div><!--End comment-head-cont-->
        </div><!--End comment-head-->
        <div class="comment-content">
            <p>{{$message->massage}}</p>
        </div><!--End comment-content-->
    </div><!--End user-comment-->
@endforeach