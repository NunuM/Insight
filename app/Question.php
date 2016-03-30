<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'message','element_id',
    ];
    
    
    public function element(){
        return $this->belongsTo('\App\Element');
    }

    public function answer(){
        return $this->hasMany('\App\Answers');
    }
    
}
