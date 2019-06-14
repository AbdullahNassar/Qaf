<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
    protected $fillable = ['active'];

    protected $table = "ads";

    public function images(){
        return $this->hasMany('App\AdImage','ad_id');
    }

    public function places(){
        return $this->belongsToMany('App\City','ad_places');
    }

    public function user(){
        return $this->belongsTo('App\Member' ,'user_id');
    }

    public function type(){
        return $this->belongsTo('App\Type' ,'type_id');
    }

    public function MainCategory(){
        $category = \App\Category::where('id' , \App\Type::where('id' ,$this->type_id)->value('category_id'))->first();
        // dd($category);
        return $category;
    }

    public function conversations(){
        return $this->hasMany('App\Conversation' ,'ad_id');
    }

    public function reviews(){
        return $this->hasMany('App\Review' ,'ad_id');
    }

    public function reports(){
        return $this->hasMany('App\Report' ,'ad_id');
    }
}
