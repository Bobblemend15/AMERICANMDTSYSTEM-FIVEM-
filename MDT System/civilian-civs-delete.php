<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 512);

if($permCheck == false OR !isset($_GET['cid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}else{
	if($permCheck == true){
		deleteCiv($UserArray['userid'],$_GET['cid']);
	}
}

echo '<meta http-equiv="refresh" content="0; url=civilian-civs.php" />';
?>