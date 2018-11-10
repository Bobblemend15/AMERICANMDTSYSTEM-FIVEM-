<?php

    /*
    *   @author Owen Morgan (OM Solutions)
    *   @copyright OM Solutions 2018
    */
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 4);

if($permCheck == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<title>PDRP Network - Edit Call</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Edit Call</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createCall'])) { 
			  	  			createCall($_POST['type'],$_POST['location'],$_POST['civilian'],$_POST['description']);
                    ?>
                    <div class="alert alert-success"><b>Call Submitted</b> The call has been sent to the control room.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Call Type</label>
    						<input type="text" class="form-control" name="type">
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Location</label>
                            <input type="text" class="form-control" name="location">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Caller</label>
                            <select name="civilian" class="form-control">
                                <option value="0">Drop Call</option>
                                <?php
                                $civs = getCivs();

                                foreach($civs as $civ){
                                ?>
                                <option value="<?php echo $civ['civid']; ?>"><?php echo $civ['name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Opening information</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='createCall' class="btn btn-success btn-block" value="Create Call">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
