<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use App\Category;

class TypeController extends Controller
{

    public function getIndex($id){
        $types = Type::where('category_id' ,$id)->get();
        $categories = Category::get();

        return view('admin.pages.categories.types.index' ,compact('types' ,'categories'));
    }

    public function postEdit(Request $request ,$id){
//        dd($request->all());
        $v = validator($request->all() ,[
            'name' => 'required',
            'category_id' => 'required'
        ] ,[
            'name.required' => 'برجاء ادخال اسم النوع ',
            'category_id.required' => 'برجاء اختيار القسم'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $type = Type::find($id);

        $type->name = $request->name;
        $type->slug = str_slug($request->name);
        $type->category_id = $request->category_id;

        if($type->save()){
            return ['status' => 'success' ,'data' => 'تم تحديث بيانات النوع بنجاح'];
        }

        return ['status' => false ,'data' => 'لقد حدث خطا اثناء تعديل بيانات النوع'];
    }

    public function postIndex(Request $request){
        $v = validator($request->all() ,[
            'name' => 'required',
            'category_id' => 'required'
        ] ,[
            'name.required' => 'برجاء ادخال اسم النوع ',
            'category_id.required' => 'برجاء اختيار القسم'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $type = new Type();

        $type->name = $request->name;
        $type->slug = str_slug($request->name);
        $type->category_id = $request->category_id;

        if($type->save()){
            return ['status' => 'success' ,'data' => 'تم اضافه بيانات النوع بنجاح'];
        }

        return ['status' => false ,'data' => 'لقد حدث خطا اثناء اضافه بيانات النوع'];
    }

    public function getDelete($id = null){
        $type = Type::find($id);

        $type->delete();

        return redirect()->back();
    }
}
