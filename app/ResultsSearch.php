<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultsSearch extends Model
{
   protected $table ='results_search';
   protected $fillable =['member_id','search_url'];
}
