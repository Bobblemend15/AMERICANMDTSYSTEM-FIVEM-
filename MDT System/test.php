<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php
require("./_assets/php/helper.php");


$con->query("ALTER TABLE units ADD steamid VARCHAR(255);")
?>