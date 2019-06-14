@foreach($notifications as $message)
    <div class="user-comment @if($message->sender_id ==0) recived-message @else sent-message @endif">
        <div class="comment-head">
            <div class="comment-head-img">
                <img class="avatar" alt="" src="@if($message->sender_id ==0) http://knowledge-commons.com/static/assets/images/avatar.png @else {{url('storage/uploads/profile/'.$message->member
                                           ->image)}} @endif" />
            </div><!--End comment-head-img-->
            <div class="comment-head-cont">
                <h3 class="title-sm">@if($message->sender_id ==0) الاداره @else {{($message->member->f_name )?$message->member->f_name .' '. $message->member->l_name : $message->member->phone}} @endif</h3>
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