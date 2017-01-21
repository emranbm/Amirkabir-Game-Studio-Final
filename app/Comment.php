<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'rate', 'game_id', 'date'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'user_id', 'game_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
}
