<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'age_group',
    ];


    public function books(){
        return $this->hasMany('App\Book');
    }
}
