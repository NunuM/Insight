<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = [
        'message','user_id','question_id',
    ];
    
    
    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }
    
    public function question(){
        return $this->belongsTo('\App\Question');
    }
    
}
