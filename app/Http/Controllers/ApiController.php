<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Game;
use App\Record;
use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{

    public function info($game, Request $request)
    {
        $game->load('categories');
        $cNum = $this->commentsCount($game);
        $rate = $this->gameRate($game);
        $game = json_decode(json_encode($game));
        $game->categories = $this->standardCategoryArray($game->categories);
        $game->number_of_comments = $cNum;
        $game->rate = $rate;

        return $this->packResult(['game' => $game]);
    }

    public function comments($game, Request $request)
    {
        $game->comments->load('user');
        $cNums = [];
        $rates = [];
        foreach ($game->comments as $comment) {
            $comment->game->load('categories');
            $cNums[] = $this->commentsCount($comment->game);
            $rates[] = $this->gameRate($comment->game);
        }

        $game = json_decode(json_encode($game));
        foreach ($game->comments as $comment) {
            $comment->game->categories = $this->standardCategoryArray($comment->game->categories);
            $comment->game->number_of_comments = array_shift($cNums);
            $comment->game->rate = array_shift($rates);
        }

        return $this->packResult(['comments' => $game->comments]);
    }

    public function header($game, Request $request)
    {
        return $this->info($game, $request);
    }

    public function leaderboard($game, Request $request)
    {
        $records = Record::where('game_id', $game->id)->orderBy('score', 'desc')->limit(10)->with('user')->with('game')->get();

        return $this->packResult(['leaderboard' => $records]);
    }

    public function related_games($game, Request $request)
    {
        $cats = $game->categories;
        $cNums = [];
        $rates = [];

        if (count($cats) === 0)
            return $this->packResult(['games' => []]);

        $relatedGames = Game::with(['categories' => function ($query) {
            global $cats;

            for ($i = 0; $i < count($cats); $i++) {
                $query = $query->where('name', $cats[$i]);
            }

            return $query;
        }])->get();

        foreach ($relatedGames as $relatedGame) {
            $cNums[] = $this->commentsCount($relatedGame);
            $rates[] = $this->gameRate($relatedGame);
        }

        $relatedGames = json_decode(json_encode($relatedGames));

        for ($i = 0; $i < count($relatedGames); $i++) {
            $relatedGames[$i]->categories = $this->standardCategoryArray($relatedGames[$i]->categories);
            $relatedGames[$i]->number_of_comments = array_shift($cNums);
            $relatedGames[$i]->rate = array_shift($rates);
        }

        return $this->packResult(['games' => $relatedGames]);
    }

    public function home(Request $request)
    {
        $slider = Game::orderBy('created_at', 'desc')->limit(10)->get()->load('categories');

        $cNums = [];
        $rates = [];
        foreach ($slider as $game) {
            $cNums[] = $this->commentsCount($game);
            $rates[] = $this->gameRate($game);
        }
        $slider = json_decode(json_encode($slider));
        foreach ($slider as $game) {
            $game->categories = $this->standardCategoryArray($game->categories);
            $game->number_of_comments = array_shift($cNums);
            $game->rate = array_shift($rates);
        }

        $newGames = $slider;
        $comments = Comment::orderBy('created_at', 'desc')->limit(5)->get()->load('game')->load('user');
        $tutorials = Tutorial::orderBy('created_at', 'desc')->limit(5)->get()->load(['game' => function ($query) {
            $query->with('categories');
        }]);

        $tutorials = json_decode(json_encode($tutorials));

        foreach ($tutorials as $tutorial) {
            $tutorial->game->categories = $this->standardCategoryArray($tutorial->game->categories);
        }

        return $this->packResult(['homepage' => [
            'slider' => $slider,
            'new_games' => $newGames,
            'comments' => $comments,
            'tutorials' => $tutorials
        ]]);
    }

    public function search()
    {
        $q = Input::get('q');

        $games = json_decode(json_encode(Game::where('title', 'like', '%' . $q . '%')->with('categories')->get()));

        foreach ($games as $game) {
            $game->categories = $this->standardCategoryArray($game->categories);
        }

        return $this->packResult(['games' => $games]);
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

    private function standardCategoryArray($categories)
    {
        $newCats = [];
        for ($j = 0; $j < count($categories); $j++) {
            $newCats[] = $categories[$j]->name;
        }

        return $newCats;
    }

    private function commentsCount($game)
    {
        return Comment::where('game_id', $game->id)->count();
    }

    private function gameRate($game)
    {
        return $game->comments()->avg('rate');
    }
}
