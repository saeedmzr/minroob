<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Saeed\Baloot\MinRoob;
use Saeed\Baloot\Player;

class GameTest extends TestCase
{

    public function test_if_2_players_have_same_board()
    {
//      minroob board obj
        $minroob = new MinRoob();

//        player one obj and Inject minroob board

        $player_one = new Player($minroob);
//        player two obj and Inject minroob board
        $player_two = new Player($minroob);

        $player_one_first_prize_block = $minroob->getPrizes()[0];
        $player_tow_first_prize_block = $minroob->getPrizes()[0];

        $player_one->move($player_one_first_prize_block);
        $player_two->move($player_tow_first_prize_block);

        $this->assertEquals($player_one->getPrizeCount(), $player_two->getPrizeCount());

    }

    public function test_game()
    {
//      minroob board obj
        $minroob = new MinRoob();

//        player one obj and Inject minroob board

        $player_one = new Player($minroob);
//        player two obj and Inject minroob board
        $player_two = new Player($minroob);

//        open up player one turn
        $player_one->openMyTurn();

//        while both of players doesnt have 8 prize, let them play
        while ($player_one->getPrizeCount() != 8 && $player_two->getPrizeCount() != 8) {

//            if its player one turn , let him move
            if ($player_one->getMyTurn()) {
//              get a random block
                $random_block = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
//              it should be a unique block and player havent move to it .
                while (in_array($random_block, $player_one->getMyMoves())) {
                    $random_block = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
                }
//              player one move to block
                $player_one->move($random_block);
//                if the block doesnt have prize you have to let player 2 play
                if (!$minroob->block_has_prize($random_block))
                    $player_two->openMyTurn();

//          if its not player one move then , player 2 can move
            } else {
                $random_block = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
//              it should be a unique block and player havent move to it .
                while (in_array($random_block, $player_two->getMyMoves())) {
                    $random_block = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
                }

                $player_two->move($random_block);
//                if the block doesnt have prize you have to let player 1 play

                if (!$minroob->block_has_prize($random_block))
                    $player_one->openMyTurn();
            }


        }


        if ($player_one->getPrizeCount() == 8) $winner = $player_one;
        else $winner = $player_two;

        $this->assertEquals(8, $winner->getPrizeCount());
    }

}
