<?php

include "../common.php";

// finally

try {
    throw new \Exception();
} catch (\Exception $e) {
    echoit( "\Exception catch");
} finally {
    echoit('and finally');
}

try {
    echoit("Bez wyjatku");
} catch (\Exception $e) {
    echoit( "\Exception catch");
} finally {
    echoit('and finally');
}

// ------------------------------------------------------------------------

// variadic functions ...

function test($a, ...$params)
{
    echoit($a);
    var_dump($params);
}

test(1, 'asd', []);

$params = ['Ala ma kota', 2, 4];
echoit( substr(...$params) ); // 'a ma'

// ------------------------------------------------------------------------

// 5.6 - ** operator
echoit( 2 ** 3 );

// ------------------------------------------------------------------------
