<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'duration',
        'access_level'
    ];

    public function subscriptions(){
        return $this->hasMany('App\Subscription');
    }

}
