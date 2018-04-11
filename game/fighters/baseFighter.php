<?php

namespace game\fighters;

use game\fighters\actions\attack;

interface baseFighter{
    function __construct();
    function setName( string $name ):void;
    function getName() : string ;
    function setHealth( float $health ): void;
    function getHealth() : float;
    function setHealthRemained( float $health_remained ): void ;
    function getHealthRemained() : float ;
    function setStrength( float $strength ) : void;
    function getStrength() : float ;
    function setDefence( float $defence ) : void;
    function getDefence() : float;
    function setSpeed( float $speed ) : void;
    function getSpeed() : float;
    function setLuck( float $luck ) : void;
    function getLuck() : float ;
    function isDead() : bool;
    function attack() : attack;
    function defend( attack $attack ) : void;
    function takeDamage( attack $attack ) : attack;
    function hasLuck() : bool ;
    function getSkills() : array;
}