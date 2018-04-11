<?php

if( !function_exists('checkProbability') ) {
    function checkProbability(float $value): bool
    {
        if( $value == 0 ){
            return false;
        }
        return mt_rand(1, 100) <= $value;
    }
}