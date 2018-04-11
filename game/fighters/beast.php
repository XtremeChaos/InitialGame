<?php
namespace game\fighters;

class beast extends fighter implements baseFighter {

    public function __construct( string $name = null , array $skills = []){
        try{
            parent::__construct();
            $this->setName($name);
            $this->setHealth(rand(60,90));
            $this->setHealthRemained($this->getHealth());
            $this->setStrength(rand(60,90));
            $this->setDefence(rand(40,60));
            $this->setSpeed(rand(40,60));
            $this->setLuck(rand(25,40));

            $this->skills->add($skills);
        }catch (\Exception $e ){
            die('A fost intampinata o problema la initierea bestiei : ' . $e->getMessage() );
        }
    }

}