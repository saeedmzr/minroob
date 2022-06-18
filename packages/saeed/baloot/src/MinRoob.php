<?php

namespace Saeed\Baloot;

class MinRoob
{
    protected $prizes = [];
    protected $blocks;

    public function __construct()
    {
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 8; $j++) {
                $this->blocks[] = [$i, $j];
            }
        }

        for ($i = 0; $i < 15; $i++) {
            $x = rand(0, 6);
            $y = rand(0, 7);
            while (in_array([$x, $y], $this->prizes)) {
                $x = rand(0, 6);
                $y = rand(0, 7);
            }
            $this->prizes[] = [$x, $y];
        }
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function getPrizes()
    {
        return $this->prizes;
    }

    public function block_has_prize($cordinate)
    {
        if (in_array($cordinate, $this->prizes)) return true;
        return false;
    }

    public function prize_count_around_block($cordinate)
    {
        $count = 0;
        $x = $cordinate[0];
        $y = $cordinate[1];

        for ($i = 0; $i < 2; $i++) {
            $around_x = $i - 1;
            for ($j = 0; $j < 2; $j++) {
                $around_y = $j - 1;
                if (in_array([$around_x, $around_y], $this->prizes)) $count++;
            }
        }
        return $count;

    }


}
