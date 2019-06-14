<?php

namespace App\Http\Controllers\Site;

use App\Ad;
use App\Member;
use App\MessagesContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class MessageController extends Controller
{
    //
    public function getIndex()
    {
        $member = auth()->guard('members')->user()->id;
        $messages = Message::where('receiver_id' , $member)->orWhere('member_id' , $member)->get();
        foreach ($messages as $message){
            if ($message->member_id != $member)
            {
                $id = $message->member_id;
            }else
            {
                $id = $message->receiver_id;
            }
            $message->ad = Ad::where('id' ,$message->ad_id)->value('name');
            $message->name = Member::where('id' ,$id)->value('username');
            $message->image= Member::where('id' ,$id)->value('image');
        }

        return view('site.pages.profile.messages' ,compact('messages'));
    }

    public function getReceivedMessages()
    {
        $member = auth()->guard('members')->user()->id;

        $messages = Message::where('receiver_id' , $member)->get();

        foreach ($messages as $message){
            $message->ad = Ad::where('id' ,$message->ad_id)->value('name');
            $message->name = Member::where('id' ,$message->member_id)->value('username');
            $message->image= Member::where('id' ,$message->member_id)->value('image');
        }

        return view('site.pages.profile.received' ,compact('messages'));
    }

    public function getSentMessages()
    {
        $member = auth()->guard('members')->user()->id;

        $messages = Message::where('member_id' , $member)->get();

        foreach ($messages as $message){
            $message->ad = Ad::where('id' ,$message->ad_id)->value('name');
            $message->name = Member::where('id' ,$message->receiver_id)->value('username');
            $message->image= Member::where('id' ,$message->receiver_id)->value('image');
        }

        return view('site.pages.profile.sent' ,compact('messages'));
    }

    public function getSingleMessage(Request $request, $id)
    {
        $message = Message::where('id' ,$id)->first();
        $ad = Ad::where('id' ,$message->ad_id)->value('name');
        $messages = MessagesContent::where('massage_id',$message->id)->orderBy('id','ASC')->get();
        foreach ($messages as $only){
            $member =Member::find($only->sender_id);
            $only->name = $member->f_name?$member->f_name.' '.$member->l_name:$member->username;
            $only->image =$member->image ;
        }
        if ($request->ajax())
        {
            return view('site.pages.profile.template.show-messages' ,compact('messages'))->render();
        }
        return view('site.pages.profile.onlyMessage' ,compact('ad' ,'messages'));
    }
    public function postSendMessage(Request $request)
    {
        if ($request->message == null)
        {
            return ['status' => 'error' ,'msg' => 'من فضلك ادخل محتوى الرساله'];
        }
        $message = new MessagesContent();
        $message->massage_id = $request->massage_id;
        $message->sender_id = auth()->guard('members')->id();
        $message->receiver_id = $request->receiver_id;
        $message->massage = $request->message;
        if ($message->save())
        {
            return ['status' => 'success'];
        }
        return ['status' => 'error' ,'msg' => 'لقد حدث خطا يرجى المحاوله مره اخر'];
    }

}
