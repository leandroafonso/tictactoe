<?php

namespace Tests\Feature;

use App\Match;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatchTest extends TestCase
{
    /**
     * If no one player has moved
     *
     * @return void
     */
    public function testNotMoved()
    {
        $board = [
            0, 0, 0,
            0, 0, 0,
            0, 0, 0,
        ];

        $this->assertTrue( Match::checkWinner($board) == 0);
    }

    /**
     * Player X won
     *
     * @return void
     */
    public function testWinnerX()
    {
        $board = [
            1, 0, 2,
            0, 1, 2,
            2, 2, 1,
        ];

        $this->assertTrue( Match::checkWinner($board) == 1);
    }

    /**
     * Player O won
     *
     * @return void
     */
    public function testWinnerO()
    {
        $board = [
            2, 2, 2,
            0, 1, 2,
            2, 2, 1,
        ];

        $this->assertTrue( Match::checkWinner($board) == 2);
    }

    /**
     * Nobody won.
     *
     * @return void
     */
    public function testWinnerOX()
    {
        $board = [
            2, 2, 1,
            1, 1, 2,
            2, 2, 1,
        ];

        $this->assertTrue( Match::checkWinner($board) == 3);
    }


}
