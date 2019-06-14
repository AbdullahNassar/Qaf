<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'f_name',
        'l_name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'image',
        'code',
        'confirm',
        'active',
        'visits',
        'package_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //messages functions

    public function allMessages(){
        $all = \App\Message::where('receiver_id' , $this->id)->orWhere('member_id' , $this->id)->get();

        return $all;
    }

    public function receivedMessages(){
        $received = \App\Message::where('receiver_id' , $this->id)->get();

        return $received;
    }

    public function newMessages(){
        $received = \App\Message::where('receiver_id' , $this->id)->where('seen' ,'0')->get();

        return $received;
    }

    public function sentMessage(){
        $sent = \App\Message::where('member_id' , $this->id)->get();

        return $sent;
    }



    ///////////////////////////////

    public function country(){
        return $this->belongsTo('App\Country' ,'country_id');
    }

    public function countWishlist(){
        $count = \App\Wishlist::where('member_id' ,$this->id)->get();

        return $count;
    }

    public function followers(){
        $count = \App\Follower::where('followed_id' ,$this->id)->get();

        return $count;
    }


    //ads function
    public function allAds(){
        $ads = \App\Ad::where('user_id' ,$this->id)->get();

        return $ads;
    }

    public function underReview(){
        $ad = \App\Ad::where('user_id' ,$this->id)->where('active' ,0)->get();

        return $ad;
    }

    public function cancelledAd(){
        $ad = \App\Ad::where('user_id' ,$this->id)->where('active' , -1)->get();

        return $ad;
    }

    public function activeAds(){
        $ad = \App\Ad::where('user_id' ,$this->id)->where('active' , 1)->get();

        return $ad;
    }
}    
