<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['cid'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$civInfo = getCivInfo($_GET['cid']);
?>


<title>PDRP Network - Edit Civilian: <?php echo $civInfo['name']; ?></title>


<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card custom-card">
				<div class="card-header">
					Edit Civilian: <?php echo $civInfo['name']; ?>
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['createCall'])) { 
			  	  			updateCiv($civInfo['civid'], $_POST['name'], $_POST['dob'], $_POST['address']);
                    ?>
                    <div class="alert alert-success"><b>Civilian Updated</b> The Civilian has been updated.</div>
                    <?php
                    echo '<meta http-equiv="refresh" content="0; url=civilian-civs.php" />';
						}
					?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?cid=<?php echo $civInfo['civid']; ?>" method="post">
  						<div class="row">
  							<div class="form-group col-md-6">
    							<label for="channel">Civilian Name</label>
    							<input type="text" class="form-control" name="name" value="<?php echo $civInfo['name']; ?>" required>
  							</div>
  							<div class="form-group col-md-6">
    	                        <label for="channel">Address</label>
        	                    <input type="text" class="form-control" name="address" value="<?php echo $civInfo['address']; ?>" required>
            	            </div>
	                        <div class="form-group col-md-6">
    	                        <label for="channel">Date of Birth</label>
        	                    <input type="date" class="form-control" name="dob" value="<?php echo $civInfo['dob']; ?>" required>
            	            </div>
                        </div>
  						<div class="form-group" style="width: 100%;">
							<input type="submit" name='createCall' class="btn btn-success btn-block" value="Update Civilian">
						</div>
					</form>