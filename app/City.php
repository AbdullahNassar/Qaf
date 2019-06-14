<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    //
    protected $table = 'cities';
    protected $fillable = ['name'];

    public function country() {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function ads(){
        return $this->belongsToMany('App\Ad','ad_places');
    }

}
