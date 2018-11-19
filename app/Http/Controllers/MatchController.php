<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Support\Facades\Input;

class MatchController extends Controller {

    public function index() {
        return view('index');
    }

    /**
     * Returns a list of matches
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matches() {

        return response()->json(Match::all());
    }

    /**
     * Returns the state of a single match
     *
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function match($id) {

        return Match::find($id);
    }

    /**
     * Makes a move in a match
     *
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function move($id) {
        /**@var Match $match*/
        $match = Match::find($id);

        $position = Input::get('position');
        $board = $match->board;
        $board[$position] = $match->next;

        $match->board = $board;
        $match->next =  $match->next == 1 ? 2 : 1;

        $match->winner = Match::checkWinner($match->board);

        $match->save();
        return response()->json($match);
    }

    /**
     * Creates a new match and returns the new list of matches
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create() {

        $match = new Match();

        $match->name = "Match ";

        $match->next = collect([1,2])->random();
        $match->winner = 0;

        $match->board = Match::defaultBoard;
        $match->save();

        $match->name .= $match->id;
        $match->save();

        return response()->json(Match::all());
    }

    /**
     * Deletes the match and returns the new list of matches
     *
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {

        $match = Match::findOrFail($id);

        $match->delete();

        return response()->json(Match::all());
    }

}