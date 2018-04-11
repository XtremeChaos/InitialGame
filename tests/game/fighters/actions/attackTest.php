<?php

use game\fighters\actions\attack;
use PHPUnit\Framework\TestCase;

class attackTest extends TestCase{
    public $attack;
    public $strength = 20;
    public $multiplier = 1.6;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->attack = new attack($this->strength,$this->multiplier);
    }

    public function testSetStrength(){
        $this->assertEquals($this->strength, $this->attack->getStrength());

        $this->attack->setStrength( 20 );
        $this->assertEquals(20, $this->attack->getStrength());
    }

    public function testSetMultiplier(){
        $this->assertEquals($this->multiplier, $this->attack->getMultiplier());

        $this->attack->setMultiplier( 5 );
        $this->assertEquals(5, $this->attack->getMultiplier());
    }

}