<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./_assets/php/helper.php'); ?>

<?php
// Initialize the session
session_start();

$session_id = session_id();

destroySession($session_id);
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
echo '<meta http-equiv="refresh" content="0; url=login.php" />';
exit;
?>