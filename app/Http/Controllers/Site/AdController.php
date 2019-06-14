<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\City;
use App\Conversation;
use App\Message;
use App\MessagesContent;
use App\Report;
use App\Review;
use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ad;
use App\Wishlist;
use Auth;

class AdController extends Controller
{
    //show the ad
    public function getIndex($slug)
    {
        $ad = Ad::where('slug' ,$slug)->first();
        $ads = $ad->type->ads->take(5);
        $allConversations = Conversation::where('ad_id' ,$ad->id)->paginate(5);
        $reviews = Review::where('ad_id' ,$ad->id)->paginate(5);
        $sum = Review::where('ad_id' ,$ad->id)->sum('rate');
        if (sizeof($reviews) > 0){
            $totalReview = $sum/count($reviews);
        }else{
            $totalReview = 0;
        }
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
            $ad->visits +=1;
            $ad->save();
        }
//        dd($conversations);
        return view('site.pages.ads.index' ,compact('ad' ,'ads' ,'allConversations','reviews','totalReview'));
    }

    //add the ad to wishlist
    public function postWishlist(Request $request)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $itemId = Wishlist::where('ad_id' ,$request->ad_id)->where('member_id' ,Auth::guard('members')->user()->id)->value('id');
        if(sizeof($itemId) > 0){
            Wishlist::where('ad_id' ,$request->ad_id)->where('member_id' ,Auth::guard('members')->user()->id)->delete();

            return ['response' => 'error' ,'msg' => 'تم حذف الاعلان من قائمه المفضله بنجاح'];
        }else{
            $wishlist = new Wishlist();

            $wishlist->ad_id = $request->ad_id ;
            $wishlist->member_id = Auth::guard('members')->user()->id ;

            if($wishlist->save()){
                $count = Wishlist::where('member_id' ,Auth::guard('members')->user()->id)->count();
                return ['response' => 'success' ,'msg' => 'تمت اضافه الاعلان الي قائمه المفضله'];
            }
            return ['response' => 'error' ,'msg' => 'خطا اثناء اضافه الاعلان لقائمه المفضله'];
        }
    }

    //contact user to ask about the Ad
    public function postContactFounder(Request $request ,$slug)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $v = validator($request->all() ,[
            'message' => 'required'
        ] ,[
            'message.required' => 'برجاء ادخال موضوع رسالتك'
        ]);

        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
        }
        $ad =Ad::where('slug' , $slug)->first();
        $message = Message::where('receiver_id',$ad->user_id)->where('member_id',auth()->guard('members')->user()->id)->where('ad_id',$ad->id)->first();
        if (!$message)
        {
            $message = new Message();
            $message->message = $request->message;
            $message->receiver_id = $ad->user_id;
            $message->member_id = auth()->guard('members')->user()->id;
            $message->ad_id = $ad->id;
            $message->save();
        }
        $message_content = new MessagesContent();
        $message_content->sender_id =$message->member_id ;
        $message_content->receiver_id =$message->receiver_id;
        $message_content->massage =$request->message;
        $message_content->massage_id =$message->id;
        if ($message_content->save())
        {
            return ['status' => 'success' ,'msg' => 'تم ارسال رسالتك بنجاح'];
        }
        return ['status' => 'error' ,'msg' => 'برجاء اعاده ارسال رسالتك مره اخري'];
    }

    // Conversation form
    public function postConversation(Request $request ,$slug)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $v = validator($request->all() ,[
            'content' => 'required'
        ] ,[
            'content.required' => 'برجاء ادخال رايك'
        ]);

        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br >" ,$v->errors()->all())];
        }


        $conversation = new Conversation();

        $conversation->content = $request->content;
        $conversation->member_id = auth()->guard('members')->user()->id;
        $conversation->ad_id = Ad::where('slug' , $slug)->value('id');

        if ($conversation->save()){
            $allConversations = Conversation::where('ad_id',Ad::where('slug' ,$slug)->value('id'))->paginate(5);
//            dd($allConversations);
            return [
                'status' => 'success',
                'msg' => 'تم اضافه رايك بنجاح',
                'html' => view('site.pages.ads.templates.discussion',compact('allConversations'))->render()
            ];
        }

        return [
            'status' => 'error' ,
            'msg' => 'حدث خطا اثناء اضافه رايك في المحادثه برجاء اعاده المحاوله مره اخري'
        ];
    }


    // Add review to the add
    public function postReview(Request $request ,$slug)
    {
        if(!auth()->guard('members')->check()){
            return ['status' => 'warning' ,'msg' => 'برجاء تسجيل الدخول اولا'];
        }

        $v = validator($request->all(),[
            'comment' => 'required'
        ],[
            'comment.required' => 'برجاء ادخال تعليقك علي هذا الاعلان'
        ]);

        if($v->fails()){
            return ['status' => 'warning' ,'msg' => implode("<br>" ,$v->errors()->all())];
        }
        $oldReview = Review::where('ad_id' ,Ad::where('slug' , $slug)->value('id'))->where('member_id' ,auth()->guard('members')->user()->id)->count();
        if($oldReview > 0){
            $review = Review::where('ad_id' ,Ad::where('slug' , $slug)->value('id'))->where('member_id' ,auth()->guard('members')->user()->id)->first();

            $review->comment = $request->comment;
            $review->rate = $request->rate;
            $review->ad_id = Ad::where('slug' , $slug)->value('id');
            $review->member_id = auth()->guard('members')->user()->id;

            if($review->save()){
                $reviews = Review::where('ad_id' ,Ad::where('slug' ,$slug)->value('id'))->paginate(5);
                return [
                    'status' => 'success',
                    'msg' => 'تم تعديل تقييمك بنجاح',
                    'html' => view('site.pages.ads.templates.review',compact('reviews'))->render()
                ];
            }
        }else{
            $review = new Review();

            $review->comment = $request->comment;
            $review->rate = $request->rate;
            $review->ad_id = Ad::where('slug' , $slug)->value('id');
            $review->member_id = auth()->guard('members')->user()->id;

            if($review->save()){
                $reviews = Review::where('ad_id' ,Ad::where('slug' ,$slug)->value('id'))->paginate(5);
                return [
                    'status' => 'success',
                    'msg' => 'تم اضافه تقييمك بنجاح',
                    'html' => view('site.pages.ads.templates.review',compact('reviews'))->render()
                ];
            }
        }

        return [
            'status' => 'error' ,
            'msg' => 'حدث خطا اثناء اضافه تقييمك في المحادثه برجاء اعاده المحاوله مره اخري'
        ];
    }

    //report the ad
    public function postReportAd(Request $request , $slug)
    {
//        dd($request->all());
        $v = validator($request->all() ,[
            'report_type' => 'required',
            'report' => 'required'
        ] ,[
            'report_type.required' => 'برجاء اختيار سبب ابلاغك عن هذا الاعلان',
            'report.required' => 'برجاء ابلاغنا سبب ابلاغك عن هذا الاعلان'
        ]);

        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br>" ,$v->errors()->all())];
        }

        $report = new Report();

        $report->report = $request->report;
        $report->report_type = $request->report_type;
        $report->ad_id = Ad::where('slug' , $slug)->value('id');

        if($report->save()){
            return ['status' => 'success' ,'msg' => 'تم الابلاغ عن الاعلان وجاري مراجعته من قبل الادمن'];
        }

        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء اضافه بلاغك برجاء الحاوله لاحقا'];
    }

    // Add Ad

    public function getAdd(Request $request)
    {
        if ($request->ajax()){
            if ($request->type == 'type')
            {
                return response()->json(['data'=>'done','type'=>2]);
            }
            $main_cat = Category::find($request->id);
            if ($main_cat->subCategories && count($main_cat->subCategories)>0)
            {
                $results =$main_cat->subCategories;
                $name ='category_id';
                $data = view('site.pages.ads.templates.choose-cat',compact('results','name'))->render();
                return response()->json(['data'=>$data,'type'=>0]);
            }
            $results =$main_cat->types;
            $name ='type_id';
            $data = view('site.pages.ads.templates.choose-cat',compact('results','name'))->render();
            return response()->json(['data'=>$data,'type'=>1]);
        }
        $main_cats = Category::where('parent_id',0)->get();
        $cities = City::all();
        return view('site.pages.ads.add',compact('main_cats','cities'));
    }

