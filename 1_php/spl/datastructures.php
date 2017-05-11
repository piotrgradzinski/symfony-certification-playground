<?php

include "../../common.php";

/**
 * SplDoublyLinkedList
 */

$list = new SplDoublyLinkedList();
$list->push('a');
$list->push('b');
$list->push('c');
$list->push('d');

echoit("FIFO (First In First Out) :");
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echoit($list->current());
}

echoit("\n\nLIFO (Last In First Out) :");
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echoit($list->current());
}


// ------------------------------------------------------------------------
echoith();

class StrLongHeap extends SplHeap {

    protected function compare($value1, $value2)
    {
        $v1 = strlen($value1);
        $v2 = strlen($value2);

        if ($v1 > $v2) {
            return 1;
        } elseif ($v1 == $v2) {
            return 0;
        } else {
            return -1;
        }
    }
}

$myHeap = new StrLongHeap();
$myHeap->insert('a');
$myHeap->insert('b');
$myHeap->insert('cc');
$myHeap->insert('ccaa');

while ($myHeap->valid()) {
    echoit($myHeap->current());
    $myHeap->next();
}