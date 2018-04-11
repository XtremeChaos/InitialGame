<?php

namespace game\fighters;


class hero extends fighter implements baseFighter {

    public function __construct( string $name = null,array $skills = [] ){
        try{
            parent::__construct();
            $this->setName($name);
            $this->setHealth(rand(70,100));
            $this->setHealthRemained($this->getHealth());
            $this->setStrength(rand(70,80));
            $this->setDefence(rand(45,55));
            $this->setSpeed(rand(40,50));
            $this->setLuck(rand(10,30));

            $this->skills->add($skills);
        }catch (\Exception $e ){
            die('A fost intampinata o problema la initierea eroului : ' . $e->getMessage() );
        }
    }

}