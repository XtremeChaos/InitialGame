<?php

namespace game\fighters\actions;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

trait attackValidation{

    private static $instance = false;

    /**
     * @var v $validateStrength
     */
    private static $validateStrength;
    /**
     * @var v $validateMultiplier
     */
    private static $validateMultiplier;

    private static function checkInstance(){
        if( self::$instance === true ){
            return true;
        }
        self::$validateStrength = v::attribute('strength', v::numeric()->between(0,400));
        self::$validateMultiplier = v::attribute('multiplier', v::numeric()->between(0,30));

        self::$instance = true;
    }

    public static function validateStrength( $strength = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->strength = $strength;

        try {
            self::$validateStrength->assert($test);
        } catch(NestedValidationException $exception) {
            throw new attackException($exception->getFullMessage());
        }
    }

    public static function validateMultiplier( $multiplier = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->multiplier = $multiplier;

        try {
            self::$validateMultiplier->assert($test);
        } catch(NestedValidationException $exception) {
            throw new attackException($exception->getFullMessage());
        }
    }

}