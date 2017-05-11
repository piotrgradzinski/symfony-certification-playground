<?php

/**
 * Just some ordinary setup for easier var_dump()
 */

echo "<pre>";

function hr(){
    echo "<hr/>";
}

function echoit($string='') {
    echo "{$string}\n";
}

function echoith($string='') {
    hr();
    echoit($string);
}