<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'user_photo_url'
    ];

    public function activityBooks(){
        return $this->belongsToMany('App\ActivityBook');
    }

    public function books(){
        return $this->hasMany('App\Book');
    }

     function bookFavourites(){
        return $this->belongsToMany('App\Book', 'book_user_favourite', 'book_id', 'user_id')
            ->withTimestamps()->as('book_user_favourite');
    }

    public function bookReads(){
        return $this->belongsToMany('App\Book', 'book_user_read', 'book_id', 'user_id')->withPivot(['rating', 'read_date'])
            ->withTimestamps()->as('book_user_read');
    }

    public function subscription(){
        return $this->hasOne('App\Subscription');
    }

    public function userType(){
        return $this->belongsTo('App\UserType');
    }






    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
