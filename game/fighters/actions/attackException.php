<?php

namespace game\fighters\actions;

use Throwable;

class attackException extends \Exception {
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if( getConfigItem('debug') === true ){
            $this->message = "Atacul are o eroare cu mesajul :'{$this->getMessage()}' <br/>
                din fisierul : {$this->getFile()} ({$this->getLine()}) <br/>
                apelat din urmatoarele : {$this->getTraceAsString()}";
        }else{
            $this->message = "Atacul are o eroare va rugam contactati echipa de suport !";
        }
    }
}