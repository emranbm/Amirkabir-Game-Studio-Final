<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function records()
    {
        return $this->hasMany('App\Record');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function tutorials()
    {
        return $this->hasMany('App\Tutorial');
    }
}
