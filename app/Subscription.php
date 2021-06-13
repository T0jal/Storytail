<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date'
    ];

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
