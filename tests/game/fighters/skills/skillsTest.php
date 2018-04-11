<?php

use game\fighters\skills\skills;
use game\fighters\actions\attack;
use PHPUnit\Framework\TestCase;

class skillsTest extends TestCase{
    public $skills;
    public $add_skills = ['magicShield','rapidStrike','berserk'];
    public $count_defence_skills = 1;
    public $count_attack_skills = 2;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->skills = new skills();
        $this->skills->add($this->add_skills);
    }

    public function testAdd(){
        $skills = $this->skills->getAll();

        $this->assertCount(count($this->add_skills), $skills);

        foreach( $skills as $skill ){
            $this->assertInstanceOf('game\fighters\skills\listing\skill',$skill);
        }
    }

    public function testDefenceSkills(){
        $defence_skills = $this->skills->getDefence();
        $this->assertCount($this->count_defence_skills, $defence_skills);
    }

    public function testAttackSkills(){
        $attack_skills = $this->skills->getAttack();
        $this->assertCount($this->count_attack_skills, $attack_skills);
    }

    public function testGetSkillsByType(){
        $defence_skills = $this->skills->getSkillsByType('defence');
        $this->assertCount($this->count_defence_skills, $defence_skills);
        $attack_skills = $this->skills->getSkillsByType('attack');
        $this->assertCount($this->count_attack_skills, $attack_skills);
    }

    public function testModifyAttack(){
        $attack = new attack( 100, 2);
        $this->skills->modifyAttack($attack,'attack');

        $this->assertInstanceOf('game\fighters\actions\attack',$attack);

        $this->skills->modifyAttack($attack,'defence');
        $this->assertInstanceOf('game\fighters\actions\attack',$attack);
    }

}