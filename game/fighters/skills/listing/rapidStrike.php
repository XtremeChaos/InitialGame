<?php
namespace game\fighters\skills\listing ;

use game\fighters\actions\attack;

class rapidStrike implements skill{
    private $chance = 10;
    private $type = 'attack';
    private $name = 'Rapid Strike';

    public function getType() : string {
        return $this->type;
    }
    public function getName() : string {
        return $this->name;
    }
    public function getChance() : float {
        return $this->chance;
    }

    public function run( attack $attack) : void{
        $attack->setMultiplier($attack->getMultiplier() + 1);
    }

}
