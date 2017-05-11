<?php

include "../common.php";

echoit('GET');
var_dump($_GET);

echoit('POST');
var_dump($_POST);

echoit('REQUEST');
var_dump($_REQUEST);

?>

<form action="form_get_post.php?id=123" method="post">

    <input type="text" name="test" />
    <input type="text" name="id" />

    <input type="submit" />
</form>