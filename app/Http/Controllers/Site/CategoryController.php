<?php

namespace App\Http\Controllers\Site;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    //
    public function getIndex(Request $request ,$slug)
    {

        if ($slug == 'all'){
            return view('site.pages.category.all');
        }
        if ($request->ajax()){
            return $this->filterAds($request);
        }

        $category = Category::where('slug' ,$slug)->first();
        $allTypes = [];
        $ads = [];

        if(sizeof($category->types) > 0){
            $allTypes = $category->types()->get();
        }

        if(sizeof($category->subCategories) > 0){
            foreach ($category->subCategories as $subCategory){
                foreach ($subCategory->types as $type){
                    $allTypes = $type->get();
                }
            }
        }

        foreach ($allTypes as $type){
            $ads[] = $type->ads;
        }

        $allAds = collect($ads);

        $all = [];
        foreach ($allAds as $ads){
            foreach ($ads as $ad){
                $all = $ad->paginate(5);
            }
        }

        $base_url = route('site.category' ,['slug' => $slug]);

        return view('site.pages.category.index' ,compact('category' ,'all' ,'base_url'));
    }

    protected function filterAds(Request $request)
    {
        $type = $request->type;
        $type_id = $request->type_id;
        $search = $request->search;
        $first_limit = floatval(str_replace('$', '', $request->first_limit));
        $last_limit = floatval(str_replace('$', '', $request->last_limit));

        $ads = Ad::latest();

        if (!empty($search)){
            $ads->where('name' ,'like' ,'%'.$search.'%');
        }

        if(!empty($first_limit)){
            $ads->where('price','>=', $first_limit);
        }

        if(!empty($last_limit)){
            $ads->where('price','<=', $last_limit);
        }

        if(!empty($type)){
            $ads->where('used' ,$type);
        }

        if (!empty('type_id')){
            $ads->where('type_id' ,$type_id);
        }
        $ads = $ads->get();

        $all = $ads->paginate(9);

        return view('site.pages.category.templates.cat' ,compact('all'))->render();
    }


    protected function searchAds(Request $request)
    {
        $type = $request->type;
        $type_id = $request->type_id;
        $search = $request->search;
        $first_limit = floatval(str_replace('$', '', $request->first_limit));
        $last_limit = floatval(str_replace('$', '', $request->last_limit));

        $all = Ad::latest();

        if (!empty($search)){
            $all->where('name' ,'like' ,'%'.$search.'%');
        }

        if(!empty($first_limit)){
            $all->where('price','>=', $first_limit);
        }

        if(!empty($last_limit)){
            $all->where('price','<=', $last_limit);
        }

        if(!empty($type)){
            $all->where('used' ,$type);
        }

        if (!empty('type_id')){
            $all->where('type_id' ,$type_id);
        }

        $all = $all->paginate(9);

        return view('site.pages.category.templates.cat' ,compact('all'))->render();

    }
}
