<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function getIndex() {
        return view('admin.pages.about.index');
    }

    public function getSection($flug){
        $about = About::where('flug',$flug)->first();
        return view('admin.pages.about.showSec',compact('about'));
    }

    public function postUpdate(Request $request){
        $about= About::where('flug',$request->flug)->first();
        $about->content = $request->desc1;

        if ($request->image){
            $destination = storage_path('uploads/about/');
            @unlink($destination . $about->image);
//            dd(5555);
            $about->image = str_replace(' ','-',$request->image->getClientOriginalName());
            $request->image->move($destination, $about->image);
        }
        if ($about->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث البيانات بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }
}
