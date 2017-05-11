<?php

include "../common.php";

class Foo {

    public $pub;

    protected $pro;

    private $pri;


    /**
     * Wywoływany przy tworzeniu obiektu
     */
    function __construct()
    {
        $this->pub = [1,2,3];
        $this->pro = 'Ala ma kota';

        echoit("__construct");
    }

    /**
     * Jest wywoływane przez garbage collector jak tylko nie ma do niego referencji
     */
    function __destruct()
    {
        echoit("__destruct");
    }

    /**
     * Kiedy prosimy o metodę w object context
     */
    function __call($name, $arguments)
    {
        echoit("__call: " . $name . "|" . serialize($arguments));
    }

    /**
     * Kiedy prosimy o metodę w static context
     */
    static function __callStatic($name, $arguments)
    {
        echoit("__callStatic: " . $name . "|" . serialize($arguments));
    }

    /**
     * Jest uruchamiana jest wywołujemy obiekt jako funkcję
     */
    function __invoke()
    {
        echoit("__invoke: ");
    }

    /**
     * Dostęp do atrybutu. Działa tylko w object context
     */
    function __get($name)
    {
        echoit("__get: " . $name);
    }

    /**
     * Dostęp do atrybutu. Działa tylko w object context
     */
    function __set($name, $value)
    {
        echoit("__set: " . $name . "|" . serialize($value));
    }

    /**
     * Dostęp do atrybutu. Działa tylko w object context
     */
    function __isset($name)
    {
        echoit("__isset: " . $name);
    }

    /**
     * Dostęp do atrybutu. Działa tylko w object context
     */
    function __unset($name)
    {
        echoit("__unset: " . $name);
    }

    /**
     * Musi zwrócić string
     */
    function __toString()
    {
        return self::class;
    }

    /**
     * Jest wywołany przez serialize() jeżeli klasa implementuje.
     * Musi zwrócić tablicę wszystkich pól które mają być zserializowane.
     */
    function __sleep()
    {
        return ['pub', 'pro'];
    }

    /**
     * Jest wywoływana przez unserialize i ma na przykład przywrócić połączenie z bazą danych
     */
    function __wakeup()
    {
        $this->pro = 'Trololo';
    }

    /**
     * Uruchamiana przez var_export, co da nam stringa, żeby utworzyć obiekt i ustawić jego właściwości.
     * var_export NIE SPRAWDZA czy ta metoda jest zaimplementowana, a jak nie to się wyjebie
     */
    static function __set_state($properties)
    {
        $foo = new Foo();
        $foo->pub = $properties['pub'];
        $foo->pro = $properties['pro'];
        $foo->pri = $properties['pri'];

        return $foo;
    }

    /**
     * Uruchamiana PO klonowaniu obiektu.
     */
    function __clone()
    {
        $this->pri = 'Po klonowaniu';
    }

    /**
     * Uruchamiana przez var_dump, zwraca tablicę co ma się wyświetlić.
     * Jak nie jest zdefiniowana to wszystkie atrybuty: public, protected, private są dumpowane
     */
    function __debugInfo()
    {
        return [
            'trololo' => 123,
            'obiekt' => get_object_vars($this), // jak tu się da $this, to zwraca NFC czyli chyba nested function call
        ];
    }
}


// --------------------------------------------------------

echoith("-- __destruct");

$foo = new Foo();
echoit("middle");
$foo = null;

echoit("-- eo __destruct");

// --------------------------------------------------------

echoith("-- __call");

$foo = new Foo();
$foo->asd(123);

echoit("-- eo __call");

// --------------------------------------------------------

echoith("-- __callStatic");

$foo = new Foo();
$foo::asdasd(123);
Foo::dsadsa(321);

echoit("-- eo __callStatic");

// --------------------------------------------------------

echoith("-- __set, __get, __isset, __unset");

$foo = new Foo();
$foo->asd;
$foo->asd = 123;
isset($foo->asd);
unset($foo->asd);

echoit("-- __set, __get, __isset, __unset");

// --------------------------------------------------------

echoith("-- __sleep, __wakeup");

$foo = new Foo();
$serializedFoo = serialize($foo);
echoit( $serializedFoo );

$foo2 = unserialize($serializedFoo);
var_dump($foo2);

echoit("-- eo __sleep, __wakeup");

// --------------------------------------------------------

echoith("-- __invoke");

$foo = new Foo();
$foo();

echoit("-- eo __invoke");

// --------------------------------------------------------

echoith("-- __set_state");

$foo = new Foo();
echoit( var_export($foo, true) );

$foo2 = Foo::__set_state(array(
    'pub' =>
        array (
            0 => 1,
            1 => 2,
            2 => 3,
        ),
    'pro' => 'Ala ma kota',
    'pri' => NULL,
));

var_dump($foo2);

echoit("-- eo  __set_state");

// --------------------------------------------------------

echoith("-- __clone");

$foo = new Foo();
$fooCloned = clone $foo;
var_dump($fooCloned);

echoit("-- __clone");

// --------------------------------------------------------

echoith("-- __debugInfo");

$foo = new Foo();
var_dump( $foo );

echoit("-- __debugInfo");
