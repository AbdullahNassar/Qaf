<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    public function ads()
    {
        return $this->belongsTo('App\Ad' ,'ad_id');
    }

    public function member()
    {
        return $this->belongsTo('App\Member' ,'member_id');
    }
}
