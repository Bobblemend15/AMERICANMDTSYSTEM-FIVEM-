<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php

$host = 'localhost';
$name = 'pdrpnetw_bobble';
$password = 'cookiesforever';
$dbname = 'pdrpnetw_mdt';

$con = mysqli_connect($host, $name, $password, $dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>