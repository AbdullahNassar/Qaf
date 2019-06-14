<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\City;

class CountryController extends Controller {

    //
    public function getCountry() {
        $countries = Country::get();

        return view('admin.pages.country.index', compact('countries'));
    }

    public function getCity($id) {
        $cities = City::where('country_id', $id)->get();

        return view('admin.pages.city.index', compact('cities'));
    }

    public function postIndex(Request $request) {
        $v = validator($request->all(), [
            'country_name' => 'required',
            'city_name' => 'required'
                ], [
            'country_name.required' => 'برجاء ادخال اسم الدوله',
            'city_name.required' => 'برجاء ادخال اسم المدينه'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $country = new Country();

        $country->name = $request->country_name;

        if ($country->save()) {
            foreach ($request->city_name as $city) {
                $country->city()->create([
                    'name' => $city
                ]);
            }


            return ['status' => 'success', 'data' => 'تم اضافه الدوله بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء اضافه البيانات'];
    }

    public function postEditCountry(Request $request, $id) {
//        dd($requrest->name);
        $v = validator($request->all(), [
            'name' => 'required',
                ], [
            'name.required' => 'برجاء ادخال اسم الدوله'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $country = Country::find($id);


        $country->name = $request->name;

        if ($country->save()) {

            return ['status' => 'success', 'data' => 'تم تعديل الدوله بنجاح'];
        }

        return ['status' => false, 'data' => 'لقد حدث خطا اثناء تحديث البيانات'];
    }

    public function postEditCity(Request $request, $id) {
        $v = validator($request->all(), [
            'name' => 'required',
                ], [
            'name.required' => 'برجاء ادخال اسم المدينه'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $city = City::find($id);

        $city->name = $request->name;

        if ($city->save()) {
            return ['status' => 'success', 'data' => 'تم تعديل المدينه بنجاح'];
        }

        return ['status' => false, 'data' => 'خطا اثناء تخديث البيانات'];
    }

    public function getDeleteCountry($id = null) {
        $country = Country::find($id);

        $country->city()->delete();
        $country->delete();

        return redirect()->back();
    }

    public function getDeleteCity($id = null) {
        $city = City::find($id);

        $city->delete();

        return redirect()->back();
    }

    public function postAddCity(Request $request){
        $v = validator($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'برجاء ادخال اسم الدوله'
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $city = new City();

        $city->name = $request->name;
        $city->country_id = $request->country_id;

        if ($city->save()) {
            return ['status' => 'success', 'data' => 'تم اضافه المدينه بنجاح'];
        }

        return ['status' => false, 'data' => 'خطا اثناء اضافه البيانات'];
    }
}
