<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use App\NotificationsContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function getIndex()
    {
        $notifications = Notification::orderby('id' ,'ASC')->paginate(15);
        return view('admin.pages.notifications.index',compact('notifications'));
    }

    public function getOne(Request $request ,$id)
    {
        $notification = Notification::find($id);
        $notification->update(['seen'=>1]);
        $messages = NotificationsContent::where('massage_id',$id)->orderby('id' ,'ASC')->get();
        $receiver_id = $notification->member_id;
        if ($request->ajax())
        {
            return view('admin.pages.notifications.template.show-messages' ,compact('messages'))->render();
        }
        return view('admin.pages.notifications.show-one',compact('messages','receiver_id'));
    }

    public function postMessage(Request $request)
    {
        if ($request->message == null)
        {
            return ['status' => 'error'];
        }
        if (!$request->massage_id)
        {
            $notification = new Notification();
            $notification->member_id =$request->receiver_id;
            $notification->package_id =0;
            $notification->message =$request->message;
            $notification->save();
            $request->massage_id = $notification->id;
        }
        $notification = Notification::find($request->massage_id);
        $notification->update(['type'=>0]);

        $message = new NotificationsContent();
        $message->massage_id = $request->massage_id;
        $message->sender_id = 0;
        $message->receiver_id = $request->receiver_id;
        $message->massage = $request->message;
        if ($message->save())
        {
            return ['status' => 'success','massage_id'=>$request->massage_id];
        }
        return ['status' => 'error' ,'msg' => 'لقد حدث خطا يرجى المحاوله مره اخر'];
    }

    public function showNotification()
    {
        $notifications = Notification::Orderby('id' ,'ASC')->get();
        return view('admin.pages.notifications.template.show-notifications',compact('notifications'))->render();
    }

}
