<?php

namespace App\Http\Controllers\Site;

use App\Ad;
use App\AdPlace;
use App\City;
use App\ResultsSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;

class HomeController extends Controller
{
    //
    public function getIndex(){
        $ads = Ad::where('active' , 1)->get();
        $cities = City::all();
        return view('site.pages.home' ,compact('ads','cities'));
    }

    //subscribe form
    public function postSubscribe(Request $request)
    {

        //validate the request
        $v = validator($request->all() ,[
            'email' => 'required|email|unique:subscribers'
        ] ,[
            'email.required' => 'برجاء ادخال البريد الالكتروني',
            'email.email' => 'برجاء ادخال بريد الكتروني صحيح',
            'email.unique' => 'تم ادخال البريد الاكتروني مسبقا'
        ]);

        if($v->fails()){
            return ['status' => 'error' ,'msg' => implode("<br>" ,$v->errors()->all())];
        }

        $subscriber = new Subscriber();

        $subscriber->email = $request->email;

        if($subscriber->save()){
            return ['status' => 'success' ,'msg' => 'تم ادخال البريد الالكتروني بنجاح'];
        }

        return ['status' => 'error' ,'msg' => 'حدث خطا اثناء اضافه البريد الالكتروني'];
    }

    public function getSearch(Request $request)
    {
        $type = $request->used;
        $type_id = $request->type_id;
        $city_id = $request->city_id;
        $search = $request->search;
        $first_limit = floatval(str_replace('$', '', $request->first_limit));
        $last_limit = floatval(str_replace('$', '', $request->last_limit));

        $all = Ad::latest();

        if (!empty($search)){
            $all->where('name' ,'like' ,'%'.$search.'%');
        }

        if(!empty($first_limit)){
            $all->where('price','>=', $first_limit);
        }

        if(!empty($last_limit)){
            $all->where('price','<=', $last_limit);
        }

        if(!empty($type)){
            $all->where('used' ,$type);
        }

        if (!empty($type_id)){
            $all->where('type_id' ,$type_id);
        }

        $all = $all->get();

        if (!empty($city_id)){
            $all = $all->filter(function ($ad) use ($city_id){

                return in_array($city_id, $ad->places->pluck('id')->toArray());
            });
        }


        $ads = paginate($all, 9);

        return view('site.pages.global-search',compact('ads'));

    }

    // Save Search Result
    public function saveSearch(Request $request)
    {
        $url =$request->url;
        $member_id =auth()->guard('members')->user()->id;
        $result = ResultsSearch::where('search_url',$url)->where('member_id',$member_id)->first();
        if (!$result)
        {
            ResultsSearch::create([
                'member_id'=>$member_id,
                'search_url'=>$url,
            ]);
            return ['response' => 'success' ,'msg' => 'تمت اضافه نتائج البحث بنجاح'];
        }
        return ['response' => 'error' ,'msg' => 'تم حفظها مسبقا'];
    }
}
