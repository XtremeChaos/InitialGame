<?php

if( !function_exists('getConfigItem') ) {
    function getConfigItem(string $key)
    {
        if( isset($GLOBALS['config']) && isset($GLOBALS['config'][$key])){
            return $GLOBALS['config'][$key];
        }
        return null;
    }
}

