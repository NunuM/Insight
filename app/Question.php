<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'message','user_id',
    ];
    
    
    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }

    public function answer(){
        return $this->hasMany('\App\Answers');
    }
    
}
