<?php

include "../../common.php";

$varFromSourceFile = include "source.php";

var_dump($var); // Output: 123
var_dump($varFromSourceFile); // Output: 123