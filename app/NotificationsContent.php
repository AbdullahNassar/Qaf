<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationsContent extends Model
{
    protected $table = 'notifications_content';

    public function member()
    {
        return $this->belongsTo(Member::class,'sender_id');
    }
}
