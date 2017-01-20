<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at', 'tutorial', 'game_id'];

    public function game(){
        return $this->belongsTo('App\Game');
    }
}
