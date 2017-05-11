<?php

include "../common.php";

// ------------------------------------------------------------------------
// OOP
// ------------------------------------------------------------------------

class A {

    public $asd = 123;

    public function __construct()
    {
        return false;
    }
}

$a = new A();

// ------------------------------------------------------------------------

class Test
{
    static public function getNew()
    {
        return new static; // jak będzie self to przy obj4 będzie false, bo nie będzie klasy child tylko Test
    }
}

class Child extends Test
{}

$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2);

$obj3 = Test::getNew();
var_dump($obj3 instanceof Test);

$obj4 = Child::getNew();
var_dump($obj4 instanceof Child);

// ------------------------------------------------------------------------

class Foo
{
    public $bar;

    public function __construct() {
        $this->bar = function() {
            return 42;
        };
    }
}

$obj = new Foo();

// as of PHP 5.3.0:
$func = $obj->bar;
echoit( $func() );

// ------------------------------------------------------------------------

class A1 {

    public $a = 1;
    public static $b = 2;

    CONST A = 1;

    public function afun()
    {
        echoit( $this->a );
    }

    public static function bfun()
    {
        echoit( static::$b );
    }

    public function __construct()
    {
    }

}

class B1 extends A1 {
    public $a = 11;
    public static $b = 22;

    CONST A = 2;

    public function afun($param) // to przejdzie, bo po nazwie metody, ale będzie się pluło notice E_STRICT, bo sygnatura powinna być ta sama
    {
        echoit( $this->a );
    }

    public function __construct($param) // ale tu już będzie OK, w __construct można i będzie bez stricta
    {
    }
}

$a = new A1();
$b = new B1(321);

$a->afun();
$b->afun(123);

A1::bfun();
B1::bfun();
//B1::A = 321; // nie można poza dziedziczeniem
B1::A; // można zmieniać wartość stałej!

// ------------------------------------------------------------------------

class A2
{
    private $foo;

    CONST LOLO = 123 + 123;

    public static $staticVariable = 111;


    public function __construct($foo)
    {
        $this->foo = $foo;
        echoit(static::LOLO);
    }

    private function bar()
    {
        echo 'Accessed the private method.';
    }

    public static function baz(A2 $other) // to dziala przy staticu i bez statica
    {
        // We can change the private property:
        $other->foo = 'hello';
        var_dump($other->foo);

        // We can also call the private method:
        $other->bar();
    }

    public function test()
    {
        echoit('static test');
    }
}

$test = new A2('test');

A2::baz(new A2('other'));
A2::test(); // będzie warning E_STRICT

//echoit( $test->staticVariable ); // undefined variable
echoit( A2::$staticVariable );



// ------------------------------------------------------------------------



class A3 {
    public function test($a){
        echoit(123);
    }
}

class B3 extends A3 {
    public function test($b, $c=123){ // jest OK, możemy przy dziedziczeniu dodać argumenty domyślne
        echoit(123);
    }
}
