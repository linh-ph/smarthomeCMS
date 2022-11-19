<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryFeature extends Model
{
    protected $table = 'history_features';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
