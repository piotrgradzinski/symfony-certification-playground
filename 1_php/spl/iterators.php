<?php

include "../../common.php";

$tab = array(1,2,3,4,5,6,7,8,9,10,123);

$itArray = new ArrayIterator($tab);

foreach ($itArray as $k => $v) {
    echoit("$k => $v");
}

echoit( $itArray->count() );

// ------------------------------------------------------------------------
echoith();


/**
 * ITERATOR AGGREGATE
 */
class Tech implements IteratorAggregate {

    private $tech = "PHP,XML,HTML,.NET";

    public function getIterator()
    {
        $tab = explode(',', $this->tech);
        return new ArrayIterator($tab);
    }
}

$tech = new Tech();
foreach ($tech as $k => $v) {
    echoit("$k => $v");
}

// ------------------------------------------------------------------------
echoith();

/**
 * APPEND ITERATOR
 */
$it1 = new ArrayIterator($tab);
$it2 = new ArrayIterator(array_reverse($tab));

$appendIterator = new AppendIterator();
$appendIterator->append($it1);
$appendIterator->append($it2);

foreach ($appendIterator as $k => $v) {
    echoit("$k => $v");
}

// ------------------------------------------------------------------------
echoith();

/**
 * ARRAY ITERATOR
 */
$arrayIterator = new ArrayIterator($tab);
$arrayIterator[2] = 'asd';

foreach ($arrayIterator as $k => $v) {
    echoit("$k => $v");
}

var_dump( $arrayIterator->getArrayCopy() );

// ------------------------------------------------------------------------
echoith();

/**
 * CALLBACK FILTER ITERATOR
 */
$callback = function ($current, $key, $iterator) {
    return is_numeric($current) && $current%2 == 0 ? true : false;
};

$callbackIterator = new CallbackFilterIterator(new ArrayIterator($tab), $callback);
foreach ($callbackIterator as $k => $v) {
    echoit("$k => $v");
}

// ------------------------------------------------------------------------
echoith();

/**
 * DIRECTORY ITERATOR
 */
$directoryIterator = new DirectoryIterator('.');
foreach ($directoryIterator as $k => $v) {
    echoit("$k => $v | " . ((int)$v->isDot())); // $v is the instance of DirectoryIterator, which extends SplFileInfo
}

// ------------------------------------------------------------------------
echoith();

/**
 * EMPTY ITERATOR
 */
$emptyIterator = new EmptyIterator();
foreach ($emptyIterator as $k => $v) {
    echoit("$k => $v");
}

// ------------------------------------------------------------------------
echoith();

/**
 * FILESYSTEM ITERATOR
 */
$filesystemIterator = new FilesystemIterator('.');
foreach ($filesystemIterator as $k => $v) {
    echoit("$k => $v" ); // $v is the instance of SplFileInfo
}

// ------------------------------------------------------------------------
echoith();

/**
 * GLOB ITERATOR
 */
$globIterator = new GlobIterator('*.php'); // this one as well as glob() is not working recursively on its own
foreach ($globIterator as $k => $v) {
    echoit("$k => $v" ); // $v is the instance of SplFileInfo
}

// ------------------------------------------------------------------------
echoith();

/**
 * MULTIPLE ITERATOR
 */
$i1 = new ArrayIterator($tab);
$i2 = new ArrayIterator(array_reverse($tab));
$multipleIterator = new MultipleIterator();
$multipleIterator->attachIterator($i1);
$multipleIterator->attachIterator($i2);

foreach ($multipleIterator as $k => $v) {
    var_dump($k);
    var_dump($v);
    echoit('----');
}

// ------------------------------------------------------------------------
echoith();

/**
 * NO REWIND ITERATOR
 */
$i = new ArrayIterator($tab);
$noRewindIterator = new NoRewindIterator($i);
$noRewindIterator->next();
echoit( $noRewindIterator->current() );
$noRewindIterator->rewind();
echoit( $noRewindIterator->current() );

// ------------------------------------------------------------------------
echoith();

/**
 * RECURSIVE ARRAY ITERATOR
 */
$recursiveArrayIterator = new RecursiveArrayIterator(array(
    array(
        array(
            array(
                array(
                    array(
                        1,2,3
                    ),
                ),
            ),
        ),
    ),
));

// here you should write some traversing function since this approach is not giving good results
// http://php.net/manual/en/class.recursivearrayiterator.php
foreach ($recursiveArrayIterator as $k => $v) {
    var_dump($v);
    echoit('---');
}

// ------------------------------------------------------------------------
echoith();

/**
 * REGEXP ITERATOR
 */
$tab2 = array(1, 'asd', 2, 'das', 3,4,5,6,7,8,9,10,123);

$regexIterator = new RegexIterator(new ArrayIterator($tab2), '/\D+/');
foreach ($regexIterator as $k => $v) {
    echoit("$k => $v" ); // $v is the instance of SplFileInfo
}











