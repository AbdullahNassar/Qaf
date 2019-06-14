@if(sizeof($reviews) > 0)
    @foreach($reviews as $review)
        <div class="user-comment">
            <div class="comment-head">
                <div class="comment-head-img">
                    <img src="{{asset('storage/uploads/profile/'.$review->member['image'])}}">
                </div><!--End comment-head-img-->
                <div class="comment-head-cont">
                    <h3 class="title-sm">{{$review->member['f_name']}} {{$review->member['l_name']}}</h3>
                    <span class="comment-date">
                        <i class="fa fa-clock-o"></i>
                        {{$review->created_at->diffForHumans()}}
                    </span><!--End comment-date-->

                    <ul class="rating">
                    @for($i = 1 ; $i <= 5 ;$i++)
                        @if($i < $review->rate)
                        <li class="active"></li>
                            @else
                        <li></li>
                        @endif
                    @endfor
                    </ul>
                </div><!--End comment-head-cont-->
            </div><!--End comment-head-->
            <div class="comment-content">
                <p>
                    {{$review->comment}}
                </p>
            </div><!--End comment-content-->
        </div><!--End user-comment-->
    @endforeach
    @else
    <div class="alert alert-danger text-center">
        <h3>لم يتم اضافه مراجعات علي الاعلان حتي الان</h3>
    </div>
@endif