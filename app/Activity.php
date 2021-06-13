<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description'
    ];

    public function activityImages(){
        return $this->hasMany('App\ActivityImage');
    }

    public function activityBooks(){
        return $this->hasMany('App\ActivityBook');
    }
}
