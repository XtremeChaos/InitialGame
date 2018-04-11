<?php
require_once __DIR__ . '/vendor/autoload.php';

use core\template\template;
use game\game;
use game\gameLogs;
use game\gameException;
use game\fighters\fighterException;
use game\fighters\actions\attackException;
use game\fighters\skills\skillsException;

try{

    $template = new template();
    $template->loadLayout('index.html.twig');

    $game = new game();

    $game->setEndRound(20);
    $game->addPlayer('white','hero','Eroul Orderus 1',['magicShield','rapidStrike']);
    $game->addPlayer('white','hero','Eroul Orderus 2',['rapidStrike']);
    $game->addPlayer('white','hero','Eroul Orderus 3',['magicShield']);
    $game->addPlayer('black','beast','Bestia Salbatica 1',['berserk']);
    $game->addPlayer('black','beast','Bestia Salbatica 2');
    $game->addPlayer('black','beast','Bestia Salbatica 3',['berserk']);

    $game->startGame();

    $data = [
        'start_stats' => gameLogs::getStats(0),
        'logs' => gameLogs::get(),
        'end_stats' => gameLogs::getStats(1)
    ];

    echo $template->render($data);

}catch (TypeError $e){
    if( getConfigItem('debug') ){
        echo $e->getMessage();
    }else{
        echo 'A aparut o eroare!';
    }
}catch ( Twig_Error $e ){
    echo $e->getMessage();
}catch ( gameException $e ){
    echo $e->getMessage();
}catch ( fighterException $e) {
    echo $e->getMessage();
}catch ( attackException $e ){
    echo $e->getMessage();
}catch ( skillsException $e ){
    echo $e->getMessage();
}catch ( Exception $e){
    echo $e->getMessage();
}


