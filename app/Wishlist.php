<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //
    public function ad(){
        return $this->belongsTo(Ad::class ,'ad_id');
    }
}
