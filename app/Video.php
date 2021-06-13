<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model{

    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'title',
        'video_url'
    ];

    public function book(){
        return $this->belongsTo('App\Book');
    }
}
