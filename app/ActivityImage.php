<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityImage extends Model{
    use SoftDeletes;

    protected $fillable = [
        'activity_id',
        'title',
        'image_url'
    ];

    public function activity(){
        return $this->belongsTo('App\Activity');
    }

}
