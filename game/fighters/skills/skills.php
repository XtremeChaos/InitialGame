<?php

namespace game\fighters\skills;

use game\fighters\actions\attack;
use game\gameLogs;
use game\fighters\skills\listing\skill;

class skills{
    use skillsValidation;

    protected $attack = [];
    protected $defence = [];

    public function getDefence() : array {
        return $this->defence;
    }

    public function getAttack() : array {
        return $this->attack;
    }

    public function getAll() : array {
        return array_merge($this->getAttack(),$this->getDefence());
    }

    public function add( array $skills = [] ) : void {
        skillsValidation::validateAdd($skills);
        foreach ( $skills as $skill_name ) {
            $skill_class = '\game\fighters\skills\listing\\'.$skill_name;
            skillsValidation::validateSkillLocation($skill_class);
            /**
             * @var skill $skill
             */
            $skill = new $skill_class();
            skillsValidation::validateSkillInstance($skill);
            switch ( $skill->getType() ){
                case 'attack':
                    $this->addToAttack($skill);
                    break;
                case 'defence':
                    $this->addToDefence($skill);
                    break;
            }
        }
    }

    private function addToDefence( skill $skill ) : void {
        array_push($this->defence,$skill);
    }

    private function addToAttack( skill $skill ) : void {
        array_push($this->attack,$skill);
    }

    private function getTriggered( string $type ) : array {
        $triggered = [];
        $skills = $this->getSkillsByType( $type );

        foreach( $skills as $skill ){
            if( !checkProbability($skill->getChance()) ){
                continue;
            }
            array_push($triggered,$skill);
        }
        return $triggered;
    }

    public function modifyAttack( attack $attack = null, string $type = null ) : void {

        skillsValidation::validateModifyAttack($attack,$type);

        $skills = $this->getTriggered( $type );

        foreach( $skills  as $skill ){
            /**
             * @var skill $skill
             */
            gameLogs::add( "Se activeaza skill-ul ".$skill->getName()." celui care  ".($skill->getType() == 'attack' ? 'ataca' : 'se apara ') );
            $skill->run( $attack );
        }

    }

    public function getSkillsByType( string $type = null ) : array {
        skillsValidation::validateGetSkillsByType( $type );
        $skills = [];
        switch ($type){
            case 'attack':
                $skills = $this->getAttack();
                break;
            case 'defence':
                $skills = $this->getDefence();
                break;
        }
        return $skills;
    }
}

