<?php

namespace game;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

trait gameValidation{
    private static $instance = false;
    /**
     * @var v $validateAddPlayer
     */
    private static $validateAddPlayer;
    /**
     * @var v $validateTeam
     */
    private static $validateTeam;
    /**
     * @var v $validateRemoveFromTeam
     */
    private static $validateRemoveFromTeam;
    /**
     * @var v $validateStartGame
     */
    private static $validateStartGame;
    /**
     * @var v $validateEndRound
     */
    private static $validateEndRound;


    private static function checkInstance(){
        if( self::$instance === true ){
            return true;
        }
        self::$validateTeam = v::attribute('team', v::stringType()->in(['white', 'black']));
        self::$validateAddPlayer = v::attribute('team', v::stringType()->in(['white', 'black']))
                                    ->attribute('fighterType', v::stringType()->in(['hero', 'beast']))
                                    ->attribute('fighterName', v::stringType()->length(1,120))
                                    ->attribute('skills', v::arrayVal());
        self::$validateRemoveFromTeam = v::attribute('team', v::stringType()->in(['white', 'black']))
                                        ->attribute('index', v::numeric());
        self::$validateStartGame = v::attribute('whiteTeam', v::arrayVal()->length(1 ))
                                    ->attribute('blackTeam', v::arrayVal()->length(1 ));
        self::$validateEndRound = v::attribute('endRound', v::numeric());
        self::$instance = true;
    }

    public static function validateAddPlayer(string $team = '', string $fighterType = '', string $fighterName = '', array $skills = []){
        self::checkInstance();
        $test = new \stdClass();
        $test->team = $team;
        $test->fighterType = $fighterType;
        $test->fighterName = $fighterName;
        $test->skills = $skills;

        try {
            self::$validateAddPlayer->assert($test);
        } catch(NestedValidationException $exception) {
            throw new gameException($exception->getFullMessage());
        }
    }

    public static function validateTeam( string $team = '' ){
        self::checkInstance();
        $test = new \stdClass();
        $test->team = $team;

        try {
            self::$validateTeam->assert($test);
        } catch(NestedValidationException $exception) {
            throw new gameException($exception->getFullMessage());
        }
    }

    public static function validateRemoveFromTeam( string $team = '', int $index = null){
        self::checkInstance();
        $test = new \stdClass();
        $test->team = $team;
        $test->index = $index;

        try {
            self::$validateRemoveFromTeam->assert($test);
        } catch(NestedValidationException $exception) {
            throw new gameException($exception->getFullMessage());
        }
    }

    public static function validateStartGame( array $whiteTeam = [], array $blackTeam = [] ){
        self::checkInstance();

        $test = new \stdClass();
        $test->whiteTeam = $whiteTeam;
        $test->blackTeam = $blackTeam;

        try {
            self::$validateStartGame->assert($test);
        } catch(NestedValidationException $exception) {
            throw new gameException($exception->getFullMessage());
        }

        $fighters = array_merge( $whiteTeam, $blackTeam );

        foreach ($fighters as $fighter){
            if( !v::objectType()->instance('game\fighters\fighter')->validate($fighter) ){
                throw new gameException('Unul dintre jucatori nu are instanta corecta');
            }
        }
    }

    public static function validateEndRound( $endRound = null ){
        self::checkInstance();
        $test = new \stdClass();
        $test->endRound = $endRound;

        try {
            self::$validateEndRound->assert($test);
        } catch(NestedValidationException $exception) {
            throw new gameException($exception->getFullMessage());
        }
    }
}