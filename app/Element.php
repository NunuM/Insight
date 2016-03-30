<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model {

    protected $fillable = [
        'role_id', 'user_id', 'team_id',
    ];
    
    public function questions() {
        return $this->hasMany('\App\Question');
    }
    
    public function answers() {
        return $this->hasMany('\App\Answers');
    }
    
    public function role() {
        return $this->hasOne('\App\Role');
    }
    
    public function user() {
        return $this->belongsTo('\App\User');
    }

}
