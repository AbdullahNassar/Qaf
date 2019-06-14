<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category' ,'category_id');
    }

    public function ads(){
        return $this->hasMany('App\Ad' ,'type_id');
    }
}
