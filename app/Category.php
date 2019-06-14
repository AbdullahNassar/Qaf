<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

    public function isMain()
    {
        return $this->parent_id == 0;

    }

    public function getUrl()
    {

        return route('site.category.index',['slug'=> $this->slug]);

    }

    public function getProducts()
    {
        $products = $this->products;

        if(!$this->subCategories->isEmpty()){
            $this->subCategories->map(function($c) use (&$products){
                if(!$c->products->isEmpty()){
                    foreach ($c->products as $product) {
                        $products->push($product);
                    }
                }
            });
        }

        return $products;
    }

    public function isActive()
    {
        return (bool) $this->active;
    }

    public function isSub()
    {
        return !$this->isMain();
    }

    public function parent()
    {
        return $this->belongsTo('App\Category' ,'parent_id');
    }

    public function scopeMains($query)
    {
        return $query->where('parent_id', 0)->latest()->get();
    }

    public function scopeSubs($query)
    {
        return $query->where('parent_id','<>', 0)->latest()->get();
    }

    public function types()
    {
        return $this->hasMany('App\Type' ,'category_id');
    }

    public function subCategories()
    {
        return $this->hasMany('App\Category' ,'parent_id');
    }

    public function trash()
    {
        $this->types()->delete();
        $this->destroy($this->id);
    }

}
