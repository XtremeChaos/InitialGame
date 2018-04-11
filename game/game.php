<?php

namespace game;

use game\fighters\fighter;
use game\fighters\hero;
use game\fighters\beast;

use core;

class game{

    use gameValidation;

    public $whiteTeam = [];
    public $blackTeam = [];
    private $whiteTeamCurrentAttacker = 0;
    private $blackTeamCurrentAttacker = 0;
    private $round = 0;
    private $endRound = 20;

    private function increaseRound(){
        $this->round++;
    }

    private function getRound(){
        return $this->round;
    }

    public function setEndRound( $endRound = null ){
        gameValidation::validateEndRound($endRound );
        $this->endRound = $endRound;
    }

    private function getEndRound(){
        return $this->endRound;
    }

    private function addWhiteTeam( fighter $fighter) : void {
        array_push($this->whiteTeam,$fighter);
    }

    private function addBlackTeam( fighter $fighter) : void {
        array_push($this->blackTeam,$fighter);
    }

    public function addPlayer( string $team = '', string $fighterType = '', string $fighterName = '', array $skills = [] ) : void {
        gameValidation::validateAddPlayer($team,$fighterType,$fighterName,$skills);
        $fighter = null;
        switch ($fighterType){
            case 'hero':
                $fighter = new hero($fighterName,$skills);
                break;
            case 'beast':
                $fighter = new beast($fighterName,$skills);
                break;
        }

        switch ($team){
            case 'white':
                $this->addWhiteTeam($fighter);
                break;
            case 'black':
                $this->addBlackTeam($fighter);
                break;
        }

    }

    private function hasTeamMembers( string $team = '' ) : bool {
        gameValidation::validateTeam( $team );
        $fighters = $this->getTeam( $team );
        return count( $fighters ) != 0;
    }

    public function startGame() : bool {
        gameValidation::validateStartGame( $this->getWhiteTeam(), $this->getBlackTeam() );
        $this->sortTeam('white');
        $this->sortTeam('black');

        $fastestWhiteFighter = $this->getFastestFighter('white');
        $fastestBlackFighter = $this->getFastestFighter('black');

        $startTeamName = $this->checkFirstAttacker( $fastestWhiteFighter, $fastestBlackFighter );

        gameLogs::addStats(['white'=> $this->getWhiteTeam(), 'black' => $this->getBlackTeam()]);
        gameLogs::add('Incepe echipa '.$startTeamName);

        $game = $this->startRound($startTeamName);

        if( $game === false ){
            gameLogs::add('A aparut o problema');
            return false;
        }

        gameLogs::add('Jocul s-a terminat');

        gameLogs::addStats(['white'=> $this->getWhiteTeam(), 'black' => $this->getBlackTeam()]);
        return true;
    }

    private function startRound( string $startTeam = '' ) : bool {
        gameValidation::validateTeam( $startTeam );
        $this->increaseRound();
        if( $this->checkEndGameByRound() ){
            gameLogs::add("Runda {$this->getEndRound()} s-a incheiat. Este egalitate");
            return true;
        }
        gameLogs::add("Incepe runda {$this->getRound()} ");
        switch ($startTeam){
            case 'white':
                $attacker = $this->getTeamAttacker('white');
                $defender = $this->getTeamDefender('black');

                gameLogs::add("Ataca {$attacker->getName()} cu puterea {$attacker->getStrength()} pe {$defender->getName()} care are {$defender->getDefence()} aparare si {$defender->getHealthRemained()} viata ramasa");
                $attack = $attacker->attack();

                $defender->defend($attack);

                if( $defender->isDead() ){
                    gameLogs::add('A murit membrul echipei Black : '.$defender->getName());
                    $this->removeFromTeam('black',0);

                    if( !$this->hasTeamMembers('black') ){
                        gameLogs::add('Echipa Black a pierdut !');
                        return true;
                    }
                }

                $this->nextTeamAttacker('white');

                return $this->startRound('black');
                break;
            case 'black':
                $attacker = $this->getTeamAttacker( 'black' );
                $defender = $this->getTeamDefender('white');

                gameLogs::add("Ataca {$attacker->getName()} cu puterea {$attacker->getStrength()} pe {$defender->getName()} care are {$defender->getDefence()} aparare si {$defender->getHealthRemained()} viata ramasa");
                $attack = $attacker->attack();

                $defender->defend($attack);

                if( $defender->isDead() ){
                    gameLogs::add('A murit membrul echipei White : '.$defender->getName());

                    $this->removeFromTeam('white',0 );

                    if( !$this->hasTeamMembers('white') ){
                        gameLogs::add('Echipa White a pierdut !!');
                        return true;
                    }
                }

                $this->nextTeamAttacker('black');
                return $this->startRound('white');
                break;
        }

        return false;

    }

