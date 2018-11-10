<?php
?>
<?php include('./resources/layout/head.php'); ?>

<?php
$permCheck = haveGeneralPerm($UserArray['userid'], 16);

if($permCheck == false OR !isset($_GET['poi'])){
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
}
?>

<?php
	$poiInfo = getPoiInfo($_GET['poi']);
  $civInfo = getCivInfo($poiInfo['civ_id']);
?>

<title>PDRP Network - Edit BOLO: <?php echo $civInfo['name']; ?></title>

<div class="container-fluid" style="margin-top: 25px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card custom-card">
				<div class="card-header">
					Edit BOLO: <?php echo $civInfo['name']; ?>
				</div>
				<div class="card-body">
					<?php
						if(isset($_POST['updatePoi'])) { 
			  	  	updatePoi($_GET['poi'],$_POST['image'],$_POST['reason'],$_POST['notes']);
          ?>
                    <div class="alert alert-success"><b>BOLO Updated</b> The BOLO has been updated.</div>
          <?php
						}
					?>
          <?php
            if(isset($_POST['clearPoi'])) { 
              clearPoi($_GET['poi']);
          ?>
                    <div class="alert alert-danger"><b>BOLO Cleared</b> The BOLO has been cleared.</div>
          <?php
          echo '<meta http-equiv="refresh" content="0; url=intel-pois.php" />';
            }
          ?>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?poi=<?php echo $poiInfo['id']; ?>" method="post">
  						<div class="row">
                          <div class="form-group col-md-12">
                              <label for="channel">Description</label>
                              <input type="text" class="form-control" name="image" value="<?php echo $poiInfo['image']; ?>" required>
                          </div>
	                        <div class="form-group col-md-12">
    	                        <label for="channel">Reason</label>
                              <textarea class="form-control" name="reason" required><?php echo $poiInfo['reason']; ?></textarea>
            	            </div>
                	        <div class="form-group col-md-12">
    	                        <label for="channel">Notes</label>
        	                    <textarea class="form-control" name="notes" required><?php echo $poiInfo['notes']; ?></textarea>
            	            </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='updatePoi' class="btn btn-success btn-block" value="Update BOLO Record">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name='clearPoi' class="btn btn-danger btn-block" value="Clear BOLO">
                        </div>
                      </div>
					</form>