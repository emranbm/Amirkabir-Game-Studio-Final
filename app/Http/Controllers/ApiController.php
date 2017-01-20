<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function info($game, Request $request)
    {
        $game->load('categories');
        return $this->packResult(['game' => $game]);
    }

    public function comments($game, Request $request)
    {
        $game->comments->load('user');
        foreach ($game->comments as $comment){
            $comment->game->load('categories');
        }
        return $this->packResult(['comments' => $game->comments]);
    }

    public function header($game, Request $request)
    {
        //TODO
    }

    public function leaderboard($game, Request $request)
    {
        //TODO
    }

    public function related_games($game, Request $request)
    {
        //TODO
    }

    /**
     * Packs the result with the standard shape of api.
     * @param $obj
     */
    private function packResult($obj)
    {
        return ['response' => [
            'ok' => true,
            'result' => $obj
        ]
        ];
    }
}
