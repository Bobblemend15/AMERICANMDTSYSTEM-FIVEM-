<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);
$permCheck2 = haveGeneralPerm($UserArray['userid'], 2);

if($permCheck == false && $permCheck2 == false){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>


<title>PDRP Network - Create a 911 Call</title>

<div class="container" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Create a 911 Call Report</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createCall'])) { 
                            $location = $con->escape_string($_POST['location']);
                            $description = $con->escape_string($_POST['description']);
			  	  			createCall($UserArray['userid'],$_POST['type'],$location,$_POST['civilian'],$description);
                    ?>
                    <div class="alert alert-success"><b>Call Submitted</b> The call has been sent to DISPATCH.</div>
                    <?php
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group col-md-12">
    						<label for="channel">Call Type</label>
                            <select class="form-control" name="type">
                                <option value="CRIME">CRIME</option>
                                <option value="TRAFFIC">TRAFFIC</option>
                                <option value="MISCELLANEOUS">MISCELLANEOUS</option>
                                <option value="AMBULANCE">AMBULANCE</option>
                                <option value="FIRE SERVICE">FIRE SERVICE</option>
                            </select>
  						</div>
                        <div class="form-group col-md-12">
                            <label for="channel">Location</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="channel">Caller</label>
                            <select name="civilian" class="form-control">
                                <option value="0">Anonymous</option>
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
                            <label for="channel">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
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
