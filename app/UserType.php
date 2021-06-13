<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model{
    use SoftDeletes;

    protected $fillable = [
        'user_type'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

}
