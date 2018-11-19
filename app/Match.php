<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Match
 * @package App
 *
 * @property integer $id primary key auto increment
 * @property string $name match name
 * @property integer $next next player
 * @property integer $winner match winner
 * @property array $board the game
 */
class Match extends Model
{

    protected $casts = [
        "board" => "json"
    ];

    const receipt = [
        [0, 1, 2],
        [0, 3, 6],
        [0, 4, 8],
        [1, 4, 7],
        [2, 5, 8],
        [2, 4, 6],
        [3, 4, 5],
        [6, 7, 8]
    ];

    const defaultBoard = [
        0,0,0,
        0,0,0,
        0,0,0
    ];

    /**
     *
     * Needs a board to verify the match's winner
     *
     * @param array $board
     * @return int
     *
     */
    public static function checkWinner($board)
    {
        foreach (self::receipt as $win){

            //if the position one has no player go to the next.
            if($board[$win[0]] == 0){
                continue;
            }
            //case 3 positions are equal we have a winner.
            if($board[$win[0]] == $board[$win[1]]
                && $board[$win[0]] == $board[$win[2]]){
                //returns the id of player on position
                return $board[$win[0]];
            }
        }

        //case nobody won, returns 3, case not moved returns 0
        return in_array(0, $board) == false ? 3 : 0;
    }
}
