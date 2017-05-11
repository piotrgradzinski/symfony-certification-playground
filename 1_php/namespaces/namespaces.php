<?php

// echo '123'; // rzuci błędem Namespace declaration statement has to be the very first statement in the script in
// nie można też wcześniej dać <html>
// include "../common.php"; - to tez
// define('bar', 123); - to tez

/**
 * You can use declare or ticks (http://php.net/manual/en/control-structures.declare.php#control-structures.declare.ticks)
 * which is useful do execute some function every X ticks - executed statements.
 */

namespace foo {
    include "common_namespace.php";

    class A {
        function test(){
            return strlen("asdd");
        }
    }

    $a = new \foo\A();
    \foo\bar\echoit(  $a->test() );
    bar\echoit(123);

//    foo\bar\echoit(  $a->test() ); nope
//    echoit(123); nope

    $t  = new A();
    $t1 = new \foo\A();
//    $t1 = new foo\A(); - nope

    // ------------------------------------------------------------------------

    /**
     * Note that because there is NO DIFFERENCE between a qualified and a fully qualified Name INSIDE A DYNAMIC class name,
     * function name, or constant name, the leading backslash is not necessary.
     */

    $c = 'foo\A';
    $t2 = new $c();

    $c = '\foo\A';
    $t2 = new $c();

    $c = 'A';
//    $t2 = new $c(); - nope

    // ------------------------------------------------------------------------

    // in global scope __NAMESPACE__ IS EMPTY
    \foo\bar\echoit( __NAMESPACE__ );

    // ------------------------------------------------------------------------

    // keyword namespace points to the current namespace,
    // in global scope points to global scope :)

    $c = new namespace\A();

    namespace\bar\echoit( namespace\bar\TRO );

    \foo\bar\echoit( INI_ALL );

}