<?php

namespace game\fighters;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

trait fighterValidation{

    private static $instance = false;

    /**
     * @var v $validateName
     */
    private static $validateName;
    /**
     * @var v $validateHealth
     */
    private static $validateHealth;
    /**
     * @var v $validateHealthRemained
     */
    private static $validateHealthRemained;
    /**
     * @var v $validateStrength
     */
    private static $validateStrength;
    /**
     * @var v $validateDefence
     */
    private static $validateDefence;
    /**
     * @var v $validateSpeed
     */
    private static $validateSpeed;
    /**
     * @var v $validateLuck
     */
    private static $validateLuck;

    private static function checkInstance(){
        if( self::$instance === true ){
            return true;
        }
        self::$validateName = v::attribute('name', v::stringType()->length(1,120));
        self::$validateHealth = v::attribute('health', v::numeric()->between(1,120));
        self::$validateHealthRemained = v::attribute('health_remained', v::numeric()->between(-240,120));
        self::$validateStrength = v::attribute('strength', v::numeric()->between(1,120));
        self::$validateDefence = v::attribute('defence', v::numeric()->between(1,120));
        self::$validateSpeed = v::attribute('speed', v::numeric()->between(1,120));
        self::$validateLuck = v::attribute('luck', v::numeric()->between(0,120));

        self::$instance = true;
    }

    public static function validateName( $name = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->name = $name;

        try {
            self::$validateName->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateHealth( $health = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->health = $health;

        try {
            self::$validateHealth->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateHealthRemained( $health_remained = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->health_remained = $health_remained;

        try {
            self::$validateHealthRemained->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateStrength( $strength = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->strength = $strength;

        try {
            self::$validateStrength->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateDefence( $defence = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->defence = $defence;

        try {
            self::$validateDefence->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateSpeed( $speed = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->speed = $speed;

        try {
            self::$validateSpeed->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

    public static function validateLuck( $luck = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->luck = $luck;

        try {
            self::$validateLuck->assert($test);
        } catch(NestedValidationException $exception) {
            throw new fighterException($exception->getFullMessage());
        }
    }

}

