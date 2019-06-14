<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SMKFontAwesome\SMKFontAwesome;

class ContactUsController extends Controller
{
    public function getIndex(){
        $icons = SMKFontAwesome::getArray();
        $contacts = ContactUs::all();
        return view('admin.pages.contact-us.index',compact('icons','contacts'));
    }

    public function postIndex(Request $request){
        $v = validator($request->all(),[
            'title'=>'required|min:3',
            'content'=>'required|min:3'
        ],[
            'title.required' => 'برجاء ادخال العنوان',
            'title.min' => 'العنوان يجب الا يقل عن 3 حروف',
            'content.required' => 'برجاء ادخال المحتوى',
            'content.min' => 'المحتوى يجب الا يقل عن 3 حروف',
        ]);

        if ($v->fails()){
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $contact = new ContactUs();
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->icon = $request->icon;
        if ($contact->save()){
            return ['status' => 'success', 'data' => 'تم اضافه البيانات  بنجاح'];
        }
        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }

    public function getEdit($id){
        $contact=ContactUs::find($id);
        $icons = SMKFontAwesome::getArray();
        return view('admin.pages.contact-us.edit',compact('contact','icons'));
    }

    public function postUpdate(Request $request){
        $contact =ContactUs::find($request->id);
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->icon = $request->icon;
        if ($contact->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث البيانات بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }

    public function getDelete($id){
        ContactUs::destroy($id);
        return redirect()->back()->with('msg','تم حذف البيانات بنجاح');
    }
}
