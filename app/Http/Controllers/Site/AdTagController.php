<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ad;

class AdTagController extends Controller
{
    //
    public function getIndex($tag)
    {
        $ads = Ad::where('keywords' ,'like' ,'%'.$tag.'%')->paginate(5);

        return view('site.pages.ads.tag' ,compact('ads'));
    }
}
