<?php
namespace foo\bar;

echo "<pre>";

function hr(){
    echo "<hr/>";
}

function echoit($string) {
    echo "{$string}\n";
}

function echoith($string) {
    hr();
    echoit($string);
}

echoit( __NAMESPACE__ );

CONST TRO = 123;