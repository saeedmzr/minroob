<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Saeed\Baloot\MinRoob;

class CheckBasicMinRoobTest extends TestCase
{


    public function test_prize_count_equals_to_fifteen()
    {
        $minroob = new MinRoob();
        $this->assertEquals(15, count($minroob->getPrizes()));
    }

    public function test_block_count_equals_to_fifty_six()
    {
        $minroob = new MinRoob();
        $this->assertEquals(56, count($minroob->getBlocks()));
    }

    public function test_return_true_if_block_has_prize()
    {
        $minroob = new MinRoob();

//      get Random prize's cordinates
        $rand_prize = array_rand($minroob->getPrizes());

//      check if block_has_prize return true
        $this->assertTrue($minroob->block_has_prize($minroob->getPrizes()[$rand_prize]));
    }

    public function test_return_false_if_block_doesnt_have_prize()
    {
//      Get random block that doesnt have prize
        $minroob = new MinRoob();
        $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        while (in_array($block_rand, $minroob->getPrizes())) {
            $block_rand = $minroob->getBlocks()[array_rand($minroob->getBlocks())];
        }

//      check if block_has_prize return false
        $this->assertFalse($minroob->block_has_prize($block_rand));

    }

}
