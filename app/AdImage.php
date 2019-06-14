<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    //
    protected $table = "ad_images";

    protected $fillable = ['image'];

    public function ad(){
        return $this->belongsTo('App\Ad','ad_id');
    }
}
