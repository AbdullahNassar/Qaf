<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    //
    protected $table = 'countries';
    protected $fillable = ['name'];

    public function city() {
        return $this->hasMany('App\City', 'country_id');
    }

}
