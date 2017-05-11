<?php

include "../common.php";

function xrange($start, $limit, $step = 1) {
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
    return;
}

$gen = xrange(1,5);

echoit( xrange(1,5)->current() );
echoit( $gen->next() );
//echoit( $gen->rewind() ); // tu plunie błędem jeżeli się go wcześniej użyło metodą next
echoit( $gen->current() );

var_dump($gen); // Generator


foreach (xrange(1,10) as $val) {
    echoit( $val );
}

// ------------------------------------------------------------------------

function test()
{
    $t = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
    ];

    foreach ($t as $k => $v) {
        yield $k => $v;
    }

    return;
}

foreach (test() as $k => $v) {
    echoit( "$k -- $v");
}
foreach (test() as $v) {
    echoit( "$v");
}