<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model{

    use SoftDeletes;
    use \Conner\Tagging\Taggable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'cover_url',
        'read_time',
        'age_group_id',
        'is_active',
        'access_level'
    ];

//    protected $hidden = [
//        'pivot'
//    ];

    public function pages(){
        return $this->hasMany('App\Page');
    }

    public function video(){
        return $this->hasOne('App\Video');
    }

    public function ageGroup(){
        return $this->belongsTo('App\AgeGroup');
    }

    //temos de acrescentar esta para fazer a ligação direta á tabela users e alterar os nomes das funções seguintes.
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userFavourites(){
        return $this->belongsToMany('App\User', 'book_user_favourite', 'book_id', 'user_id')
            ->select('user_id')->withTimestamps()->as('book_user_favourite');
    }

    public function userReads(){
        return $this->belongsToMany('App\User', 'book_user_read', 'book_id', 'user_id')->withPivot(['rating', 'read_date'])
            ->select('user_id')->withTimestamps()->as('book_user_read');
    }

    //acho que não precisamos disto tudo pq não partimos a convenção
    public function authors(){
        return $this->belongsToMany('App\Author')->withTimestamps()
        ->as('book_author');
    }

    //Eu acho que aqui devia ser App\Activity e BelongsTo
    public function activityBooks(){
        return $this->hasMany('App\ActivityBook');
//        return $this->BelongsToMany('App\ActivityBook');
    }
}
