<?php

include "../common.php";

$foo = function () {
  echo 123;
};

$foo();
var_dump($foo); // object(Closure)[1]

// --------------------------------------------------------

/*
 * Closures may also inherit variables from the parent scope. Any such variables must be passed to the use language construct. From PHP 7.1, these variables must not include superglobals, $this, or variables with the same name as a parameter.
 */

class Foo {

    static $stat = 'ala ma kota';

    protected $test = 123;

    public function bar()
    {
        return function () {
            var_dump($this);
        };
    }

    public function bar53()
    {
        $tenObiekt = $this;
        return function () use ($tenObiekt) {
            var_dump($this);
        };
    }

    public function barStatic()
    {
        return static function (){
            var_dump($this);
            var_dump(self::$stat);
        };
    }
}

class Bar {

}

/**
 * Od PHP 5.4 $this jest automatycznie dopinany jeżeli zdefiniujemy doknięcie w ramach klasy,
 * w 5.3 rzuci błędem - trzeba ręcznie przekazać this, ale przez osobą zmienną.
 */
$foo = new Foo();
$bar = $foo->bar();
$bar53 = $foo->bar53();
$bar();
$bar53();

// --------------------------------------------------------

/**
 * od 5.4 statyczne funkcje anonimowe - chodzi o to, że zdefiniowane w klasie mają nie mieć dostępu do this.
 * ale widać, że jest podpięta pod klasę, bo ma dostęp do static scope
 */
$barStatic = $foo->barStatic();
$barStatic();

// --------------------------------------------------------

/*
Closure {
    5.3 private __construct ( void ) - jest tylko po to, żeby nie dało się go wykonać
    5.4 public static Closure bind ( Closure $closure , object $newthis [, mixed $newscope = "static" ] )
    5.4 public Closure bindTo ( object $newthis [, mixed $newscope = "static" ] )
    7.0 public mixed call ( object $newthis [, mixed $... ] )
    7.1 public static Closure fromCallable ( callable $callable )
}
*/

$foo = new Foo();
$bar = new Bar();
$dumper = function () {
    var_dump($this);
};

/**
 * 1 - domknciecie - zostanie SKOPIOWANE
 * 2 - obiekt do którego dopinamy domknięcie albo null jak chcemy go odpiąć
 * 3 - scope: static - zostaje aktualny, obiekt/nazwa klasy - do jakiego zasiegu dopinamy, nie można klas wewnętrznych php (od 7.0)
 */
$newDumper = Closure::bind($dumper, $foo, $bar);
$newDumper();


// to jest nie statyczna wersja
$foo = new Foo();
$bar = new Bar();
$dumper = function () {
    var_dump($this);
};

$newDumper = $dumper->bindTo($foo, $foo);
$newDumper();


// call
$foo = new Foo();
$bar = new Bar();
$dumper = function ($a) {
    var_dump($this);
    var_dump($a);
};

// binduje domknięcie do obiektu i uruchamia domknięcie z parametrami
// $dumper->call($foo, 123); -> działa od 7.0
