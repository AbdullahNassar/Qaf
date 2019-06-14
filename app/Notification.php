<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable =['seen','type','message'];
    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }
}
