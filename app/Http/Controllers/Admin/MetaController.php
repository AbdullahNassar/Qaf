<?php

namespace App\Http\Controllers\Admin;

use App\Meta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaController extends Controller
{
    public function getIndex(){
        $metas = Meta::all();
        return view('admin.pages.meta.index',compact('metas'));
    }

    public function postIndex(Request $request){
        $v = validator($request->all(),[
            'name'=>'required|min:3',
            'value'=>'required|min:3'
        ],[
            'name.required' => 'برجاء ادخال الاسم',
            'name.min' => 'الاسم يجب الا يقل عن 3 حروف',
            'value.required' => 'برجاء ادخال المحتوى',
            'value.min' => 'المحتوى يجب الا يقل عن 3 حروف',
        ]);

        if ($v->fails()){
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $meta = new Meta();
        $meta->name = $request->name;
        $meta->value = $request->value;
        if ($meta->save()){
            return ['status' => 'success', 'data' => 'تم اضافه البيانات  بنجاح'];
        }
        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }

    public function getEdit($id){
        $meta=Meta::find($id);
        return view('admin.pages.meta.edit',compact('meta'));
    }

    public function postUpdate(Request $request){
        $meta =Meta::find($request->id);
        $meta->name = $request->name;
        $meta->value = $request->value;
        if ($meta->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث البيانات بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }

    public function getDelete($id){
        Meta::destroy($id);
        return redirect()->back()->with('msg','تم حذف البيانات بنجاح');
    }
}
