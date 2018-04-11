<?php

use game\fighters\beast;
use PHPUnit\Framework\TestCase;

class beastTest extends TestCase
{
    public $hero;
    public $name = 'Test Beast';
    public $skills = ['berserk','rapidStrike'];

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->hero = new beast($this->name,$this->skills);
    }

    public function testSetName(){
        $this->assertSame( $this->name, $this->hero->getName() );

        $this->hero->setName('Test Beast 2');
        $this->assertSame( 'Test Beast 2', $this->hero->getName() );
    }

    public function testSetHealth(){
        $this->assertEquals(75, $this->hero->getHealth(), 'Viata bestiei nu este in parametrii permisi',15);

        $this->hero->setHealth( 20 );
        $this->assertEquals(20, $this->hero->getHealth());
    }

    public function testSetHealthRemained(){
        $this->assertEquals(75, $this->hero->getHealthRemained(), 'Viata bestiei nu este in parametrii permisi',15);
        $this->assertEquals( $this->hero->getHealth(), $this->hero->getHealthRemained() );
        $this->hero->setHealthRemained(20);

        $this->assertEquals( 20, $this->hero->getHealthRemained() );
    }

    public function testSetStrength(){
        $this->assertEquals(75, $this->hero->getStrength(), 'Puterea bestiei nu este in parametrii permisi',15);

        $this->hero->setStrength( 20 );
        $this->assertEquals(20, $this->hero->getStrength());
    }

    public function testSetDefence(){
        $this->assertEquals(50, $this->hero->getDefence(), 'Apararea bestiei nu este in parametrii permisi',10);

        $this->hero->setDefence( 20 );
        $this->assertEquals(20, $this->hero->getDefence());
    }

    public function testSetSpeed(){
        $this->assertEquals(50, $this->hero->getSpeed(), 'Viteza  bestiei nu este in parametrii permisi',10);

        $this->hero->setSpeed( 20 );
        $this->assertEquals(20, $this->hero->getSpeed());
    }

    public function testSetLuck(){
        $this->assertEquals(32.5, $this->hero->getLuck(), 'Norocul  bestiei nu este in parametrii permisi',12.5);

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

}