    private function nextTeamAttacker( string $team = '' ) : void {
        gameValidation::validateTeam( $team );
        switch ($team){
            case 'white':
                $this->nextWhiteTeamAttacker();
                break;
            case 'black':
                $this->nextBlackTeamAttacker();
                break;
        }
    }

    private function nextWhiteTeamAttacker() : void {
        $this->whiteTeamCurrentAttacker += 1;

        if( $this->whiteTeamCurrentAttacker > count($this->whiteTeam) - 1 ){
            $this->whiteTeamCurrentAttacker = 0;
        }
    }

    private function nextBlackTeamAttacker() : void {
        $this->blackTeamCurrentAttacker += 1;

        if( $this->blackTeamCurrentAttacker > count($this->blackTeam) - 1 ){
            $this->blackTeamCurrentAttacker = 0;
        }
    }

    private function getTeamDefender( string $team = '' ) : fighter {
        gameValidation::validateTeam( $team );
        $fighters = $this->getTeam( $team );
        return $fighters[0];
    }

    private function getTeamCurrentAttackerIndex( string $team = '' ) : int{
        gameValidation::validateTeam( $team );
        $index = null;
        switch ($team){
            case 'white':
                $index = $this->whiteTeamCurrentAttacker;
                break;
            case 'black':
                $index = $this->blackTeamCurrentAttacker;
                break;
        }
        return $index;
    }

    private function getTeamAttacker( string $team = '' ) : fighter{
        gameValidation::validateTeam( $team );
        $teamFighters = $this->getTeam( $team );
        $current = $this->getTeamCurrentAttackerIndex( $team );
        if( empty($teamFighters[$current]) ){
            $this->nextTeamAttacker( $team );
        }
        $current = $this->getTeamCurrentAttackerIndex( $team );
        return $teamFighters[$current];
    }

    private function removeFromTeam( string $team = '', int $index = null ) : void{
        gameValidation::validateRemoveFromTeam( $team, $index);
        switch ($team){
            case 'white':
                unset($this->whiteTeam[$index]);
                break;
            case 'black':
                unset($this->blackTeam[$index]);
                break;
        }
        $this->sortTeam($team);
    }

    private function getFastestFighter( string $team ) : fighter {
        gameValidation::validateTeam( $team );
        $fighters = $this->getTeam( $team );
        $fastestFighter = null;
        $fighterBestSpeed = 0;
        foreach( $fighters as $fighter ){
            /**
             * @var fighter $fighter
             */
            if( $fighter->getSpeed() > $fighterBestSpeed ){
                $fighterBestSpeed = $fighter->getSpeed();
                $fastestFighter = $fighter;
            }
        }
        return $fastestFighter;
    }

    private function checkFirstAttacker( fighter $white, fighter $black) : string {
        if( $white->getSpeed() == $black->getSpeed() ){
            return $white->getLuck() >= $black->getLuck() ? 'white' : 'black';
        }
        return $white->getSpeed() > $black->getSpeed() ? 'white' : 'black';
    }

    private function sortTeam( string $team = '' ) : void {
        gameValidation::validateTeam( $team );
        usort($this->{$team.'Team'},array('\game\game','compareFightersSpeeds') );
    }

    public function getTeam( string $team ) : array {
        gameValidation::validateTeam( $team );
        $fighters = [];
        switch ($team){
            case 'white':
                $fighters = $this->getWhiteTeam();
                break;
            case 'black':
                $fighters = $this->getBlackTeam();
                break;
        }
        return $fighters;
    }

    private function getWhiteTeam() : array {
        return $this->whiteTeam;
    }

    private function getBlackTeam() : array {
        return $this->blackTeam;
    }

    private function compareFightersSpeeds(fighter $fighterA, fighter $fighterB ) : int {
        if( $fighterA->getSpeed() == $fighterB->getSpeed() ){
            if( $fighterA->getLuck() == $fighterB->getLuck() ){
                return 0;
            }
            if( $fighterA->getLuck() > $fighterB->getLuck() ){
                return -1;
            }
            return 1;
        }

        return $fighterA->getSpeed() > $fighterB->getSpeed() ? -1 : 1;
    }

    private function checkEndGameByRound() : bool {
        return $this->getRound() > $this->getEndRound();
    }
}
