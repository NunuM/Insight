<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
     protected $fillable = [
        'text','user_id',
    ];
    
    public function element(){
        return $this->belongsTo('\App\Element');
    }
   
}
