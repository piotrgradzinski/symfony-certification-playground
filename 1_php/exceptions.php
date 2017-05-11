<?php

include "../common.php";

try {
    echoit(123);
} finally {
    echoit(321);
}


// ------------------------------------------------------------------------


class MyEx extends Exception {}
class MyEx2 extends MyEx {}

try {

    throw new MyEx();

} catch (\MyEx $e) {
    echoit('MyEx');
} catch (\Exception $e) {
    echoit('Exception');
}

try {

    throw new MyEx2();

} catch (\MyEx2 $e) { // jakby był po \MyEx, to nie został by złapany, brany jest pierwszy
    echoit('MyEx2');
    // throw $e; - powinna być obsługa poza tym blokiem try/catch
} catch (\MyEx $e) {
    echoit('MyEx');
} catch (\Exception $e) {
    echoit('Exception');
}


// ------------------------------------------------------------------------
echoith();

try {

    try {

        throw new MyEx();

    } catch (\MyEx $e) {
        echoit('MyEx1');
        throw $e;
    } catch (\Exception $e) {
        echoit('Exception1');
    }

} catch (\MyEx $e) {
    echoit('MyEx2');
} catch (\Exception $e) {
    echoit('Exception2');
}


// ------------------------------------------------------------------------


echoith();

try {

    try {

        throw new MyEx();

    } catch (\Exception $e) {
        echoit('Exception1');
        throw $e;
    }

} catch (\MyEx $e) {
    echoit('MyEx2');
} catch (\Exception $e) {
    echoit('Exception2');
}

