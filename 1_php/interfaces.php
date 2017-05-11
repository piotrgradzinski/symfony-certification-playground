<?php

include "../common.php";

interface iA {
    public function testA();
    public static function testS();
    public function testDziedziczenia($param);
}

interface iC {
    public function testC();
}

interface iB extends iA { // nie można dziedziczyć po kilku interfejsach
    CONST ibConst = 123;
    public function testDziedziczenia($param); // jak się doda wartość domyślną, to też będzie błąd
//    public function testDziedziczenia($param, $param2); // sygnatury muszą być te same, plunie błędem
}

class A implements iA, iB {

//    CONST ibConst = 123; - bedzie błąd

    public function testA()
    {
        echoit('testA');
        echoit( self::ibConst );
    }

    public static function testS()
    {
        echoit( "testS");
    }

    public function testDziedziczenia($param, $lol=123)
    {
        echoit( "testDziedzieczenia");
    }
}

$a = new A();
$a->testA();
$a->testDziedziczenia(123);
A::testS();
