<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 2);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<head>
<title>PDRP Network - Civilian Lookup</title>
<style type="text/css">
body {
            background-image: url(../img/background-2.png) !important;
            background-repeat: no-repeat;
            background-position: left center;
            background-size: auto; 
            background-color: #37474f;
            background-attachment: fixed;
        }
</style>
</head>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Civilian Lookup</div>
				<div class="card-body">
					<?php
						if(isset($_POST['searchPNC'])) { 
			  	  			$a = searchCivs($_POST['name'],$_POST['dob']);
                            echo '<meta http-equiv="refresh" content="0; url=pnc-check.php?cid=' . $a . '" />';
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Civilian Name</label>
    						<input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Date of Birth</label>
                            <input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY" required>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='searchPNC' class="btn btn-success btn-block" value="Search">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
