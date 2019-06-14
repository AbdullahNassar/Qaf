@if(sizeof($allConversations) > 0)
    @foreach($allConversations as $conversation)
        <div class="user-comment">
            <div class="comment-head">
                <div class="comment-head-img">
                    <img src="{{asset('storage/uploads/profile/'.$conversation->member['image'])}}">
                </div><!--End comment-head-img-->
                <div class="comment-head-cont">
                    <h3 class="title-sm">{{$conversation->member['f_name']}} {{$conversation->member['l_name']}}</h3>
                    <span class="comment-date">
                        <i class="fa fa-clock-o"></i>
                        {{$conversation->created_at->diffForHumans()}}
                    </span><!--End comment-date-->
                </div><!--End comment-head-cont-->
            </div><!--End comment-head-->
            <div class="comment-content">
                <p>
                    {{$conversation->content}}
                </p>
            </div><!--End comment-content-->
        </div><!--End user-comment-->
    @endforeach
    @else
    <div class="alert alert-danger text-center">
        <h3>لا توجد مناقشات علي هذا الاعلان حتي الان</h3>
    </div>
@endif
