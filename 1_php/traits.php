<?php

include "../common.php";

class Base {
    public function sayHello() {
        echoit('Hello ');
    }
}

trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echoit("World");
    }
}

class MyHelloWorld extends Base {
    // kilka traitów można użyć przez use A,B;
    // use SayWorld;
    use SayWorld {
        sayHello as protected traitSayHello;
    }

    /**
     * Bez tej metody będzie Hello World
     */
    public function sayHello() {
        echoit("Donk!");
        parent::sayHello();
        /**
         * Nie można się odwołać do metody z traita przez parent::, a nie ma czegoś takiego jak trait::
         * więc trzeba aliasować
         */
        $this->traitSayHello();
    }
}

$o = new MyHelloWorld();
$o->sayHello();

// ------------------------------------------------------------------------

trait A {
    public function sayHello() {
        echoit("A Hello");
    }
}

trait B {
    public function sayHello() {
        echoit("B Hello");
    }
}


class C {
    use A,B {
        /**
         * jak się A::sayHello insteadof B zakomentuje i nawet jak jest to co niżej, to i tak będzie błąć
         * as dodaje alias, ale to nie rozwiązuje konfliktu, bo jest
         */
        A::sayHello insteadof B;
        A::sayHello as aSayHello;
        B::sayHello as protected bSayHello; // można zmienić visibility przy okazji, bez aliasu można dać po prostu protected
    }

    public function sayHello() {
        echoit("C Hello");
    }
}

$c = new C();
$c->sayHello();
$c->aSayHello();
//$c->bSayHello(); // bedzie blad bo jest protected

// ------------------------------------------------------------------------


trait AA {

    public static $st = 111;
    private $toto = 123123123;

    public function sayHello() {
        static $i = 1;
        echoit("AA Hello " . $i++);
    }

    public static function staticFun() {
        echoit( 'AA Static' );
    }

    abstract protected function test();
}


class D {
    use AA;

    private $toto = 123123123; // E_STRICT notice
    // public $toto = 321; - to nie zadziała, będzie konflikt

    public function test()
    {
        echoit( $this->toto );
        echoit( self::$st );
        echoit("D Hello");
    }
}

$d = new D();
$d->test();
$d->sayHello();
$d->sayHello();
D::staticFun();
//echoit( $d->toto ); toto jest prywatne i będzie błąd


