<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller {

    //
    public function getIndex() {
        $admins = Admin::get();
        return view('admin.pages.admin.index', compact('admins'));
    }

    public function getEdit($id) {
        $admin = Admin::find($id);

        return view('admin.pages.admin.edit', compact('admin'));
    }

    public function postIndex(Request $request) {
        $v = validator($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'email' => 'required|unique:admins|email',
            'phone' => 'required|min:10',
            'address' => 'required|min:5',
            'password' => 'required|min:6',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:20000'
                ], [
            'name.required' => 'برجاء ادخال اسم المستخدم',
            'name.min' => 'اسم المستخدم يجب الا يقل عن 3 حروف',
            'username.required' => 'برجاء ادخال الاسم الظاهر',
            'username.min' => 'الاسم الظاهر يجب الا يقل عن 3 حروف',
            'email.required' => 'برجاء ادخال البريد الالكتروني الخاص بالمستخدم',
            'email.unique' => 'البريد الالكتروني يجب ان يكون مميز ولا يتكرر',
            'email.email' => 'يجب ادخال بريد الكتروني لا شئ اخر',
            'phone.required' => 'برجاء ادخال رقم الهاتف',
            'phone.min' => 'رقم الهاتف يجب الا يقل عن 10 ارقام',
            'address.required' => 'برجاء ادخال عنوان المستخدم',
            'address.min' => 'عنوان المستخدم يجب الا يقل عن 5 حروف',
            'image.requried' => 'برجاء ادخال صوره المستخدم',
            'image.mimes' => 'نوع الصوره يجب ان يكون : jpeg,jpg,png,gif',
            'image.max' => 'يجب الا يزيد حجم الصوره عن 20 ميجا بايت',
            'password.required' => 'برجاء ادخال الرقم السري',
            'password.min' => 'الرقم السري يجب الا يقل عن 6 ارقام'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $admin = new Admin();

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->password = bcrypt($request->password);

        $destination = storage_path('uploads/admins');

        $admin->image = $request->image->getClientOriginalName();
        $request->image->move($destination, $admin->image);

        if ($admin->save()) {
            return ['status' => 'success', 'data' => 'تم ادخال مستخدم جديد بنجاح'];
        }

        return ['status' => false, 'data' => 'حدث خطا اثناء ادخال بيانات المستخدم'];
    }

    public function postEdit(Request $request, $id) {
        $v = validator($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'email' => 'required|unique:admins,email,' . $id . '|email',
            'phone' => 'required|min:10',
            'address' => 'required|min:5',
                ], [
            'name.required' => 'برجاء ادخال اسم المستخدم',
            'name.min' => 'اسم المستخدم يجب الا يقل عن 3 حروف',
            'username.required' => 'برجاء ادخال الاسم الظاهر',
            'username.min' => 'الاسم الظاهر يجب الا يقل عن 3 حروف',
            'email.required' => 'برجاء ادخال البريد الالكتروني الخاص بالمستخدم',
            'email.unique' => 'البريد الالكتروني يجب ان يكون مميز ولا يتكرر',
            'email.email' => 'يجب ادخال بريد الكتروني لا شئ اخر',
            'phone.required' => 'برجاء ادخال رقم الهاتف',
            'phone.min' => 'رقم الهاتف يجب الا يقل عن 10 ارقام',
            'address.required' => 'برجاء ادخال عنوان المستخدم',
            'address.min' => 'عنوان المستخدم يجب الا يقل عن 5 حروف',
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $admin = Admin::find($id);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }

        $destination = storage_path('uploads/admins');
        if ($request->image) {
            @unlink($destination . "/{$admin->image}");
            $admin->image = $request->image->getClientOriginalName();
            $request->image->move($destination, $admin->image);
        }

        if ($admin->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث بيانات المستخدم'];
        }
        return ['status' => false, 'data' => 'حدث خطا اثناء تحديث بيانات المستخدم'];
    }

    public function getDelete($id = null) {
        $admin = Admin::find($id);

        $admin->delete();

        return redirect()->back();
    }

}
