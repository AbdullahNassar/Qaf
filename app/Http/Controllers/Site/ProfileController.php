<?php

namespace App\Http\Controllers\Site;

use App\Ad;
use App\Category;
use App\Country;
use App\Member;
use App\Notification;
use App\NotificationsContent;
use App\Package;
use App\ResultsSearch;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function getIndex()
    {
        $member = Member::where('id' ,Auth::guard('members')->user()->id)->first();
        return view('site.pages.profile.index' ,compact('member'));
    }

    public function getAds()
    {
        Carbon::setLocale('ar');

        $ads = Ad::where('user_id' ,auth()->guard('members')->user()->id)->get();

        return view('site.pages.profile.ads.index',compact('ads'));
    }

    public function getFavorites()
    {
        $wishlists = Wishlist::where('member_id' ,auth()->guard('members')->user()->id)->latest()->paginate(10);
        return view('site.pages.profile.favorite',compact('wishlists'));
    }

    public function getSettings()
    {
        $member = auth()->guard('members')->user();
        $countries = Country::all();
        return view('site.pages.profile.settings',compact('member','countries'));
    }

    public function postSettings(Request $request)
    {
        $member = Member::find($request->id);
        if ($request->email)
        {
            $v = validator($request->all(), [
                'email' => 'required|email|unique:members,email',
            ],[
                'email.required'=>'حقل البريد الالكترونى مطلوب',
                'email.email'=>' البريد الالكترونى موجود مسبقا'
            ]);
            if ($v->fails())
            {
                return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
            }
            if (!$request->code)
            {
                $code ='';
                for ($i=0;$i<5;$i++)
                {
                    $code.=mt_rand(0,9);
                }
                $member->code = $code;
                Mail::send('site.mails.confirm-phone',['code'=>$code],function ($m) use ($member){
                    $m->to('m@m.com','mahmoud')->subject('Confirm Your Number');
                });
                $member->save();
                return ['status' => 'confirm' ,'msg' => 'تم ارسال كود التاكيد الى البريد الجديد'];
            }else
            {
                $v = validator($request->all(), [
                    'code' => 'required',
                ],[
                    'email.required'=>'حقل رقم التاكيد مطلوب'
                ]);
                if ($v->fails())
                {
                    return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
                }
                if ($request->code != $member->code)
                {
                    return ['status' => 'error' ,'msg' => 'رقم التاكيد خطأ'];
                }else
                {
                    $member->email = $request->email;
                }
            }

        }elseif ($request->phone)
        {
            $v = validator($request->all(), [
                'phone' => 'required|unique:members,phone',
            ],[
                'phone.required'=>'حقل رقم التلفون مطلوب',
                'phone.unique'=>' رقم التلفون موجود مسبقا'
            ]);
            if ($v->fails())
            {
                return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
            }
            $member->phone = $request->phone;
        }else
        {
            if ($request->oldPassword !=null || $request->newPassword !=null)
            {
                $v = validator($request->all(), [
                    'oldPassword' => 'required',
                    'newPassword' => 'required',
                ],[
                    'oldPassword.required'=>'ادخل كلمه المرور القديمه',
                    'newPassword.required'=>'ادخل كلمه المرور الجديده',
                ]);
                if (Hash::check($request->oldPassword,$member->password))
                {
                    $member->password = bcrypt($request->password);
                }else
                {
                    return ['status' => 'error' ,'msg' => 'كلمه المرور خطأ'];
                }
            }else{
                $v = validator($request->all(), [
                    'f_name' => 'required',
                    'l_name' => 'required',
                    'username' => 'required',
                    'country_id' => 'required',
                ],[
                    'f_name.required'=>'ادخل الاسم الاول',
                    'l_name.required'=>'ادخل الاسم الاخير',
                    'username.required'=>'ادخل الاسم الاخير',
                    'country_id.required'=>'اختر المنطقه',
                ]);
            }
            if ($v->fails())
            {
                return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
            }
            $member->f_name=$request->f_name;
            $member->l_name=$request->l_name;
            $member->username=$request->username;
            $member->country_id=$request->country_id;
            $destination = storage_path('uploads/profile');
            if ($request->image) {
                @unlink($destination . "/{$member->image}");
                $member->image = $request->image->getClientOriginalName();
                $request->image->move($destination, $member->image);
            }
        }
        if ($member->save())
        {
            return ['status' => 'success' ,'msg' => 'تم تحديث البيانات بنجاح'];
        }
        return ['status' => 'error' ,'msg' => 'لقد حدث خطا يرجى المحاوله مره اخر'];
    }

    public function closeAccount()
    {
        $member =auth()->guard('members')->user();
        $member->active = -1;
        $member->save();
        auth()->guard('members')->logout();
        return redirect()->route('site.login');
    }

    public function getPackages()
    {
        $packages =Package::all();
        return view('site.pages.profile.packages',compact('packages'));
    }
    public function postPackages($id)
    {
        $member_id =auth()->guard('members')->id();
        $package_name = Package::find($id)->name;
        $massage = 'طلب استفسار بخصوص الاشتراك فى الباقه ال'.$package_name;
        $notification = Notification::where('member_id',$member_id)->first();
        if (!$notification)
        {
            $notification = new Notification();
            $notification->member_id =$member_id;
        }
        $notification->package_id =$id;
        $notification->message =$massage;
        $notification->seen =0;
        $notification->type =1;
        $notification->save();

        $notification_content = new NotificationsContent();
        $notification_content->sender_id = $member_id;
        $notification_content->receiver_id =0;
        $notification_content->massage = $massage;
        $notification_content->massage_id =$notification->id;
        if ($notification_content->save())
        {
            return ['status' => 'success' ,'msg' => 'تم ارسال طلب الاشتراك فى الباقه ال'.$package_name.' بنجاح بنتظار موافقه الادمن'];
        }
        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء اضافه بلاغك برجاء الحاوله لاحقا'];
    }

    public function postDeleteWishlist(Request $request ,$id)
    {
        $wishlist = Wishlist::where('ad_id' ,$id)->where('member_id' ,auth()->guard('members')->user()->id)->first();

        if ($wishlist->delete()){
            return ['response' => 'success'];
        }

        return ['response' => 'error'];
    }

    // Edit Ads
    public function getEdit($slug,Request $request)
    {
        if ($request->ajax())
        {
            $images = AdImage::all();
            return $images;
        }
        $ad = Ad::where('slug',$slug)->first();
        return view('site.pages.profile.ads.edit',compact('ad'));
    }

    public function postUpdate(Request $request)
    {
        $v =validator($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'keywords'=>'required',
            'price'=>'required',
            'used'=>'required',
            'image'=>'array',
            'image.*'=>'required',
        ],[
            'name.required'=>'اسم الاعلان مطلوب',
            'description.required'=>'وصف الاعلان مطلوب',
            'keywords.required'=>'الكلمات الدلاليه مطلوبه',
            'price.required'=>'سعر الاعلان مطلوب',
            'used.required'=>'حالة المنتج مطلوبه',
            'image.required'=>'من فضلك ارفع صور للاعلان '
        ]);
        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
        }
        $ad = Ad::find($request->id);
        $ad->name=$request->name;
        $ad->description=$request->description;
        $ad->keywords=$request->keywords;
        $ad->price=$request->price;
        $ad->used=$request->used;
        if ($ad->save())
        {
            // store the product images
            if($request->image){
                $destination = storage_path('uploads/banners/');
                foreach ($request->image as $img) {
                    $imageName = $img->getClientOriginalName();
                    $img->move($destination, $imageName);
                    $ad->images()->create([
                        'image' => $imageName
                    ]);
                }
            }
            return ['status' => 'success' ,'msg' => 'تم تعديل الاعلان بنجاح'];
        }
        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء اضافه بلاغك برجاء الحاوله لاحقا'];
    }

    public function getDelete($slug)
    {
        $ad = Ad::where('slug',$slug)->first();
        $ad->active = 0;
        $ad->update();
        return back();
    }

    public function postDeleteImage($ad_id, $image_id)
    {
        $ad = Ad::find($ad_id);
        if (!$ad) {
            return back()->withWarning('ad not found', ['id' => $ad_id]);
        }
        $image = $ad->images()->find($image_id);
        // if no image found
        if (!$image) {
            return back()->withError('image not found', ['id' => $image_id]);
        }
        // physical delete from hard desk
        $file_path = storage_path("uploads/banners/$image->image");
        if (is_file($file_path)) {
            @unlink($file_path);
        }

        $image->delete();

        return [
            'status' => true,
            'msg' => 'تم الحذف بنجاح'];
    }

    public function SearchResult()
    {
        $results = ResultsSearch::where('member_id',auth()->guard('members')->user()->id)->get();
        return view('site.pages.profile.search-result',compact('results'));
    }

    public function SearchResultDelete($id)
    {
        $result =ResultsSearch::destroy($id);
        if ($result == 1)
        {
            return redirect()->back()->with('msg','تم الحذف بنجاح');
        }
        return redirect()->back()->with('msg','لقد حدث خطا حاول مره اخرى');
    }

    /**
     * show-notifications
     */
    public function showNotification()
    {
        $notifications = Notification::Orderby('id' ,'ASC')->get();
        return view('site.pages.profile.template.show-notifications',compact('notifications'))->render();
    }

    public function getAllNotification()
    {
        $notifications = Notification::where('member_id',auth()->guard('members')->id())->where('type',0)->Orderby('id' ,'ASC')->get();
        return view('site.pages.profile.notification',compact('notifications'));
    }

    public function getSingleNotification(Request $request, $id)
    {
        $notification = Notification::where('id' ,$id)->first();
        $notifications = NotificationsContent::where('massage_id',$notification->id)->orderBy('id','ASC')->get();
        if ($request->ajax())
        {
            return view('site.pages.profile.template.only-notifications' ,compact('notifications'))->render();
        }
        return view('site.pages.profile.only-notification' ,compact('notifications'));
    }

    public function postSendNotification(Request $request)
    {
        if ($request->message == null)
        {
            return ['status' => 'error' ,'msg' => 'من فضلك ادخل محتوى الرساله'];
        }
        $notification = Notification::find($request->massage_id);
        $notification->update(['seen'=>0,'type'=>1]);
        $message = new NotificationsContent();
        $message->massage_id = $request->massage_id;
        $message->sender_id = auth()->guard('members')->id();
        $message->receiver_id = 0;
        $message->massage = $request->message;
        if ($message->save())
        {
            return ['status' => 'success'];
        }
        return ['status' => 'error' ,'msg' => 'لقد حدث خطا يرجى المحاوله مره اخر'];
    }
}
