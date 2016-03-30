<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    //
    protected $fillable = [
        'description', 'created_at', 'updated_at', 'user_id',
    ];

    public function user() {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function team() {
        return $this->hasMany('\App\Team');
    }

    public function board() {
        return $this->hasMany('\App\Board');
    }

}
