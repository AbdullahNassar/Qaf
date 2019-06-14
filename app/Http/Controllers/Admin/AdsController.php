<?php

namespace App\Http\Controllers\Admin;

use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ad;

class AdsController extends Controller
{
    //
    public function getIndex()
    {
        $ads = Ad::paginate(20);

        return view('admin.pages.ads.index' ,compact('ads'));
    }

    public function postActive(Request $request)
    {
        $ad = Ad::where('id' ,$request->id)->first();

//        dd($request->active);
        if($request->active == 1){
            $ad->update(['active' => 1]);

            return ['status' => 'success'];
        }elseif ($request->active == 0){
            $ad->update(['active' => 0]);

            return ['status' => 'success'];
        }else{
            $ad->update(['active' => -1]);

            return ['status' => 'success'];
        }
    }

    public function getDelete($id)
    {
        $ad = Ad::find($id);

        $ad->images()->delete();
        $ad->places()->delete();
        $ad->delete();

        return redirect()->back();
    }

    public function getReports($id)
    {
        $reports = Report::where('ad_id' ,$id)->get();

        return view('admin.pages.ads.reports' ,compact('reports'));
    }

    public function getDeleteReport($id){
        $report = Report::find($id);

        $report->delete();

        return redirect()->back();
    }
}
