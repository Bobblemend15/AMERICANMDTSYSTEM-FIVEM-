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
<title>PDRP Network - License Plate Lookup</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">License Plate Lookup</div>
				<div class="card-body">
					<?php
						if(isset($_POST['searchVRM'])) { 
			  	  			$a = searchVehicle($_POST['vrm']);
                            echo '<meta http-equiv="refresh" content="0; url=vrm-check.php?vid=' . $a . '" />';
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">License Plate</label>
    						<input type="text" class="form-control" name="vrm" required>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='searchVRM' class="btn btn-success btn-block" value="Search">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
