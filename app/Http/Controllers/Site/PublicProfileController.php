<?php

namespace App\Http\Controllers\Site;

use App\Ad;
use App\Follower;
use App\FounderMessage;
use App\Message;
use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Auth;

class PublicProfileController extends Controller
{
    //
    public function getIndex($username)
    {
        $member = Member::where('username' ,$username)->first();
        $ads = Ad::where('user_id' ,$member->id)->paginate(12);
        // Count Views
        $ip = request()->ip();
        $url =request()->url();
        $ip_exiest = Visitor::where('user_ip',$ip)->where('page_url',$url)->first();
        if (!$ip_exiest)
        {
            Visitor::create([
                'user_ip'=>$ip,
                'page_url'=>$url,
            ]);
            $member->visits +=1;
            $member->save();
        }
        return view('site.pages.profile.public' ,compact('member' ,'ads'));
    }

    //contact the user
    public function postIndex(Request $request ,$username)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $v = validator($request->all() ,[
            'message' => 'required'
        ] ,[
            'message.required' => 'برجاء ادخال رسالتك'
        ]);

        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
        }

        $message = new FounderMessage();

        $message->message = $request->message;
        $message->sender_id = Auth::guard('members')->user()->id;
        $message->receiver_id = Member::where('username' ,$username)->value('id');

        if($message->save()){
            return ['status' => 'success' ,'msg' => 'تم ارسال رسالتك بنجاح'];
        }

        return ['status' => 'error' ,'msg' => 'لقد حدث خطا اثناء ارسال رسالتك برجاء المحاوله لاحقا'];
    }

    //follow the user
    public function postFollow(Request $request, $id)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $follow = Follower::where('follower_id' ,Auth::guard('members')->user()->id)->where('followed_id' ,$id)->first();

        if(sizeof($follow) > 0){
            $follow->delete();

            return ['status' => 'error'];
        }else{
            $following = new Follower();

            $following->follower_id = Auth::guard('members')->user()->id;
            $following->followed_id = $id;

            if($following->save()){
                return ['status' => 'success'];
            }
        }

    }
}
