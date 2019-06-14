@foreach($messages as $message)
    <li class="@if($message->sender_id ==0) in @else out @endif">
        <img class="avatar" alt="" src="@if($message->sender_id ==0) http://knowledge-commons.com/static/assets/images/avatar.png @else {{url('storage/uploads/profile/'.$message->member->image)}} @endif" />
        <div class="message">
            <span class="arrow"> </span>
            <a href="javascript:;" class="name"> @if($message->sender_id ==0) الاداره @else {{($message->member->f_name )?$message->member->f_name .' '. $message->member->l_name : $message->member->phone}} @endif </a>
            <span class="datetime"> {{$message->created_at->diffForhumans()}} </span>
            <span class="body"> {{$message->massage}} </span>
        </div>
    </li>
@endforeach