<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    //
    protected $fillable = [
        'name', 'project_id',
    ];

    public function project() {
        return $this->belongTo('\App\Team');
    }

    public function elements() {
        return $this->hasMany('\App\Element');
    }

}
