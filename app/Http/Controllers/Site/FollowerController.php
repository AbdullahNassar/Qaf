<?php

namespace App\Http\Controllers\Site;

use App\Follower;
use App\FounderMessage;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    //
    public function getIndex()
    {
        $member = auth()->guard('members')->user()->id;

        $followers = Follower::where('followed_id' ,$member)->get();

        foreach ($followers as $follower){
            $follower->founder_id = Member::where('id' ,$follower->follower_id)->value('id');
            $follower->name = Member::where('id' ,$follower->follower_id)->value('username');
            $follower->image = Member::where('id' ,$follower->follower_id)->value('image');
            $follower->email = Member::where('id' ,$follower->follower_id)->value('email');
        }

        return view('site.pages.profile.followers' ,compact('followers'));
    }

    public function postDelete(Request $request ,$id)
    {
        $follower = Follower::find($id);

        if ($follower->delete()){
            return ['response' => 'success'];
        }else{
            return ['response' => 'error'];
        }
    }

    public function postContact(Request $request ,$id)
    {
        $v = validator($request->all() ,[
            'message' => 'required'
        ] ,[
            'message.required' => 'برجاء ادخال رسالتك'
        ]);

        if ($v->fails()){
            return ['status' => 'warning' ,'msg' => implode('<br >' ,$v->errors()->all())];
        }

        $message = new FounderMessage();

        $message->message = $request->message;
        $message->sender_id = auth()->guard('members')->user()->id;
        $message->receiver_id = $id;

        if ($message->save()){
            return ['status' => 'success' ,'msg' => 'تم ارسال رسالتك بنجاح'];
        }

        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء ارسال رسالتك'];
    }
}
