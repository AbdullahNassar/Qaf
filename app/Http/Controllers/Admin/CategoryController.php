<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
    * Render Categories Page
    * @return View
    */
    public function getIndex(){
        $categories = Category::orderby('id' ,'ASC')->paginate(15);
        return view('admin.pages.categories.index' , compact('categories'));
    }

    /**
    * Fetch Information about some category
    * @param  number $id [description]
    * @return json     [description]
    */
    public function postInfo($id) {

        $category = Category::find($id);

        if(!$category){
            return [
                'status' => 'error',
                'title' => 'فشل',
                'msg' => 'لا يوجد بيانات لهذا القسم',
            ];
        }

        return [
            'modal' => true,
            'html' => view('admin.pages.categories.modals.edit',
            compact('category'))->render(),
        ];

    }

    public function postAddMain(Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'icon' => 'required',
        ],[],
        [
            'name' => 'اسم القسم',
            'icon' => 'الايقونة',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => implode('<br>', $v->errors()->all()),
            ];
        }

        //get new category
        $category = new Category;

        $category->name = $request->name;
        $category->parent_id = 0;
        $category->icon = $request->icon;
        $category->slug = $this->generateSlug($request->name);

        if($category->save()){
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم اضافة القسم بنجاح.',
            ];
        }

    }

    public function postAddSub(Request $request) {

        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'parent_id' => 'required|integer|exists:categories,id',
            'icon' => 'required',
        ],[],
        [
            'name' => 'اسم القسم',
            'icon' => 'الايقونة',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => implode('<br>', $v->errors()->all()),
            ];
        }

        //get new category
        $category = new Category;

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->icon = $request->icon;
        $category->slug = $this->generateSlug($request->name);

        if($category->save()){
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم اضافة القسم بنجاح.',
            ];
        }

    }

    public function postEdit($id, Request $request) {

        $category = Category::find($id);

        if (!$category) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => "لا يوجد قسم بهذا الاسم.",
            ];
        }

        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'parent_id' => 'integer|exists:categories,id' . ($category->isSub()? '|required' : ''),
            'icon' => 'required',
        ],[],
        [
            'name' => 'اسم القسم',
            'icon' => 'الايقونة',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => implode('<br>', $v->errors()->all()),
            ];
        }

        $category->name = $request->name;
        $category->icon = $request->icon;
        if ($category->isSub()) {
            $category->parent_id = $request->parent_id;
        }

        if($category->save()){
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم تعديل القسم بنجاح.',
            ];
        }

    }


    protected function generateSlug($title)
    {
        $slug = $temp = slugify($title);
        while(Category::where('slug',$slug)->first()){
            $slug = $temp ."-". rand(1,1000);
        }
        return $slug;
    }

    public function getDelete($id) {

        $category = Category::find($id);

        if (!$category) {
            return back()->withError('لا يوجد قسم يطابق هذه البيانات ليتم حذفه.');
        }

        $category->trash();

        return back()->withSuccess('تمت عمليه الحذف بنجاح.');
    }
}
