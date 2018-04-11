<?php

use game\fighters\hero;
use PHPUnit\Framework\TestCase;
use game\fighters\actions\attack;

class heroTest extends TestCase
{
    public $hero;
    public $name = 'Test Hero';
    public $skills = ['magicShield','rapidStrike'];

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->hero = new hero($this->name,$this->skills);
    }

    public function testSetName(){
        $this->assertSame( $this->name, $this->hero->getName() );

        $this->hero->setName('Test Hero 2');
        $this->assertSame( 'Test Hero 2', $this->hero->getName() );
    }

    public function testSetHealth(){
        $this->assertEquals(85, $this->hero->getHealth(), 'Viata eroului nu este in parametrii permisi',15);

        $this->hero->setHealth( 20 );
        $this->assertEquals(20, $this->hero->getHealth());
    }

    public function testSetHealthRemained(){
        $this->assertEquals(85, $this->hero->getHealthRemained(), 'Viata eroului nu este in parametrii permisi',15);
        $this->assertEquals( $this->hero->getHealth(), $this->hero->getHealthRemained() );
        $this->hero->setHealthRemained(20);

        $this->assertEquals( 20, $this->hero->getHealthRemained() );
    }

    public function testSetStrength(){
        $this->assertEquals(75, $this->hero->getStrength(), 'Puterea eroului nu este in parametrii permisi',10);

        $this->hero->setStrength( 20 );
        $this->assertEquals(20, $this->hero->getStrength());
    }

    public function testSetDefence(){
        $this->assertEquals(50, $this->hero->getDefence(), 'Apararea eroului nu este in parametrii permisi',5);

        $this->hero->setDefence( 20 );
        $this->assertEquals(20, $this->hero->getDefence());
    }

    public function testSetSpeed(){
        $this->assertEquals(45, $this->hero->getSpeed(), 'Viteza  eroului nu este in parametrii permisi',5);

        $this->hero->setSpeed( 20 );
        $this->assertEquals(20, $this->hero->getSpeed());
    }

    public function testSetLuck(){
        $this->assertEquals(20, $this->hero->getLuck(), 'Norocul  eroului nu este in parametrii permisi',10);

        $this->hero->setLuck( 20 );
        $this->assertEquals(20, $this->hero->getLuck());
    }

    public function testSkills(){
        $skills = $this->hero->getSkills();

        $this->assertCount(count($this->skills), $skills);

        foreach( $skills as $skill ){
            $this->assertInstanceOf('game\fighters\skills\listing\skill',$skill);
        }
    }

    public function testAttack(){
        $attack = $this->hero->attack();
        $this->assertInstanceOf('game\fighters\actions\attack',$attack);
    }

    public function testDefend(){
        $hero = new hero($this->name);
        $attack = new attack('100', 1 );
        $hero->setLuck(0);

        $defence = $hero->getDefence();
        $health = $hero->getHealth();
        $damage = $attack->getStrength() - $defence ;
        $hero->defend($attack);

        $healthRemained = $health - $damage;
        $this->assertEquals($healthRemained, $hero->getHealthRemained());
    }

}
