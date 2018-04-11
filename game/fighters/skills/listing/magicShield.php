<?php
namespace game\fighters\skills\listing ;

use game\fighters\actions\attack;

class magicShield implements skill{
    private $chance = 20;
    private $type = 'defence';
    private $name = 'Magic Shield';

    public function getType() : string {
        return $this->type;
    }
    public function getName() : string {
        return $this->name;
    }
    public function getChance() : float {
        return $this->chance;
    }

    public function run( attack $attack) : void {
        $attack->setMultiplier($attack->getMultiplier() / 2);
    }

}
