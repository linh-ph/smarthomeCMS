<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationLog extends Model
{
    use SoftDeletes;

    protected $table = 'notification_logs';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function feature()
    {
        return $this->belongsTo('App\Features', 'feature_id', 'id');
    }
}
