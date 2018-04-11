<?php

use game\game;
use game\fighters\fighter;
use PHPUnit\Framework\TestCase;

class gameTest extends TestCase
{
    public $game;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->game = new game();
    }

    public function testAddPlayer(){
        $this->game->addPlayer('white','hero','Test Erou 1',['rapidStrike','magicShield']);

        $fighters = $this->game->getTeam('white');
        $this->assertCount(1, $fighters);

        /**
         * @var fighter $fighter
         */
        $fighter = $fighters[0];
        $this->assertInstanceOf('game\fighters\fighter',$fighter);
        $this->assertInstanceOf('game\fighters\hero',$fighter);

        $this->assertSame( 'Test Erou 1', $fighter->getName() );

        $skills = $fighter->getSkills();

        $this->assertCount(2, $skills);

        foreach( $skills as $skill ){
            $this->assertInstanceOf('game\fighters\skills\listing\skill',$skill);
        }

        $this->game->addPlayer('black','beast','Test Bestie 1',['berserk']);
        $this->game->addPlayer('black','beast','Test Bestie 2',['berserk']);

        $fighters = $this->game->getTeam('black');
        $this->assertCount(2, $fighters);
        /**
         * @var fighter $fighter
         */
        foreach ($fighters as $k => $fighter) {
            $this->assertInstanceOf('game\fighters\fighter', $fighter);
            $this->assertInstanceOf('game\fighters\beast', $fighter);

            $this->assertSame('Test Bestie '.($k + 1), $fighter->getName());
        }

        $skills = $fighter->getSkills();

        $this->assertCount(1, $skills);

        foreach( $skills as $skill ){
            $this->assertInstanceOf('game\fighters\skills\listing\skill',$skill);
        }
    }

    public function testStartGame(){
        $this->game->addPlayer('white','hero','Test Erou 1',['rapidStrike']);
        $this->game->addPlayer('white','hero','Test Erou 2');
        $this->game->addPlayer('white','hero','Test Erou 3',['rapidStrike','magicShield']);
        $this->game->addPlayer('black','beast','Test Bestie 1',['berserk']);
        $this->game->addPlayer('black','beast','Test Bestie 2');
        $gameStatus = $this->game->startGame();

        $this->assertSame( true, $gameStatus );
    }

}
