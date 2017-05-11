<?php

// echo '123'; // rzuci błędem Namespace declaration statement has to be the very first statement in the script in
// nie można też wcześniej dać <html>
// include "../common.php"; - to tez
// define('bar', 123); - to tez

//declare(encoding='UTF-8'); // jest OK, mogą być tez ticks - można odpalić jakąś funkcję co ileś ticków (czyli wykonanych statementów)

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

    // w globalnym __NAMESPACE__ jest puste
    \foo\bar\echoit( __NAMESPACE__ );

    // ------------------------------------------------------------------------

    // słowo kluczowe namespace wskazuje na aktualny namespace
    // w globalnym namespace wskazuje na globalny, tak po prostu

    $c = new namespace\A();

    namespace\bar\echoit( namespace\bar\TRO );

    \foo\bar\echoit( INI_ALL );

}