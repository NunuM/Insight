<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    //
    public function project() {
        return $this->belongsTo('\App\Project');
    }
    
    public function questions(){
        return $this->hasMany('\App\Question');
    }
    
    public function answers(){
        return $this->hasMany('\App\Answers');
    }
    
}
