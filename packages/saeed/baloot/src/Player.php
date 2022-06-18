<?php

namespace Saeed\Baloot;

class Player
{

    private $actions;
    private $cordinate;
    private $my_moves = [];
    private $prize_count;
    private $my_turn;
    public $minroob;

    public function __construct(MinRoob $minRoob)
    {
        $this->minroob = $minRoob;
    }

    public function openMyTurn()
    {
        $this->my_turn = true;
    }

    private function closeMyTurn()
    {
        $this->my_turn = false;
    }

    public function getMyTurn()
    {
        return $this->my_turn;
    }

    public function getMyMoves()
    {
        return $this->my_moves;
    }

    public function setCordinate($cordinate)
    {
        $this->cordinate = [$cordinate[0], $cordinate[1]];
    }

    public function getPrizeCount()
    {
        return $this->prize_count;
    }

    public function getCordinate()
    {
        return $this->cordinate;
    }

    public function move($cordinate)
    {
        if (!in_array($cordinate, $this->my_moves)) $this->my_moves[] = $cordinate;
        else return false;

        $this->openMyTurn();
        $this->actions [] = [
            'from_block' => $this->getCordinate(),
            'to_block' => $cordinate,
            'block_has_prize' => $this->minroob->block_has_prize($cordinate),
        ];

        $this->setCordinate($cordinate);

        if ($this->minroob->block_has_prize($cordinate)) {
            $this->addPrize();
            return $this->getPrizeCount();
        } else {
            $this->closeMyTurn();
            return $this->minroob->prize_count_around_block($cordinate);
        }


    }

    private function addPrize()
    {
        $this->prize_count++;
    }

}
