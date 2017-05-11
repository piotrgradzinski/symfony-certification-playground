<?php

include '../common.php';

// http://stackoverflow.com/questions/1912902/what-exactly-are-late-static-bindings-in-php
// http://php.net/manual/en/language.oop5.late-static-bindings.php

/**
 * static:: will not be resolved using the class where the method is defined but it will rather be computed using runtime information
 *
 * late static bindings work by storing the class named in the last "non-forwarding call". In case of static method calls, this is the class explicitly named (usually the one on the left of the :: operator); in case of non-static method calls, it is the class of the object.
 */

class Car
{
    public static function run()
    {
        return static::getName();
    }

    private static function getName()
    {
        return 'Car';
    }
}

class Toyota extends Car
{
    public static function getName()
    {
        return 'Toyota';
    }
}

/**
 * Jak w linijce 12 zmienimy static na self to
 * echoit( Toyota::run() );
 * wyświetli Car
 */

echoit( Car::run() ); // Output: Car
echoit( Toyota::run() ); // Output: Toyota


// ------------------------------------------------------------------------



class A {
    public static function run()
    {
        return self::getName();
    }

    public static function getName()
    {
        return 'A';
    }
}

class B extends A {
    public static function run()
    {
        return static::getName();
    }

    public static function getName()
    {
        return 'B';
    }
}

class C extends B {
    public static function getName()
    {
        return 'C';
    }
}

echoit( B::run() );
echoit( C::run() );



// ------------------------------------------------------------------------



class A1 {
    public static function foo() {
        echoit('foo A1');
        static::who();
    }

    public static function who() {
        echoit(__CLASS__." in A1\n");
    }
}

class B1 extends A1 {
    public static function test() {
        A1::foo();
        parent::foo();
        self::foo();
    }

    public static function who() {
        echoit(__CLASS__." in B1\n");
    }
}
class C1 extends B1 {
    public static function who() {
        echoit(__CLASS__." in C1\n");
    }
}

C1::test();


// ------------------------------------------------------------------------


class alpha {

    function classname(){
        return __CLASS__;
    }

    function selfname(){
        return self::classname();
    }

    function staticname(){
        return static::classname();
    }
}

class beta extends alpha {

    function classname(){
        return __CLASS__;
    }
}

$beta = new beta();
echoit($beta->selfname()); // Output: alpha
echoit($beta->staticname()); // Output: beta

