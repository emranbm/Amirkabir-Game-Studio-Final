<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function info($game, Request $request)
    {
        return $this->packResult(['game' => $game]);
    }

    public function comments($title, Request $request)
    {
        return $this->packResult(['comments' => Game::where('title', $title)->all()]);
    }

    public function header($title, Request $request)
    {
        //TODO
    }

    public function leaderboard($title, Request $request)
    {
        //TODO
    }

    public function related_games($title, Request $request)
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
