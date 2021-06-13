<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model{

    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'page_image_url',
        'audio_url',
        'page_index'
    ];

    public function book(){
        return $this->belongsTo('App\Book');
    }
}
