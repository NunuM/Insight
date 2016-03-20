<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function profile() {
        return $this->hasMany('App\Question');
    }
    
    public function message() {
        return $this->hasMany('App\Message');
    }
    
    public function answer() {
        return $this->hasMany('App\Answers');
    }
}
