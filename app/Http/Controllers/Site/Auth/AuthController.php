<?php

namespace App\Http\Controllers\Site\Auth;

use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest.site', ['except' => ['logout','getConfirm']]);
    }

    public function getLogin()
    {
        return view('site.pages.auth.login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if ($user=Member::where('username',$username)->orWhere('phone',$username)->orWhere('email',$username)->first())
        {
            if (Hash::check($password,$user->password))
            {
                if ($user->active == -1)
                {
                    return ['response'=>'error','message'=>'تم اغلاق حسابك لحين اشعار اخر!!'];
                }
                if ($user->active == 0)
                {
                    return ['response'=>'error','message'=>'تم انشاء حسابك بنجاح بانتظار موافقه الادمن !!'];
                }
                if ($user->confirm == 0){
                    return ['response'=>'success', 'message'=>'يتم الان تحويلك لصفحه تفعيل الحساب','url' => route('site.confirm',['username'=>$user->username])];
                }else{
                    auth()->guard('members')->login($user,$request->remember);
                    return ['response'=>'success','message'=>'تم التسجيل بنجاح'];
                }
            }else{
                return ['response'=>'error','message'=>'كلمه المرور خظأ'];
            }
        }
        return ['response'=>'error','message'=>'المستخدم غير موجود'];
    }

    public function getRegister()
    {
        return view('site.pages.auth.register');
    }

    public function postRegister(Request $request)
    {
        $v = validator($request->all(),[
            'phone'=>'required|unique:members,phone'
        ],[
            'phone.required'=>'من فضلك ادخل رقم الهاتف ',
            'phone.unique'=>'رقم الهاتف موجود مسبقا',
        ]);
        if ($v->fails())
        {
            return ['response'=>'error','message'=>implode("\n",$v->errors()->all())];
        }
        $code ='';
        for ($i=0;$i<5;$i++)
        {
            $code.=mt_rand(0,9);
        }
        $member = new  Member();
        $member->phone = $request->phone;
        $member->username = $request->phone;
        $member->password = bcrypt($request->phone);
        $member->country_id = $request->country_id;
        $member->code = $code;
        $member->confirm = 0;
        if ($member->save())
        {
            Mail::send('site.mails.confirm-phone',['code'=>$code],function ($m) use ($member){
                $m->to('m@m.com','mahmoud')->subject('Confirm Your Number');
            });
            return ['response'=>'success','message'=>'تم التسجيل بنجاح', 'url' => route('site.confirm',['username'=>$member->username])];
        }
        return ['response'=>'error'];
    }
    public function logout()
    {
        auth()->guard('members')->logout();
        return redirect('/auth');
    }
    public function getResetPassword()
    {
        return view('site.pages.auth.reset-password');
    }
    public function postResetPassword(Request $request)
    {
        $v =  validator($request->all(), [
            'email' => 'required',
        ],[
            'email.required' => "من فضلك ادخل البريد الالكترونى او رقم التلفون",
        ]);
        if ($v->fails()){
            return ['response'=>'error','message'=>implode("\n",$v->errors()->all())];
        }

        $member = Member::where('email',$request->email)->orWhere('phone',$request->email)->first();
        if (!$member)
        {
            return ['response'=>'error','message'=>'المستخدم غير موجود'];
        }
        if ($member->active == -1)
        {
            return ['response'=>'error','message'=>'تم اغلاق حسابك لحين اشعار اخر!!'];
        }
        $hash = str_random(128);
        $member->recover_hash = json_encode([
            'hash'=>$hash,
            'expiry' => Carbon::now()->addDays(1)->timestamp,
        ]);
        $member->save();
        $recover_url = route('site.change-password', [
            'id' => $member->id,
            'hash' => hash('sha512', $hash),
        ]);
        Mail::send('site.mails.reset-password',['recover_url'=>$recover_url],function ($m) use ($member){
            $m->to($member->email?:"m@m.com",$member->username)->subject('Confirm Your Number');
        });
        return ['response'=>'success','message'=>'تم الارسال بنجاح بنجاح'];
    }

    public function getChangePassword($id,$hash)
    {
        $member = Member::find($id);
        if (!$member)
        {
            return redirect()->back();
        }
        $member->recover_hash = json_decode($member->recover_hash);
        if(!$member->recover_hash){
            return redirect(route('site.login'));
        }
        if(Carbon::now()->gt(Carbon::createFromTimestamp($member->recover_hash->expiry))) {
            return redirect(route('site.reset'))->with('error', 'لقد انتهت مده اللينك اطلب لينك اخر');
        }
        if(!hash_equals($hash,hash('sha512',$member->recover_hash->hash))){
            return redirect(route('site.login'))->with('error','رمز التفعيل خطأ . اطلب رمز غيره');
        }

        return  view('site.pages.auth.change-password', compact('member' , 'hash'));

    }
    public function postChangePassword(Request $request,$id,$hash)
    {
        $member = Member::find($id);
        if (!$member)
        {
            return redirect()->back();
        }
        $member->recover_hash = json_decode($member->recover_hash);
        if(!$member->recover_hash){
            return redirect(route('site.login'));
        }
        if(!hash_equals($hash,hash('sha512',$member->recover_hash->hash))){
            return redirect(route('site.login'))->with('error','رمز التفعيل خطأ . اطلب رمز غيره');
        }
        $member->password = bcrypt($request->input('password'));
        $member->recover_hash = null;

        $member->save();
        return ['response'=>'success', 'message'=>'تم تحديث كلمه المرور بنجاح','url' => route('site.login')];
    }
    public function getConfirm($username)
    {
        $user=Member::where('username',$username)->first();
//        dd($user);
        return view('site.pages.auth.confirm-phone')->with('user',$user);
    }
    public function postConfirm(Request $request)
    {
        $v = validator($request->all(),[
            'code'=>'required'
        ]);
        if ($v->fails())
        {
            return ['response'=>'error','message'=>'رقم التاكيد مطلوب'];
        }
        $user = Member::find($request->user_id);
        if ($request->code == $user->code){
            $user->update(['confirm'=>1]);
            auth()->guard('members')->login($user);
            return ['response'=>'success' ,'message'=>'تم تفعيل الحساب بنجاح','url' => route('site.home')];
        }
        return ['response'=>'error','message'=>'رقم التاكيد خطأ'];
    }
}
