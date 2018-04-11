<?php

namespace game\fighters;

use game\fighters\actions\attack;
use game\fighters\skills\skills;
use game\gameLogs;

abstract class fighter implements baseFighter {

    use fighterValidation;

    private $name;
    private $health;
    private $healthRemained;
    private $strength;
    private $defence;
    private $speed;
    private $luck;
    protected $skills;

    public function __construct(){
        $this->skills = new skills();
    }

    public function setName( string $name = null ) : void{
        fighterValidation::validateName($name);
        $this->name = $name;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setHealth( float $health = null ) : void{
        fighterValidation::validateHealth($health);
        $this->health = $health;
    }

    public function getHealth() : float{
        return $this->health;
    }

    public function setHealthRemained( float $healthRemained = null ) : void{
        fighterValidation::validateHealthRemained($healthRemained);
        $this->healthRemained = $healthRemained;
    }

    public function getHealthRemained() : float{
        return $this->healthRemained;
    }

    public function setStrength( float $strength = null ) : void{
        fighterValidation::validateStrength($strength);
        $this->strength = $strength;
    }

    public function getStrength() : float{
        return $this->strength;
    }

    public function setDefence( float $defence = null ) : void{
        fighterValidation::validateDefence($defence);
        $this->defence = $defence ;
    }

    public function getDefence() : float{
        return $this->defence;
    }

    public function setSpeed( float $speed = null ) : void{
        fighterValidation::validateSpeed($speed);
        $this->speed = $speed ;
    }

    public function getSpeed() : float{
        return $this->speed;
    }

    public function setLuck( float $luck = null ) : void{
        fighterValidation::validateLuck($luck);
        $this->luck = $luck ;
    }

    public function getLuck() : float {
        return $this->luck;
    }

    public function isDead() : bool {
        return $this->getHealthRemained() <= 0;
    }

    public function attack() : attack{
        $attack = new attack($this->getStrength());

        $this->skills->modifyAttack( $attack, 'attack' );

        return $attack;
    }

    public function defend( attack $attack ) : void{
        if( $this->hasLuck() ){
            gameLogs::add($this->getName().' a avut noroc si nu a fost lovit');
            return;
        }

        $this->skills->modifyAttack( $attack, 'defence' );

        $this->takeDamage($attack);
    }

    public function takeDamage( attack $attack = null ) : attack{
        if( $attack->getMultiplier() < 1 ){
            $damage = ( $attack->getStrength() - $this->getDefence() ) * $attack->getMultiplier() ;
        }else{
            $damage = $attack->getStrength() - $this->getDefence() ;
        }
        if( $damage > 0 ){
            $this->setHealthRemained($this->getHealthRemained() - $damage);
            gameLogs::add($this->getName().' a fost atacat cu '.$damage.' si a mai ramas la viata cu : '.$this->getHealthRemained());
        }
        if( $attack->getMultiplier() - 1 > 0 ){
            $attack->setMultiplier($attack->getMultiplier() - 1 );
            return $this->takeDamage($attack);
        }

        return $attack;
    }

    public function hasLuck() : bool {
        return checkProbability($this->getLuck());
    }

    public function getSkills() : array {
        return $this->skills->getAll();
    }

}
