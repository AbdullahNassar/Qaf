<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdPlace extends Model
{
    //
    protected $table = "ad_places";

    public function ad()
    {
        return $this->belongsTo(Ad::class,'ad_id');
    }
}
