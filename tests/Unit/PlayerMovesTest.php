<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Saeed\Baloot\MinRoob;
use Saeed\Baloot\Player;

class PlayerMovesTest extends TestCase
{
//
    public function test_prize_count_is_equals_to_zero_at_start()
    {
        $minroob = new MinRoob();

        $player = new Player($minroob);
        $this->assertEquals(0, $player->getPrizeCount());
    }

    public function test_if_player_move_to_prize_it_counts()
    {
        $minroob = new MinRoob();
        $player = new Player($minroob);
//      get Random prize's cordinates
        $rand_prize = $minroob->getPrizes()[array_rand($minroob->getPrizes())];
//      player move to that block
        $player->move($rand_prize);

//      check his prize_count is equal to 1
        $this->assertEquals(1, $player->getPrizeCount());
    }

    public function test_if_player_move_to_prize_block_turn_doesnt_change()
    {
        $minroob = new MinRoob();
        $player = new Player($minroob);

//      get Random prize's cordinates
        $rand_prize = $minroob->getPrizes()[array_rand($minroob->getPrizes())];

//      player move to that block
        $player->move($rand_prize);

//        check his turn is equal to true
        $this->assertTrue($player->getMyTurn());
    }

    public function test_if_player_move_to_non_prize_block_turn_returns()
    {
        $minroob = new MinRoob();
        $player = new Player($minroob);

//      Get random block that doesnt have prize
        $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        while (in_array($block_rand, $minroob->getPrizes())) {
            $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        }
//      player move to that block
        $player->move($block_rand);

//        check his turn is equal to false
        $this->assertFalse($player->getMyTurn());
    }


    public function test_if_one_player_get_8_prizes()
    {
//      minroob board obj
        $minroob = new MinRoob();
//        player one obj and Inject minroob board
        $player = new Player($minroob);
//        get prizes blocks
        $prizes = $minroob->getPrizes();

//        while player doesnt get 8 prize move it to another prize block
        while ($player->getPrizeCount() != 8) {
//            if player already moved to a prize block , move to another
            $move_to_prize_block = $prizes[array_rand($prizes)];
            while (in_array($move_to_prize_block, $player->getMyMoves())) {
                $move_to_prize_block = $prizes[array_rand($prizes)];
            }

            $player->move($move_to_prize_block);
        }

//        check if player get 8 prizes
        $this->assertEquals(8, $player->getPrizeCount());
    }

    public function test_if_player_doesnt_move_to_a_prize_block_it_return_prize_count_around_block()
    {
        $minroob = new MinRoob();
        $player = new Player($minroob);

//      Get random block that doesnt have prize
        $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        while (in_array($block_rand, $minroob->getPrizes())) {
            $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        }
//      player move to that block and get prize count around that block

//check if player return integer (number of prize block around moved block)
        $count = $player->move($block_rand);
        $this->assertIsInt($count);
    }

    public function test_return_false_if_a_player_move_to_a_block_again()
    {
//      minroob board obj
        $minroob = new MinRoob();
//        player one obj and Inject minroob board
        $player = new Player($minroob);
//        get a random block
        $random_block = $minroob->getBlocks()[array_rand($minroob->getBlocks())];

//        move for first time
        $player->move($random_block);
//        move second time
        $result = $player->move($random_block);

        $this->assertFalse($result);
    }


}
