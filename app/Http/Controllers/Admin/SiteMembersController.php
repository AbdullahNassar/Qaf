<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use App\NotificationsContent;
use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class SiteMembersController extends Controller
{
    //
    public function getIndex(){
        $members = Member::paginate(9);
        $packages = Package::all();
        return view('admin.pages.users.index' ,compact('members','packages'));
    }

    public function postActive(Request $request)
    {
        $member = Member::where('id' ,$request->id)->first();

        if($request->active == 1){
            $member->update(['active' => 1]);

            return ['status' => 'success'];
        }elseif ($request->active == 0){
            $member->update(['active' => 0]);

            return ['status' => 'success'];
        }else{
            $member->update(['active' => -1]);

            return ['status' => 'success'];
        }
    }

    public function getDelete($id = null){
        $member = Member::find($id);
        if ($member->allMessages() != '[]')
        {
            $member->allMessages()->delete();
        }
        if ($member->countWishlist() != '[]')
        {
            $member->countWishlist()->delete();
        }
        if ($member->allAds() != '[]')
        {
            $member->allAds()->delete();
        }
        $member->delete();

        return redirect()->back();
    }

    public function postPackage(Request $request)
    {
        $member = Member::where('id' ,$request->id)->first();
       $result=$member->update([
            'package_id' =>$request->package_id
       ]);
       if ($result)
       {
           return ['status' => 'success' ,'msg' => 'تم تعديل الباقه بنجاح'];
       }
        return ['status' => 'error' ,'msg' => 'لقد حدث خطا يرجى المحاوله مره اخر'];
    }

    public function sendMessages(Request $request ,$id)
    {
        $messages = [];
        $notification = Notification::where('member_id',$id)->first();
        if ($notification)
        {
            $notification->update(['seen'=>1]);
            $messages = NotificationsContent::where('massage_id',$notification->id)->orderby('id' ,'ASC')->get();
        }
        $receiver_id = $id;
        if ($request->ajax())
        {
            return view('admin.pages.notifications.template.show-messages' ,compact('messages'))->render();
        }
        return view('admin.pages.notifications.show-one',compact('messages','receiver_id'));
    }
}
