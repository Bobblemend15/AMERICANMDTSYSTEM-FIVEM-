<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['vid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	 $vehicleInfo = getVehicleInfo($_GET['vid']);
?>


<title>PDRP Network - Edit Vehicle: <?php echo $vehicleInfo['vrm']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header">
                    Edit Civilian: <?php echo $vehicleInfo['vrm']; ?>
                </div>
                <div class="card-body">
                    <?php
                        if(isset($_POST['updateVehicle'])) { 
                            updateVehicle($vehicleInfo['vehicleid'], $_POST['name'], $_POST['vrm'], $_POST['status'], $_POST['owner'], $_POST['insurer'], $_POST['markers']);
                    ?>
                        <div class="alert alert-success"><b>Vehicle Updated</b> The vehicle has been updated.</div>
                    <?php
                    echo '<meta http-equiv="refresh" content="0; url=civilian-vehicles.php" />';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?vid=<?php echo $vehicleInfo['vehicleid']; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="channel">Vehicle Type</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $vehicleInfo['vehicle']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">License Plate</label>
                                <input type="text" class="form-control" name="vrm" value="<?php echo $vehicleInfo['vrm']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Coverage</label>
                                <select name="status" class="form-control">
                                    <option value="<?php echo $vehicleInfo['status']; ?>"><?php echo $vehicleInfo['status']; ?></option>
                                    <option value="Insured">Insured</option>
                                    <option value="Stolen">Stolen</option>
                                    <option value="Uninsured">Uninsured</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Owner</label>
                                <select name="owner" class="form-control">
                                    <option value="<?php echo getVehicleOwner($vehicleInfo['owner'])['civid']; ?>"><?php echo getVehicleOwner($vehicleInfo['owner'])['name']; ?></option>
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
                            <div class="form-group col-md-6">
                                <label for="channel">Insurance Provider</label>
                                <input type="text" class="form-control" name="insurer" value="<?php echo $vehicleInfo['insurer']; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="channel">Tags</label>
                                <select class="form-control" name="markers" value="<?php echo $vehicleInfo['markers']; ?>" required>
								<option value="Expired">Expired</option>
								<option value="Not Expired">Not Expired</option>
								</select>
                            </div>
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <input type="submit" name='updateVehicle' class="btn btn-success btn-block" value="Update Vehicle">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>