<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendingEmail;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller {

    public function getIndex() {
        $subscribers = Subscriber::all();
        return view('admin.pages.subscriber.index', compact('subscribers'));
    }

    public function postIndex(Request $request) {
        $v = validator($request->all(), [
            'title' => 'required|min:3',
            'email' => 'required'
                ], [
            'title.required' => 'من فضلك ادخل الموضوع',
            'title.min' => 'يجب ان يكون محتوى الموضوع اكثر من 3 حروف',
            'email.required' => 'من فضلك اختر البريد الالكترونى',
        ]);
        if ($v->fails()) {
            return ['status' => false, 'data' => implode("\n", $v->errors()->all())];
        }
        foreach ($request->email as $e) {
            $email = Subscriber::find($e);
            Mail::to($email->email)->send(new SendingEmail($request->title, $request->messages));
        }
        return ['status' => true, 'data' => 'تم الارسال بنجاح'];
    }

}
