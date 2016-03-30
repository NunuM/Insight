<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = [
        'message','element_id','question_id',
    ];
    
    
    public function element(){
        return $this->belongsTo('\App\Element');
    }
    
    public function question(){
        return $this->belongsTo('\App\Question');
    }
    
}
