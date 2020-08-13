<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

//use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token', 'admin','meal_id', 'party_id','allergies'
    ];

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
     * Helps when frontend app check to see if 2 == 2 which will be false with out this since we'd be sending string 2 by default
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'meal_id' => 'integer',
        'admin' => 'integer',
        'party_id' => 'integer',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = 'some random slug';
    }
}
