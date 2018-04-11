<?php

namespace game\fighters\skills\listing;

use game\fighters\actions\attack;

interface skill{
    function getType() : string ;
    function getName() : string ;
    function getChance() : float ;
    function run( attack $attack) : void ;
}
