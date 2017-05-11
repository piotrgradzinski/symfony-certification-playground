<?php

include "../common.php";

/**
 * ZMIENNE STATYCZNE
 */

function test($i){
    static $i = 1;

    echo $i;

}

test(123);
test(123);


echoith();

/**
 * PASSWORD HASH
 */

echo password_hash("alamakota", PASSWORD_DEFAULT);

var_dump(password_verify('alamakota', '$2y$10$8kbWqlLZtjYMX451PjcZ1OUIgWpgvB8BLcTGxedLTJXigyA2Gr8t.'));

