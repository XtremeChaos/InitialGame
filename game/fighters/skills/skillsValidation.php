<?php

namespace game\fighters\skills;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

trait skillsValidation{

    private static $instance = false;

    /**
     * @var v $validateAdd
     */
    private static $validateAdd;
    /**
     * @var v $validateSkillLocation
     */
    private static $validateSkillLocation;
    /**
     * @var v $validateSkillInstance
     */
    private static $validateSkillInstance;
    /**
     * @var v $validateModifyAttack
     */
    private static $validateModifyAttack;
    /**
     * @var v $validateGetSkillsByType
     */
    private static $validateGetSkillsByType;

    private static function checkInstance(){
        if( self::$instance === true ){
            return true;
        }
        self::$validateAdd = v::attribute('skills', v::arrayVal());
        self::$validateSkillLocation = v::attribute('skill_name', v::exists());
        self::$validateSkillInstance = v::attribute('skill', v::objectType()->instance('game\fighters\skills\listing\skill'));
        self::$validateModifyAttack = v::attribute('attack', v::objectType()->instance('game\fighters\actions\attack'))
                                       ->attribute('type',v::stringType()->in(['defence', 'attack']));
        self::$validateGetSkillsByType = v::attribute('type',v::stringType()->in(['defence', 'attack']));

        self::$instance = true;
    }

    public static function validateAdd( $skills = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->skills = $skills;

        try {
            self::$validateAdd->assert($test);
        } catch(NestedValidationException $exception) {
            throw new skillsException($exception->getFullMessage());
        }
    }

    public static function validateSkillLocation( $skill_name = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->skill_name = (__DIR__.'/../../..'.str_replace('\\','/',$skill_name).'.php');

        try {
            self::$validateSkillLocation->assert($test);
        } catch(NestedValidationException $exception) {
            throw new skillsException($exception->getFullMessage());
        }
    }

    public static function validateSkillInstance( $skill = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->skill = $skill;

        try {
            self::$validateSkillInstance->assert($test);
        } catch(NestedValidationException $exception) {
            throw new skillsException($exception->getFullMessage());
        }
    }

    public static function validateModifyAttack( $attack = null, $type = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->attack = $attack;
        $test->type = $type;

        try {
            self::$validateModifyAttack->assert($test);
        } catch(NestedValidationException $exception) {
            throw new skillsException($exception->getFullMessage());
        }
    }

    public static function validateGetSkillsByType( $type = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->type = $type;

        try {
            self::$validateGetSkillsByType->assert($test);
        } catch(NestedValidationException $exception) {
            throw new skillsException($exception->getFullMessage());
        }
    }
}