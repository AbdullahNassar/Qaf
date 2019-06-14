<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function ad(){
        return $this->belongsTo('App\Ad' ,'ad_id');
    }

    public function member(){
        return $this->belongsTo('App\Member' ,'member_id');
    }
}
