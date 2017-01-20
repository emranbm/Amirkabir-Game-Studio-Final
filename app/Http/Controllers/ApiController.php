<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function info($title, Request $request)
    {
        return $this->packResult(['game' => Game::where('title', $title)->first()]);
    }

    public function comments($title, Request $request)
    {
        //TODO
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
