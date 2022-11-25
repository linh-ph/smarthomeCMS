<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Features extends Model
{
    use SoftDeletes;

    protected $table = 'features';

    /**
     *
     */
    public function setting()
    {
        return $this->belongsTo(Setting::class, 'id', 'feature_id');
    }
}
