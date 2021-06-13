<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model{

    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
        'author_photo_url',
        'nationality'
    ];

    public function books(){
        return $this->belongsToMany('App\Book')->withTimestamps()
        ->as('author_book');
    }

}
