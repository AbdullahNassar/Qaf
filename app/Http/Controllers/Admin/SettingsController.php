<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

class SettingsController extends Controller {

    //
    public function getIndex() {
        return view('admin.pages.settings.index');
    }

    public function postIndex(Request $request) {
        $v = validator($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'google' => 'required',
            'youtube' => 'required',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:20000',
                ], [
            'name.required' => 'برجاء ادخال اسم الموقع',
            'description.required' => 'برجاء ادخال شرح مختصر للموقع',
            'email.required' => 'برجاء ادخال البريد الالكتروني الخاص بالموقع',
            'address.required' => 'برجاء ادخال العنوان الخاص بالشركه',
            'phone.required' => 'برجاء ادخال رقم الهاتف الخاص بالشركه',
            'facebook.required' => 'برجاء ادخال رابط صفحه الفيسبوك',
            'twitter.required' => 'برجاء ادخال رابط صفحه تويتر',
            'google.required' => 'برجاء ادخال رابط حساب جوجل بلس',
            'youtube.required' => 'برجاء ادخال رابط القناه الخاصه بالشركه في اليوتيوب',
            'logo.requried' => 'برجاء ادخال لوجو الموقع',
            'logo.mimes' => 'نوع الصوره يجب ان يكون : jpeg,jpg,png,gif',
            'logo.max' => 'يجب الا يزيد حجم الصوره عن 20 ميجا بايت'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $settings = Settings::first();

        $settings->name = $request->name;
        $settings->description = $request->description;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->phone = $request->phone;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->google = $request->google;
        $settings->youtube = $request->youtube;


        $destination = storage_path('uploads/logo');
//        dd($request->logo);
        if ($request->logo) {
            @unlink($destination . "/{$settings->logo}");
            $settings->logo = $request->logo->getClientOriginalName();
            $request->logo->move($destination, $settings->logo);
        }

        if ($settings->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث بيانات الموقع بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تعديل بيانات الموقع'];
    }

}