//add files to dropzone
    public function dropzoneStore(Request $request)
    {
        $destination = storage_path('uploads/banners/');
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move($destination, $imageName);
        return response()->json(['success' => $imageName]);
    }

    //delete image from dropzone
    public function dropzoneDelete(Request $request)
    {
        unlink(storage_path('uploads/banners/' . $request->name));
        return response()->json(['name' => $request->name]);
    }

    public function postAdd(Request $request)
    {
        $v =validator($request->all(),[
            'type_id'=>'required',
            'name'=>'required',
            'description'=>'required',
            'keywords'=>'required',
            'price'=>'required',
            'used'=>'required',
            'image'=>'array',
            'image.*'=>'required',
        ],[
            'type_id.required'=>'من فضلك اختر المودل',
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
        $ad = new Ad();
        $ad->type_id=$request->type_id;
        $ad->name=$request->name;
        $ad->slug=str_slug($request->name);
        $ad->description=$request->description;
        $ad->keywords=$request->keywords;
        $ad->price=$request->price;
        $ad->user_id=auth()->guard('members')->user()->id;
        $ad->used=$request->used;
        $ad->active=0;
        $ad->visits=0;
        if ($ad->save())
        {
            // store the product images
            if($request->image){
                foreach ($request->image as $img) {
                    $ad->images()->create([
                        'image' => $img
                    ]);
                }
            }

            $ad->places()->attach($request->cities);

            return ['status' => 'success' ,'msg' => 'تم اضافه الاعلان بنجاح'];
        }
        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء اضافه بلاغك برجاء الحاوله لاحقا'];

    }
}