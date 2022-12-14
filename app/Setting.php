<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $table = 'settings';

    public function feature()
    {
        return $this->belongsTo('App\Features', 'feature_id', 'id');
    }
}
