<?php

/**
 * File: class.abstract.php
 *
 * @author      Piotr Grabski-Gradziński <piotr.gradzinski@vml.com>
 * @copyright   Copyright (C) 2017 VML. All rights reserved.
 */


/**
 * - modyfikatory dostępu: w klasie dziedziczącej taki sam albo słabszy, a nie bardziej restrykcyjny
 * - w metodzie dziedziczacej można dodawać tylko parametry domyślne - sygnatura musi być zgodna
 */
abstract class Base {

    abstract protected function test($param);

}

class Concrete extends Base {

    public function test($param, $param2 = '123')
    {
        echo "test()";
    }
}

$c = new Concrete();
$c->test(123);



/**
 * - jeżeli nie implementujemy wszystkich metod to klasa musi być oznaczona jako abstract
 * - nie można zadeklarować tej samej metody jako abstrakcyknej nawet jak są inne parametry, wielkość liter w nazwie
 * nie ma znaczenia: abstract protected function Test($param, $param2); - musi byc inna nazwa - test2.
 */
abstract class Base2 extends Base {
    abstract protected function test2($param);
}

class Conrete2 extends Base2 {

    public function test($param)
    {
        echo "test()";
    }

    public function test2($param)
    {
        echo "test2()";
    }
}

$c2 = new Conrete2();
$c2->test(1);
$c2->test2(2);

