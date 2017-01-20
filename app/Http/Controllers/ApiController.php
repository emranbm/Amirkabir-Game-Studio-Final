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
        $game = json_decode(json_encode($game));
        $game->categories = $this->standardCategoryArray($game->categories);
        return $this->packResult(['game' => $game]);
    }

    public function comments($game, Request $request)
    {
        $game->comments->load('user');
        foreach ($game->comments as $comment) {
            $comment->game->load('categories');
        }

        $game = json_decode(json_encode($game));
        foreach ($game->comments as $comment) {
            $comment->game->categories = $this->standardCategoryArray($comment->game->categories);
        }

        return $this->packResult(['comments' => $game->comments]);
    }

    public function header($game, Request $request)
    {
        return $this->info($game, $request);
    }

    public function leaderboard($game, Request $request)
    {
        $game->load(['records' => function ($query) {
            $query->orderBy('score', 'desc')->limit(10);
        }]);

        $game->load('categories');

        $game = json_decode(json_encode($game));
        $game->categories = $this->standardCategoryArray($game->categories);

        return $this->packResult($game);
    }

    public function related_games($game, Request $request)
    {
        $cats = $game->categories;

        if (count($cats) === 0)
            return $this->packResult(['games' => []]);

        $relatedGames = Game::with(['categories' => function ($query) {
            global $cats;

            for ($i = 0; $i < count($cats); $i++) {
                $query = $query->where('name', $cats[$i]);
            }

            return $query;
        }])->get();

        $relatedGames = json_decode(json_encode($relatedGames));

        for ($i = 0; $i < count($relatedGames); $i++) {
            $relatedGames[$i]->categories = $this->standardCategoryArray($relatedGames[$i]->categories);
        }

        return $this->packResult(['games' => $relatedGames]);
    }

    public function home($game, Request $request)
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

    private function standardCategoryArray($categories){
        $newCats = [];
        for ($j = 0; $j < count($categories); $j++) {
            $newCats[] = $categories[$j]->name;
        }

        return $newCats;
    }
}
