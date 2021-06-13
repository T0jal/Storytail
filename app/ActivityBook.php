<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityBook extends Model{

    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'activity_id'
    ];

    public function book(){
//        return $this->hasOne('App\Book');
        return $this->BelongsTo('App\Book');

    }

    public function activity(){
//        return $this->hasOne('App\Activity');
        return $this->BelongsTo('App\Activity');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
